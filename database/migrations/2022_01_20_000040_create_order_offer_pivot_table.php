<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOfferPivotTable extends Migration
{
    public function up()
    {
        Schema::create('order_offer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk_5807059')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id', 'offer_id_fk_5807059')->references('id')->on('offers')->onDelete('cascade');
            $table->Integer('quantity');
            $table->decimal('total_cost', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
