<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOfferFavoritesTable extends Migration
{
    public function up()
    {
        Schema::table('offer_favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5806589')->references('id')->on('users');
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id', 'offer_fk_5806590')->references('id')->on('offers');
        });
    }
}
