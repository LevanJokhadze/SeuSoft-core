<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('last_name'); 
            $table->string('email');
            $table->integer('number');
            $table->text('service');
            $table->string('company');
            $table->text('message');
            $table->timestamps();   
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
