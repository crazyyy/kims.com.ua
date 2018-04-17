<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateSharesTableAddDepartmentId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'shares',
            function (Blueprint $table) {
                $table->integer('department_id')->unsigned()->nullable()->index()->after('id');
                
                $table->foreign('department_id')->references('id')->on('departments')
                    ->onUpdate('cascade')->onDelete('set null');
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
            'shares',
            function (Blueprint $table) {
                $table->dropForeign('shares_department_id_foreign');
                $table->dropIndex('shares_department_id_index');
                $table->dropColumn('department_id');
            }
        );
    }
}
