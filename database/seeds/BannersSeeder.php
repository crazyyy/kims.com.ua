<?php

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'main_left'      => 'Левый банер',
            'main_right'     => 'Правый банер',
            'franchising_is' => 'Франчайзинг KIMS – это',
            'franchise'      => 'Франшиза',
        ];

        foreach ($positions as $position => $name) {
            if (!Banner::whereLayoutPosition($position)->first()) {
                $input = [
                    'layout_position' => $position,
                    'position'        => 0,
                    'template'        => $position,
                ];

                foreach (config('app.locales') as $locale) {
                    $input[$locale] = [
                        'title' => $name,
                    ];
                }

                Banner::create($input);
            }
        }
    }
}