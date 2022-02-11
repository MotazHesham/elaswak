<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOfferRatesTable extends Migration
{
    public function up()
    {
        Schema::table('offer_rates', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id', 'offer_fk_5806563')->references('id')->on('offers');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5806564')->references('id')->on('users');
        });
    }
}
