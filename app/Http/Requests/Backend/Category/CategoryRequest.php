<?php namespace App\Http\Requests\Backend\Category;

use App\Http\Requests\FormRequest;

/**
 * Class CategoryRequest
 * @package App\Http\Requests\Backend\Category
 */
class CategoryRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'parent_id' => 'exists:categories,id',
            'status'    => 'required|boolean',
            'position'  => 'required|integer',
            'image'     => ['regex:'.$this->image_regex],
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