<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('offer_product', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id', 'offer_id_fk_5806556')->references('id')->on('offers')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_5806556')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
