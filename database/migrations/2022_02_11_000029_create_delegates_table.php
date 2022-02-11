<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('discount_code');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('youtube');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
