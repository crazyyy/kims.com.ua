<?php namespace App\Models;

use App\Traits\Models\WithTranslationsTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    
    use Translatable;
    use WithTranslationsTrait;
    
    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'price'];
    
    /**
     * @var array
     */
    protected $fillable = [
        'category_id',
        'price',
        'status',
        'position',
        'name',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->with('translations');
    }
    
    /**
     * @param int $value
     */
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = empty($value) ? null : (int) $value;
    }
    
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
     * @param string      $department_id
     * @param string|null $locale
     *
     * @return int|string
     */
    public function priceForDepartment($department_id, $locale = null)
    {
        $locale = empty($locale) ? app()->getLocale() : $locale;
        
        $prices = empty($this->translate($locale)) ? [] : $this->translate($locale)->price;
        $department_id = (string) $department_id;
        
        return isset($prices[$department_id]) ? $prices[$department_id] : 0;
    }
}
