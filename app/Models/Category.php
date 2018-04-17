<?php namespace App\Models;

use App\Traits\Models\WithTranslationsTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Models
 */
class Category extends Model
{
    
    use Translatable;
    use WithTranslationsTrait;
    
    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'description'];
    
    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'status',
        'position',
        'name',
        'description',
        'image',
        'level',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('translations', 'parent');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('translations', 'childs')->positionSorted();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visible_childs()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('translations', 'visible_childs')
            ->visible()
            ->positionSorted();
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->with('translations');
    }
    
    /**
     * @param $value
     */
    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = empty($value) ? null : (int) $value;
    }
    
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeJoinDepartmentCategories($query)
    {
        return $query->leftJoin('department_categories', 'department_categories.category_id', '=', 'categories.id');
    }
    
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeVisible($query)
    {
        return $query->where($this->getTable().'.status', true);
    }
    
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeParents($query)
    {
        return $query->whereNull($this->getTable().'.parent_id');
    }
    
    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeChild($query)
    {
        return $query->whereNotNull($this->getTable().'.parent_id');
    }
    
    /**
     * @param        $query
     * @param string $order
     *
     * @return mixed
     */
    public function scopePositionSorted($query, $order = 'ASC')
    {
        return $query->orderBy($this->getTable().'.position', $order);
    }
}
