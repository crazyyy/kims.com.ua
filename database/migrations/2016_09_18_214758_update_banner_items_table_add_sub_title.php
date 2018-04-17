<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBannerItemsTableAddSubTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'banner_item_translations',
            function (Blueprint $table) {
                $table->string('sub_title')->nullable()->after('title');
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
            'banner_item_translations',
            function (Blueprint $table) {
                $table->dropColumn('sub_title');
            }
        );
    }
}
