<?php namespace App\Http\Requests\Backend\Share;

use App\Http\Requests\FormRequest;

/**
 * Class ShareRequest
 * @package App\Http\Requests\Backend\Share
 */
class ShareRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'status'        => 'required|boolean',
            'image'         => ['regex:'.$this->image_regex],
            'department_id' => 'required|exists:departments,id',
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