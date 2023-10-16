<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Services\ScryfallService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () {
            $bulkDataList = ScryfallService::getBulkDataList();
            if (empty($bulkDataList)) {
                throw new Exception('No bulk data found');
            }
            $bulkDataType = $_ENV['SCRYFALL_DEFAULT_BULK_DATA_TYPE'];
            $bulkData = current(array_filter($bulkDataList, fn ($bulkData) => $bulkData->type === $bulkDataType));
            if (empty($bulkData)) {
                throw new Exception("No bulk data of type '$bulkDataType' found");
            }
            $scryfallCards = ScryfallService::getBulkDataCards($bulkData);
            if (empty($scryfallCards)) {
                throw new Exception('No cards found');
            }
            foreach ($scryfallCards as $scryfallCard) {
                $existingCard = Card::where('scryfall_id', $scryfallCard->id)->first();
                if (empty($existingCard)) {
                    $newCardData = $scryfallCard->toArray();
                    $newCardData['scryfall_id'] = $scryfallCard->id;
                    unset($newCardData['id']);
                    Card::create($newCardData);
                }
            }
        });
    }
}
