<?php namespace App\Models;

use App\Traits\Models\WithTranslationsTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * @package App\Models
 */
class Department extends Model
{
    
    use Translatable;
    use WithTranslationsTrait;
    
    /**
     * @var array
     */
    protected $with = ['translations'];
    
    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'address', 'description'];
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'description',
        'latitude',
        'longitude',
        'status',
        'phone',
        'image',
        'email',
    ];
    
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where('status', true);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shares()
    {
        return $this->hasOne('App\Models\Share', 'department_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(DepartmentItem::class)->positionSorted();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visible_items()
    {
        return $this->items()->visible();
    }
}
