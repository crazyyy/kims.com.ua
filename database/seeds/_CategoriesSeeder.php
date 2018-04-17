<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class _CategoriesSeeder extends Seeder
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
            Category::whereNotNull('id')->delete();

            DB::statement('ALTER TABLE `categories` AUTO_INCREMENT=1');
        }

        for ($i = 0; $i < 2; $i++) {
            $input = [
                'position' => $i,
            ];

            foreach (config('app.locales') as $locale) {
                $input[$locale] = [
                    'name'        => $faker->realText(rand(20, 25)),
                    'description' => $faker->realText(rand(50, 70)),
                ];
            }

            $category = new Category($input);
            $category->save();

            for ($n = 0; $n < 10; $n++) {
                $input = [
                    'position'  => $i*10 + $n,
                    'parent_id' => $category->id,
                ];

                foreach (config('app.locales') as $locale) {
                    $input[$locale] = [
                        'name'        => $faker->realText(rand(20, 25)),
                        'description' => $faker->realText(rand(50, 70)),
                    ];
                }

                Category::create($input);
            }
        }
    }
}