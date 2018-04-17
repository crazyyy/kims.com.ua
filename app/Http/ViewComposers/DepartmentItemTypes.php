<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 30.01.17
 * Time: 12:12
 */

namespace App\Http\ViewComposers;

use App\Models\DepartmentItem;
use Illuminate\View\View;

/**
 * Class DepartmentItemTypes
 * @package App\Http\ViewComposers
 */
class DepartmentItemTypes
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
        $view->with('department_item_types', DepartmentItem::getTypes());
    }
}