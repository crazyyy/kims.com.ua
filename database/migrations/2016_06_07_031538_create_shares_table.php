<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'shares',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('image')->nullable();
                $table->boolean('status')->default(true);

                $table->timestamps();
            }
        );

        Schema::create(
            'share_translations',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('share_id')->unsigned();

                $table->string('locale')->index();

                $table->string('name')->nullable();
                $table->string('description')->nullable();

                $table->unique(['share_id', 'locale']);
                $table->foreign('share_id')->references('id')->on('shares')->onUpdate('cascade')->onDelete(
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
        Schema::drop('share_translations');
        Schema::drop('shares');
    }
}
