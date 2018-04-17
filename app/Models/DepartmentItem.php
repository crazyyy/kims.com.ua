<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:43
 */

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentItem
 * @package App\Models
 */
class DepartmentItem extends Model
{
    
    use Translatable;
    
    /**
     * @var array
     */
    protected $with = ['translations'];
    
    /**
     * @var array
     */
    public $translatedAttributes = ['address', 'description', 'work_schedule'];
    
    /**
     * @var array
     */
    protected $fillable = [
        'department_id',
        'address',
        'description',
        'work_schedule',
        'phones',
        'latitude',
        'longitude',
        'status',
        'position',
    ];
    
    /**
     * @var array
     */
    protected static $types = [
        'dry_cleaner',
        'shoe_repair',
        'reception',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    /**
     * @param        $query
     * @param string $type
     *
     * @return mixed
     */
    public function scopeOf($query, $type)
    {
        return $query->where('type', $type);
    }
    
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->whereStatus(true);
    }
    
    /**
     * @param        $query
     * @param string $order
     *
     * @return mixed
     */
    public function scopePositionSorted($query, $order = 'ASC')
    {
        return $query->orderBy('position', $order);
    }
    
    /**
     * @return string
     */
    public function getPhones()
    {
        $lines = explode("\n", $this->phones);
        
        return count($lines) ? implode("<br>", $lines) : '';
    }
    
    /**
     * @return string
     */
    public function getWorkSchedule()
    {
        $lines = explode("\n", $this->work_schedule);
        
        return count($lines) ? implode("<br>", $lines) : '';
    }
    
    /**
     * @return array
     */
    public static function getTypes()
    {
        return self::$types;
    }
}