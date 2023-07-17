<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TEST extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->bigIncrements('idtest');
            $table->string('name', 255);
            $table->integer('age');
            $table->integer('sex');
            $table->double('salary');
            $table->string('nghenghiep',255);
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
        //
    }
}
