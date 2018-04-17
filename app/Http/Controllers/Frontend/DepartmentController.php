<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 06.04.17
 * Time: 3:45
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Department;
use Exception;

/**
 * Class DepartmentController
 * @package App\Http\Controllers\Frontend
 */
class DepartmentController extends FrontendController
{
    
    /**
     * @param int $department_id
     *
     * @return array
     */
    public function contacts($department_id)
    {
        try {
            $department = Department::where('id', $department_id)->visible()->firstOrFail();
            $department_items_groups = $this->getDepartmentItemsGroups($department->id);
            $contact_markers = $this->getContactMapMarkers($department_items_groups);
            
            return [
                'department'                   => $department,
                'contact_tabs'                 => view(
                    'partials.contacts_popup_tabs',
                    [
                        'department_items_groups' => $department_items_groups,
                    ]
                )->render(),
                'contact_markers'              => $contact_markers,
                'current_department_latitude'  => $department->latitude,
                'current_department_longitude' => $department->longitude,
            ];
        } catch (Exception $e) {
            return [];
        }
    }
}