<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 07.12.16
 * Time: 12:10
 */

namespace App\Libraries\Import;

use App\Contracts\ImportProvider;
use App\Models\Category;
use App\Models\Department;
use App\Models\DepartmentCategory;
use App\Models\Product;
use App\Models\ProductTranslation;

/**
 * Class AbstractClassImportProvider
 * @package App\Libraries\Import
 */
abstract class AbstractClassImportProvider implements ImportProvider
{
    /**
     * @var array
     */
    public $errors;
    
    /**
     * @param string $department_name
     *
     * @return int|null
     */
    public function getDepartmentIdByName($department_name)
    {
        $department = Department::joinTranslations()
            ->where('department_translations.name', $department_name)
            ->select('departments.id')
            ->first();
        
        return $department ? $department->id : null;
    }
    
    /**
     * @param int $department_id
     */
    public function hideDepartmentPrices($department_id)
    {
        foreach (ProductTranslation::where('price', 'LIKE', '%"'.$department_id.'":%')->get() as $service) {
            $prices = $service->price;
            
            unset($prices[$department_id]);
            
            $service->price = $prices;
            
            $service->save();
        }
        
        DepartmentCategory::where('department_id', $department_id)->update(
            [
                'status' => false,
            ]
        );
    }
    
    /**
     * @param string $catalog_name
     *
     * @return int
     */
    public function getCatalogIdByName($catalog_name)
    {
        return $this->getCategoryId($catalog_name);
    }
    
    /**
     * @param string $category_path
     * @param int    $catalog_id
     * @param int    $department_id
     * @param array  $categories_translations
     * @param int    $row
     *
     * @return int
     */
    public function getCategoryIdByCategoryPath(
        $category_path,
        $catalog_id,
        $department_id,
        $categories_translations,
        $row
    ) {
        $parent_id = $catalog_id;
        
        foreach (explode(';', $category_path) as $level => $category_name) {
            $category_name = trim($category_name);
            
            if (!empty($category_name)) {
                $translations = empty($categories_translations[$level]) ?
                    $category_name :
                    $categories_translations[$level];
    
                $parent_id = $this->getCategoryId(
                    $category_name,
                    $translations,
                    [
                        'department_id' => $department_id,
                        'parent_id'     => $parent_id,
                        'level'         => $level + 1,
                        'position'      => (int) ($row.$level),
                    ]
                );
            }
        }
        
        return $parent_id;
    }
    
    /**
     * @param string $category_name
     * @param array  $translation
     * @param array  $data [department_id, parent_id, level, position]
     *
     * @return int
     */
    private function getCategoryId($category_name, $translation = [], $data = [])
    {
        $data['parent_id'] = empty($data['parent_id']) ? null : $data['parent_id'];
        $data['level'] = empty($data['level']) ? 0 : $data['level'];
        
        $category = Category::joinTranslations()
            ->where('category_translations.name', 'LIKE', $category_name)
            ->where('categories.parent_id', $data['parent_id'])
            ->select('categories.id')
            ->first();
        
        if (!$category) {
            $category = $this->_createCategory(
                array_merge(
                    $translation,
                    [
                        'parent_id' => $data['parent_id'],
                        'level'     => $data['level'],
                    ]
                )
            );
            
            if (isset($data['position'])) {
                DepartmentCategory::updateOrCreate(
                    [
                        'department_id' => $data['department_id'],
                        'category_id'   => $category->id,
                    ],
                    [
                        'position' => $data['position'],
                        'status'   => true,
                    ]
                );
            }
        } else {
            if (count($translation)) {
                $category->fill($translation);
                $category->save();
            }
            
            if (isset($data['position'])) {
                DepartmentCategory::updateOrCreate(
                    [
                        'department_id' => $data['department_id'],
                        'category_id'   => $category->id,
                    ],
                    [
                        'position' => $data['position'],
                        'status'   => true,
                    ]
                );
            }
        }
        
        return $category->id;
    }
    
    /**
     * @param array $data
     *
     * @return \App\Models\Product
     */
    public function saveService($data)
    {
        $service = $this->getService($data);
        
        if (!$service) {
            $service = $this->_createService($data);
        } else {
            foreach (config('app.locales') as $locale) {
                $translation = $service->translate($locale);
                
                if ($translation) {
                    $translation->name = $data[$locale]['name'];
                    
                    $prices = $translation->price;
                    $prices[$data['department_id']] = $data[$locale]['price'][$data['department_id']];
                    $translation->price = $prices;
                    
                    $translation->save();
                } else {
                    $service->fill(
                        [
                            $locale => $data[$locale],
                        ]
                    );
                }
            }
            
            $service->save();
        }
        
        return $service;
    }
    
    /**
     * @param array $service
     *
     * @return Product|null
     */
    public function getService($service)
    {
        return Product::joinTranslations()
            ->where('product_translations.name', 'LIKE', $service['service'])
            ->where('products.category_id', $service['category_id'])
            ->select('products.*')
            ->first();
    }
    
    /**
     * @param $string
     */
    public function error($string)
    {
        $this->errors[] = $string;
    }
    
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * @param array $data
     *
     * @return Category
     */
    private function _createCategory($data)
    {
        $category = new Category($data);
        $category->save();
        
        return $category;
    }
    
    /**
     * @param array $service
     *
     * @return Product
     */
    private function _createService($service)
    {
        $product = new Product($service);
        $product->save();
        
        return $product;
    }
}