<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->boolean('delivery')->default(0);
            $table->decimal('delivery_cost', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
