<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'departments',
            function (Blueprint $table) {
                $table->increments('id');
    
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();

                $table->boolean('status');

                $table->timestamps();
            }
        );

        Schema::create(
            'department_translations',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('department_id')->unsigned();

                $table->string('locale')->index();

                $table->string('name')->nullable();
                $table->string('address')->nullable();
                $table->string('description')->nullable();

                $table->unique(['department_id', 'locale']);
                $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade')->onDelete(
                    'cascade'
                );
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
        Schema::drop('department_translations');
        Schema::drop('departments');
    }
}
