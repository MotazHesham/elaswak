<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRatesTable extends Migration
{
    public function up()
    {
        Schema::create('product_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate');
            $table->longText('review');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
