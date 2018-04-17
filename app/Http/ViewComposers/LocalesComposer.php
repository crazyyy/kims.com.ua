<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 30.01.17
 * Time: 12:12
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;

/**
 * Class LocalesComposer
 * @package App\Http\ViewComposers
 */
class LocalesComposer
{
    
    /**
     * Bind data to the view.
     *
     * @param  View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $locales = [];
        
        foreach (config('app.locales') as $locale) {
            $locales[$locale] = trans('labels.locale_'.$locale);
        }
        
        $view->with('locales', $locales);
    }
}