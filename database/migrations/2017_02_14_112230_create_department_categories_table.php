<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'department_categories',
            function (Blueprint $table) {
                $table->increments('id');
        
                $table->integer('department_id')->unsigned()->index();
                $table->integer('category_id')->unsigned()->index();
    
                $table->integer('position')->unsigned();
                $table->boolean('status')->default(true);
                
                $table->foreign('department_id')->references('id')->on('departments')
                    ->onUpdate('cascade')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')
                    ->onUpdate('cascade')->onDelete('cascade');
                
                $table->timestamps();
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
        Schema::drop('department_categories');
    }
}
