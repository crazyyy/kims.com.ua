<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveAddressaAndAddEmailToDepartmentTable extends Migration
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
                $table->dropColumn('address');
                $table->string('email')->nullable();
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
                $table->dropColumn('email');
                $table->text('address')->nullable();
            }
        );
    }
}
