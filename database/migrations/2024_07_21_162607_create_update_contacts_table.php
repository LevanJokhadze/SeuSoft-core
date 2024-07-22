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
        Schema::create('update_contacts', function (Blueprint $table) {
            $table->id();
            $table->string("title")->index();
            $table->string("address");
            $table->string("email");
            $table->string("number");
            $table->string("fb");
            $table->string("ig");
            $table->string("twitter");
            $table->string("in");
            $table->string("copyright");
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
        Schema::dropIfExists('update_contacts');
    }
};
