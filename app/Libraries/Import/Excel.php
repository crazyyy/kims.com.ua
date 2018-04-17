<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 07.12.16
 * Time: 12:07
 */

namespace App\Libraries\Import;

use Excel as LaravelExcel;
use Exception;
use Illuminate\Http\UploadedFile;
use Log;

/**
 * Class Excel
 * @package App\Libraries\Import
 */
class Excel extends AbstractClassImportProvider
{
    
    /**
     * @param UploadedFile $file
     */
    public function import($file)
    {
        LaravelExcel::load(
            $file,
            function ($reader) {
                foreach ($reader->get() as $sheet) {
                    $department_name = title_case($sheet->getTitle());
                    
                    $department_id = $this->getDepartmentIdByName($department_name);
                    
                    if (!$department_id) {
                        $this->error(
                            trans('messages.department ":department" not found', ['department' => $department_name])
                        );
                        
                        continue;
                    }
                    
                    $this->hideDepartmentPrices($department_id);
                    
                    $rows = $sheet->toArray();
                    $keys = array_shift($rows);
                    
                    Log::debug('start importing services for department "'.$department_name.'"" #'.$department_id);
                    
                    $this->_process($keys, $rows, $department_id);
                    
                    unset($rows, $sheet);
                    
                    Log::debug('end importing services for department "'.$department_name.'" #'.$department_id."\n\n");
                };
                
                unset($reader);
            }
        );
    }
    
    /**
     * @param array $keys
     * @param array $rows
     * @param int   $department_id
     */
    private function _process($keys, $rows, $department_id)
    {
        foreach ($rows as $key => $row) {
            try {
                $service = [];
                
                $row = array_combine($keys, $row);
                
                unset($rows[$key]);
                
                if (empty($row['service']) || empty($row['category']) || empty($row['catalog'])) {
                    $this->error(
                        'error service import (empty data on line: '.
                        $key.', sheet: '.$department_id.'), row: '.array_to_str($row)
                    );
                    
                    continue;
                }
                
                $service = $this->_prepareData($row, $department_id, $key);
                
                Log::debug('prepared service', $service);
                
                $this->saveService($service);
            } catch (Exception $e) {
                $message = 'message: '.$e->getMessage().', line: '.$e->getLine().', file: '.$e->getFile();
                
                $this->error(
                    'error service import '.$row['service'].
                    (
                    isset($service) ?
                        ', service: '.array_to_str($service) :
                        ', catalog '.$row['catalog'].', category '.$row['category']
                    ).
                    ', error: '.$message
                );
                
                Log::error('error import service', ['row' => $row, 'service' => (array) $service, 'error' => $message]);
            }
        }
    }
    
    /**
     * @param array $data
     * @param int   $department_id
     * @param int   $row
     *
     * @return array
     */
    public function _prepareData($data, $department_id, $row)
    {
        $service = [];
        
        $data['service'] = $service['service'] = trim($data['service']);
        $data['category'] = trim($data['category']);
    
        $categories_translations = [];
        
        foreach (config('app.locales') as $locale) {
            $categories = explode(
                ';',
                empty($data[$locale.'_category']) ?
                    $data['category'] :
                    $data[$locale.'_category']
            );
    
            foreach ($categories as $key => $category) {
                $categories_translations[$key][$locale] = [
                    'name' => trim($category),
                ];
            }
        }
        
        $catalog_id = $this->getCatalogIdByName(trim($data['catalog']));
        $service['category_id'] = $this->getCategoryIdByCategoryPath(
            $data['category'],
            $catalog_id,
            $department_id,
            $categories_translations,
            $row
        );
        
        foreach (config('app.locales') as $locale) {
            $name = empty($data[$locale.'_service']) ?
                $data['service'] :
                $data[$locale.'_service'];
    
            $price = empty($data[$locale.'_price']) ?
                $data['price'] :
                $data[$locale.'_price'];
            
            $service[$locale] = [
                'name'  => trim($name),
                'price' => [
                    $department_id => trim($price),
                ],
            ];
        }
        
        $service['department_id'] = $department_id;
        
        return $service;
    }
}