<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name');
            $table->string('commerical_num');
            $table->date('commerical_expiry');
            $table->string('licence_num');
            $table->date('licence_expiry');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
