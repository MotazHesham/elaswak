<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferProductCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('offer_product_category', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id', 'offer_id_fk_5806553')->references('id')->on('offers')->onDelete('cascade');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_5806553')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
}
