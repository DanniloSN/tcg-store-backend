<?php

namespace App\Models\Scryfall;

use Illuminate\Database\Eloquent\Model;

class BulkData extends Model
{
    protected $fillable = [
        'object', 'id', 'type', 'updated_at', 'uri', 'name',
        'description', 'size', 'download_uri', 'content_type', 'content_encoding'
    ];

    protected $cast = [
        'size' => 'integer'
    ];
}
