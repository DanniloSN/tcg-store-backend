<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Services\ScryfallService;
use Exception;
use Illuminate\Console\Command;

class UpdateScryfallCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-scryfall-cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync the local cards data with the scryfall api data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Card::truncate();
        $bulkDataList = ScryfallService::getBulkDataList();
        if (empty($bulkDataList))
            throw new Exception('No bulk data found');
        $bulkDataType = $_ENV['SCRYFALL_DEFAULT_BULK_DATA_TYPE'];
        $bulkData = array_filter($bulkDataList, fn($bulkData) => $bulkData->type === $bulkDataType)[0];
        if (empty($bulkData))
            throw new Exception("No bulk data of type '$bulkDataType' found");
        $cards = ScryfallService::getBulkDataCards($bulkData);
        if (empty($cards))
            throw new Exception('No cards found');
        foreach ($cards as $card) {
            $cardData = $card->toArray();
            $cardData['scryfall_id'] = $card->id;
            unset($cardData['id']);
            Card::create($cardData);
        }
    }
}
