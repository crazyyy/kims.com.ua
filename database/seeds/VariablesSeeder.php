<?php

use App\Models\Variable;
use Illuminate\Database\Seeder;

class VariablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $variables = [
            'app.name' => [
                'type'         => 'text',
                'name'         => trans('labels.site_name', [], null, 'ru'),
                'multilingual' => true,
                'status'       => true,
                'text'         => 'KIMS',
            ],

            'app.email' => [
                'type'         => 'text',
                'name'         => trans('labels.email', [], null, 'ru'),
                'multilingual' => false,
                'status'       => true,
                'value'        => config('app.env') == 'production' ? '' : $faker->email,
            ],

            'facebook_link' => [
                'type'         => 'text',
                'name'         => trans('labels.facebook_link', [], null, 'ru'),
                'multilingual' => false,
                'status'       => true,
            ],
        ];

        foreach ($variables as $key => $variable) {
            if (!Variable::whereKey($key)->first()) {
                $variable['key'] = $key;

                if ($variable['multilingual'] == true) {
                    unset($variable['value']);

                    foreach (config('app.locales') as $locale) {
                        $variable[$locale] = [
                            'text' => $variable['text'],
                        ];
                    }

                    unset($variable['faker']);
                }

                $model = new Variable($variable);
                $model->type = Variable::getTypeKeyByName($variable['type']);

                $model->save();
            }
        }
    }
}