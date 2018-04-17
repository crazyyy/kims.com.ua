<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProductTransaltionsTableAddPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'product_translations',
            function (Blueprint $table) {
                $table->text('price')->nullable()->after('name');
            }
        );
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'product_translations',
            function (Blueprint $table) {
                $table->dropColumn('price');
            }
        );
    }
}
