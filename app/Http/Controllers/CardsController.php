<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CardsController extends Controller
{
    public function catalog(Request $request)
    {
        $pageNumber = $request->input('page', 1);
        $itemsPerPage = 100;
        $offset = ($pageNumber - 1) * $itemsPerPage;

        $cards = Card::select(
                'id',
                'name',
                'image_uris->normal as image',
                'prices->usd as price',
                'edhrec_rank',
                'released_at'
            )
            ->orderBy('released_at', 'desc')
            ->orderByRaw('edhrec_rank IS NULL')
            ->orderBy('edhrec_rank', 'asc')
            ->limit($itemsPerPage)
            ->offset($offset)
            ->get();

        return $cards;
    }
}
