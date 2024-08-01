<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_table', function (Blueprint $table) {
            // This only works with MySQL
            DB::statement('ALTER TABLE `products_table` MODIFY `images` LONGBLOB NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_table', function (Blueprint $table) {
            // Reverting back to the original binary type
            DB::statement('ALTER TABLE `products_table` MODIFY `images` BLOB NULL');
        });
    }
};
