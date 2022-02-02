<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferCartsTable extends Migration
{
    public function up()
    {
        Schema::create('offer_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('quantity');
            $table->decimal('total_cost', 15, 2);
            $table->timestamps();
        });
    }
}
