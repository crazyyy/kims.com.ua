<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTableNewPriceColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->dropColumn('price');
            }
        );
    
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->text('price')->nullable()->after('status');
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
            'products',
            function (Blueprint $table) {
                $table->dropColumn('price');
            }
        );
    
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->integer('price')->unsigned()->after('status');
            }
        );
    }
}
