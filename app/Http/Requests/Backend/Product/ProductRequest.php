<?php namespace App\Http\Requests\Backend\Product;

use App\Http\Requests\FormRequest;

/**
 * Class ProductRequest
 * @package App\Http\Requests\Backend\Product
 */
class ProductRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|boolean',
            'position'    => 'required|integer',
        ];
        
        $languageRules = [
            'name'  => 'required',
            'price' => 'array',
        ];
        
        foreach (config('app.locales') as $locale) {
            foreach ($languageRules as $name => $rule) {
                $rules[$locale.'.'.$name] = $rule;
            }
        }
        
        return $rules;
    }
}