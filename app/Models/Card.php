<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'scryfall_id', 'name', 'lang', 'released_at', 'image_uris', 'mana_cost', 'cmc',
        'type_line', 'oracle_text', 'colors', 'color_identity', 'legalities', 'set',
        'set_name', 'rarity', 'flavor_text', 'edhrec_rank', 'prices',
    ];

    protected $casts = [
        'image_uris' => 'array',
        'colors' => 'array',
        'color_identity' => 'array',
        'legalities' => 'array',
        'prices' => 'array',
    ];
}
