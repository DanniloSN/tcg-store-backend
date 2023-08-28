<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('scryfall_id');
            $table->string('name');
            $table->string('lang');
            $table->date('released_at');
            $table->json('image_uris')->default('[]');
            $table->string('mana_cost')->nullable();
            $table->double('cmc');
            $table->string('type_line');
            $table->text('oracle_text')->nullable();
            $table->json('colors')->default('[]');
            $table->json('color_identity');
            $table->json('legalities');
            $table->string('set');
            $table->string('set_name');
            $table->string('rarity');
            $table->text('flavor_text')->nullable();
            $table->unsignedBigInteger('edhrec_rank')->nullable();
            $table->json('prices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
