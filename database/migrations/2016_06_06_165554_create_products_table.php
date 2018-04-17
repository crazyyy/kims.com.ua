<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'products',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('category_id')->unsigned()->nullable()->index();

                $table->integer('position')->unsigned();
                $table->boolean('status')->default(true);
                
                $table->integer('price')->unsigned();
                
                $table->timestamps();

                $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete(
                    'set null'
                );
            }
        );
        
        Schema::create(
            'product_translations',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('product_id')->unsigned();

                $table->string('locale')->index();
                
                $table->string('name')->nullable();             
                
                $table->unique(['product_id', 'locale']);
                $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete(
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
        Schema::drop('product_translations');
        Schema::drop('products');
    }
}