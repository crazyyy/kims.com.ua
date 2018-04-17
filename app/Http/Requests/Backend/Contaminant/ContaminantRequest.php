<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:53
 */

namespace App\Http\Requests\Backend\Contaminant;

use App\Http\Requests\FormRequest;

/**
 * Class ContaminantRequest
 * @package App\Http\Requests\Backend\Contaminant
 */
class ContaminantRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'class'    => 'required|string',
            'status'   => 'required|boolean',
            'default'  => 'boolean',
            'share_id' => 'exists:shares,id',
        ];

        $languageRules = [
            'name' => 'required',
        ];

        foreach (config('app.locales') as $locale) {
            foreach ($languageRules as $name => $rule) {
                $rules[$locale.'.'.$name] = $rule;
            }
        }

        return $rules;
    }
}