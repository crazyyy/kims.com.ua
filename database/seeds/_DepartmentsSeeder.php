<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class _DepartmentsSeeder extends Seeder
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
            Department::whereNotNull('id')->delete();

            DB::statement('ALTER TABLE `departments` AUTO_INCREMENT=1');
        }

        for ($i = 0; $i < 10; $i++) {
            $input = [
                'latitude'  => rand(44.386389, 52.334444),
                'longitude' => rand(22.163889, 40.198056),
                'status'    => true,
            ];

            foreach (config('app.locales') as $locale) {
                $input[$locale] = [
                    'name'        => $faker->city,
                    'address'     => $faker->address,
                    'description' => $faker->realText(rand(50, 150)),
                ];
            }

            Department::create($input);
        }
    }
}