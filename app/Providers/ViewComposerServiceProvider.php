<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 31.03.16
 * Time: 15:19
 */

namespace App\Providers;

use App\Http\ViewComposers\DepartmentItemTypes;
use App\Http\ViewComposers\LocalesComposer;
use Illuminate\Support\ServiceProvider;

/**
 * Class ViewComposer
 * @package App\Providers
 */
class ViewComposerServiceProvider extends ServiceProvider
{
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('import.index', LocalesComposer::class);
        view()->composer('views.department.partials._form', DepartmentItemTypes::class);
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}