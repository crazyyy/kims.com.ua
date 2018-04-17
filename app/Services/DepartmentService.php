<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 05.04.17
 * Time: 11:18
 */

namespace App\Services;

use App\Models\Department;
use App\Models\DepartmentItem;
use Exception;
use FlashMessages;
use Illuminate\Http\Request;

/**
 * Class DepartmentService
 * @package App\Services
 */
class DepartmentService
{
    
    /**
     * @param \App\Models\Department   $department
     * @param \Illuminate\Http\Request $request
     */
    public function saveRelationships(Department $department, Request $request)
    {
        $items = $request->get('items');
        
        foreach (DepartmentItem::getTypes() as $type) {
            $_items = array_get($items, $type);
            
            $data = array_get($_items, 'remove', []);
            $this->_removeItems($department, $data);
    
            $data = array_get($_items, 'old', []);
            $this->_updateExists($data);
    
            $data = array_get($_items, 'new', []);
            $this->_saveNew($department, $type, $data);
        }
    }
    
    /**
     * @param \App\Models\Department $model
     * @param array                  $data
     */
    private function _removeItems(Department $model, $data = [])
    {
        foreach ($data as $id) {
            try {
                $item = $model->items()->find($id);
                
                if ($item) {
                    $item->delete();
                }
            } catch (Exception $e) {
                FlashMessages::add("error", trans("messages.item destroy failure"." ".$id.". ".$e->getMessage()));
                
                continue;
            }
        }
    }
    
    /**
     * @param array $data
     */
    private function _updateExists($data = [])
    {
        foreach ($data as $key => $item) {
            try {
                $_item = DepartmentItem::findOrFail($key);
                
                $_item->update($item);
            } catch (Exception $e) {
                FlashMessages::add(
                    "error",
                    trans("messages.item update failure"." ".$item['address'].". ".$e->getMessage())
                );
                
                continue;
            }
        }
    }
    
    /**
     * @param \App\Models\Department $model
     * @param string                 $type
     * @param array                  $data
     */
    private function _saveNew(Department $model, $type, $data = [])
    {
        foreach ($data as $item) {
            try {
                $item = new DepartmentItem($item);
                $item->type = $type;
                
                $model->items()->save($item);
            } catch (Exception $e) {
                FlashMessages::add(
                    "error",
                    trans("messages.item save failure"." ".$item['address'].". ".$e->getMessage())
                );
                
                continue;
            }
        }
    }
}