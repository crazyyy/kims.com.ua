<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class _ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        if (env('APP_ENV') != 'production') {
            Product::whereNotNull('id')->delete();

            DB::statement('ALTER TABLE `products` AUTO_INCREMENT=1');
        }

        foreach (Category::child()->get(['id']) as $category) {
            for ($i = 0; $i < 10; $i++) {
                $input = [
                    'category_id' => $category->id,
                    'price' => rand(100, 10000),
                    'position' => $i,
                ];

                foreach (config('app.locales') as $locale) {
                    $input[$locale] = [
                        'name'        => $faker->realText(rand(20, 25)),
                    ];
                }

                $product = new Product($input);
                $product->save();
            }
        }
    }
}