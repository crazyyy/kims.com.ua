<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContaminantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contaminants',
            function (Blueprint $table) {
                $table->increments('id');

                $table->string('class')->nullable();

                $table->boolean('status')->default(true);
                $table->boolean('default')->default(false);

                $table->timestamps();
            }
        );

        Schema::create(
            'contaminant_translations',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('contaminant_id')->unsigned();

                $table->string('locale')->index();

                $table->string('name')->nullable();
                $table->text('description')->nullable();

                $table->unique(['contaminant_id', 'locale']);
                $table->foreign('contaminant_id')->references('id')->on('contaminants')
                    ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('contaminant_translations');
        Schema::drop('contaminants');
    }
}
