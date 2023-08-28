<?php

namespace App\Models\Scryfall;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'object', 'id', 'oracle_id', 'multiverse_ids', 'mtgo_id', 'mtgo_foil_id',
        'tcgplayer_id', 'cardmarket_id', 'name', 'lang', 'released_at', 'uri',
        'scryfall_uri', 'layout', 'highres_image', 'image_status', 'image_uris',
        'mana_cost', 'cmc', 'type_line', 'oracle_text', 'colors', 'color_identity',
        'keywords', 'legalities', 'games', 'reserved', 'foil', 'nonfoil', 'finishes',
        'oversized', 'promo', 'reprint', 'variation', 'set_id', 'set', 'set_name',
        'set_type', 'set_uri', 'set_search_uri', 'scryfall_set_uri', 'rulings_uri',
        'prints_search_uri', 'collector_number', 'digital', 'rarity', 'flavor_text',
        'card_back_id', 'artist', 'artist_ids', 'illustration_id', 'border_color',
        'frame', 'full_art', 'textless', 'booster', 'story_spotlight', 'edhrec_rank',
        'prices', 'related_uris', 'purchase_uris',
    ];

    protected $casts = [
        'multiverse_ids' => 'array',
        'image_uris' => 'array',
        'colors' => 'array',
        'color_identity' => 'array',
        'keywords' => 'array',
        'legalities' => 'array',
        'games' => 'array',
        'finishes' => 'array',
        'artist_ids' => 'array',
        'prices' => 'array',
        'related_uris' => 'array',
        'purchase_uris' => 'array',
    ];
}
