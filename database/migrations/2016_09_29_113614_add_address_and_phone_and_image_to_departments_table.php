<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAddressAndPhoneAndImageToDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'departments',
            function (Blueprint $table) {
                $table->text('address')->nullable();
                $table->text('phone')->nullable();
                $table->text('image')->nullable();
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
            'departments',
            function (Blueprint $table) {
                $table->dropColumn('address');
                $table->dropColumn('phone');
                $table->dropColumn('image');
            }
        );
    }
}
