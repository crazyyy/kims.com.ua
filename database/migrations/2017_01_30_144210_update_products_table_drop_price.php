<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProductsTableDropPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (DB::table('products')->get(['id', 'price']) as $product) {
            DB::update(
                'UPDATE product_translations SET price = \''.$product->price.'\''.
                ' WHERE product_id = '.$product->id.' AND locale = \''.config('app.locale').'\''
            );
        }
        
        Schema::table(
            'products',
            function (Blueprint $table) {
                $table->dropColumn('price');
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
            'products',
            function (Blueprint $table) {
                $table->text('price')->nullable()->after('status');
            }
        );
        
        $products = DB::table('product_translations')
            ->where('locale', config('app.locale'))
            ->get(['product_id', 'price']);
        
        foreach ($products as $product) {
            DB::update(
                'UPDATE products SET price = \''.$product->price.'\''.
                ' WHERE id = '.$product->product_id
            );
        }
    }
}
