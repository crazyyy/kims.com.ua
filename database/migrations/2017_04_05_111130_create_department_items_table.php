<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'department_items',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('department_id')->unsigned()->index();
    
                $table->string('type');
                $table->string('phones')->nullable();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->integer('position')->unsigned();
                $table->boolean('status')->default(true);

                $table->timestamps();

                $table->foreign('department_id')->references('id')->on('departments')
                    ->onUpdate('cascade')->onDelete('cascade');
            }
        );

        Schema::create(
            'department_item_translations',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('department_item_id')->unsigned()->index();

                $table->string('locale')->index();
    
                $table->string('address')->nullable();
                $table->string('description')->nullable();
                $table->string('work_schedule')->nullable();

                $table->unique(['department_item_id', 'locale']);

                $table->foreign('department_item_id')->references('id')->on('department_items')
                    ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('department_item_translations');
        Schema::drop('department_items');
    }
}
