<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'categories',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('parent_id')->nullable()->unsigned()->index();
                
                $table->integer('position')->unsigned();
                $table->boolean('status')->default(true);
                $table->string('image')->nullable();

                $table->timestamps();

                $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null')->onUpdate(
                    'cascade'
                );
            }
        );

        Schema::create(
            'category_translations',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('category_id')->unsigned();
                $table->string('locale')->index();

                $table->string('name')->nullable();
                $table->text('description')->nullable();

                $table->unique(['category_id', 'locale']);
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::drop('category_translations');
        Schema::drop('categories');
    }
}