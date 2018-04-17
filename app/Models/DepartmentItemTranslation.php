<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:43
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentItemTranslation
 * @package App\Models
 */
class DepartmentItemTranslation extends Model
{
    
    /**
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * @var array
     */
    protected $fillable = [
        'address',
        'description',
        'work_schedule',
    ];
}