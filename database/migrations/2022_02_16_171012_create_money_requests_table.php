<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('money_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 15, 2);
            $table->longText('description');
            $table->string('status');
            $table->unsignedBigInteger('delegate_id')->nullable();
            $table->foreign('delegate_id', 'delegate_fk_6012658')->references('id')->on('delegates');
            $table->unsignedBigInteger('target_id')->nullable();
            $table->foreign('target_id', 'target_fk_6016835')->references('id')->on('targets');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}