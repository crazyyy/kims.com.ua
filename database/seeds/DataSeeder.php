<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') != 'production') {
            Model::unguard();

            $this->call(_DepartmentsSeeder::class);
            $this->call(_CategoriesSeeder::class);
            $this->call(_ProductsSeeder::class);

            Model::reguard();
        }
    }
}
