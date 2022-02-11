<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOfferCartsTable extends Migration
{
    public function up()
    {
        Schema::table('offer_carts', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id')->nullable();
            $table->foreign('offer_id', 'offer_fk_5819581')->references('id')->on('offers');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_5819582')->references('id')->on('users');
        });
    }
}
