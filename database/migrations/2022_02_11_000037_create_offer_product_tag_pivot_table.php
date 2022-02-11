<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferProductTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('offer_product_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id', 'offer_id_fk_5806554')->references('id')->on('offers')->onDelete('cascade');
            $table->unsignedBigInteger('product_tag_id');
            $table->foreign('product_tag_id', 'product_tag_id_fk_5806554')->references('id')->on('product_tags')->onDelete('cascade');
        });
    }
}
