<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 14.02.17
 * Time: 11:28
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentCategory
 * @package App\Models
 */
class DepartmentCategory extends Model
{
    
    /**
     * @var array
     */
    protected $fillable = [
        'department_id',
        'category_id',
        'position',
        'status',
    ];
}