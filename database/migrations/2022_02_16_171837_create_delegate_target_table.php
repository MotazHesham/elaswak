<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegateTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delegate_target', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('achieved')->default(0)->nullable();
            $table->datetime('achieved_date')->nullable();
            $table->integer('orders')->nullable(); 
            $table->decimal('profit', 15, 2);
            $table->unsignedBigInteger('target_id');
            $table->foreign('target_id', 'target_id_fk_6012949')->references('id')->on('targets')->onDelete('cascade');
            $table->unsignedBigInteger('delegate_id');
            $table->foreign('delegate_id', 'delegate_id_fk_6012949')->references('id')->on('delegates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delegate_target');
    }
}
