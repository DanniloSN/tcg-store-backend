<?php

namespace App\Services;

use App\Models\Scryfall\BulkData;
use App\Models\Scryfall\Card;
use Illuminate\Support\Facades\Http;

class ScryfallService
{
    private static $BASE_URL = 'https://api.scryfall.com';

    /**
     * @return BulkData[]
     */
    public static function getBulkDataList()
    {
        $data = Http::get(self::$BASE_URL . '/bulk-data')->json('data');
        $data = array_map(fn ($item) => new BulkData($item), $data);
        return $data;
    }

    /**
     * @return Card[]
     */
    public static function getBulkDataCards(BulkData $bulkData)
    {
        $data = Http::get($bulkData->download_uri)->json();
        $data = array_map(fn ($item) => new Card($item), $data);
        return $data;
    }
}
