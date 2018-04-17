<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContaminantsTableAddShareId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'contaminants',
            function (Blueprint $table) {
                $table->integer('share_id')->unsigned()->nullable()->index()->after('id');

                $table->foreign('share_id')->references('id')->on('shares')->onUpdate('cascade')->onDelete('set null');
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
            'contaminants',
            function (Blueprint $table) {
                $table->dropForeign('contaminants_share_id_foreign');

                $table->dropIndex('contaminants_share_id_index');

                $table->dropColumn('share_id');
            }
        );
    }
}
