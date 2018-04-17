<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageToShareTranslationsAndRemoveImageFromShare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('share_translations', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
        foreach(\App\Models\Share::all() as $item) {
            try {
                $sht = \App\Models\ShareTranslation::where('share_id', $item->id)->where('locale', 'ru')->first();
                $sht->update([
                    'image' => \App\Models\Share::select('image')->find($item->id)->toArray()['image']
                ]);
            } catch (Exception $e) {
                continue;
            }
        }
        Schema::table('shares', function (Blueprint $table) {
           $table->dropColumn('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('share_translations', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('shares', function (Blueprint $table) {
            $table->string('image')->nullable();
        });
    }
}
