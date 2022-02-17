<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('discount_code')->nullable(); 
            $table->decimal('discount', 15, 2)->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->string('zip_code');
            $table->string('address');
            $table->string('payment_type')->default('cash_on_delivery');
            $table->string('payment_status')->default('unpaid');
            $table->string('delivery_status')->default('pending');
            $table->string('cancel_reason')->nullable();
            $table->boolean('done_status')->default(0); // the purpose is preventing add the order to targets mutliple times
            $table->unsignedBigInteger('delegate_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
