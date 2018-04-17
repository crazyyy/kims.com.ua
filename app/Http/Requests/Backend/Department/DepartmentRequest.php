<?php namespace App\Http\Requests\Backend\Department;

use App\Http\Requests\FormRequest;
use App\Models\DepartmentItem;

/**
 * Class DepartmentRequest
 * @package App\Http\Requests\Backend\Department
 */
class DepartmentRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'status'    => 'required|boolean',
            'email'     => 'email',
            
            'items' => 'array',
        ];
        
        $languageRules = [
            'name'    => 'required',
            'address' => 'required',
        ];
        
        foreach (config('app.locales') as $locale) {
            foreach ($languageRules as $name => $rule) {
                $rules[$locale.'.'.$name] = $rule;
            }
        }
        
        $items_rules = [];
        
        $itemsLanguageRules = [
            'address' => 'required',
        ];
        
        foreach (DepartmentItem::getTypes() as $type) {
            foreach (['old', 'new'] as $key) {
                foreach (config('app.locales') as $locale) {
                    foreach ($itemsLanguageRules as $name => $rule) {
                        $items_rules['items.'.$type.'.'.$key.'.*.'.$locale.'.'.$name] = $rule;
                    }
                }
                
                $items_rules['items.'.$type.'.'.$key.'.*.latitude'] = 'required|numeric';
                $items_rules['items.'.$type.'.'.$key.'.*.longitude'] = 'required|numeric';
                $items_rules['items.'.$type.'.'.$key.'.*.status'] = 'required|boolean';
                $items_rules['items.'.$type.'.'.$key.'.*.position'] = 'required|integer';
            }
        }
        
        return array_merge($rules, $items_rules);
    }
}