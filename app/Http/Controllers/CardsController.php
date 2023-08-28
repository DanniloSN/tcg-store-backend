<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Services\ScryfallService;
use Illuminate\Routing\Controller as BaseController;

class CardsController extends BaseController
{
    public function syncCards()
    {
        $bulkDataList = ScryfallService::getBulkDataList();
        $bulkData = array_filter(
            $bulkDataList,
            fn ($bulkData) => $bulkData->type === $_ENV['SCRYFALL_DEFAULT_BULK_DATA_TYPE']
        )[0];
        $cards = ScryfallService::getBulkDataCards($bulkData);
        foreach ($cards as $card) {
            $cardData = $card->toArray();
            $cardData['scryfall_id'] = $card->id;
            unset($cardData['id']);
            Card::create($cardData);
        }
    }
}
