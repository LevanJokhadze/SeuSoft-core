<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_table', function (Blueprint $table) {
            $table->id();
            $table->string('titleEn')->nullable();
            $table->string('titleGe')->nullable();
            $table->text('bodyEn')->nullable();
            $table->text('bodyGe')->nullable();
            $table->json('titlesEn')->nullable();
            $table->json('titlesGe')->nullable();
            $table->json('images')->nullable();
            $table->json('href')->nullable();
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
        Schema::dropIfExists('products_table');
    }
};
