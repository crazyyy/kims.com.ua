<?php namespace App\Models;

use App\Traits\Models\WithTranslationsTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Share
 * @package App\Models
 */
class Share extends Model
{
    
    use Translatable;
    use WithTranslationsTrait;
    
    /**
     * @var array
     */
    public $translatedAttributes = ['name', 'description', 'image'];
    
    /**
     * @var array
     */
    protected $fillable = [
        'department_id',
        'name',
        'description',
        'image',
        'status',
    ];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contaminants()
    {
        return $this->hasMany(Contaminant::class, 'share_id')->with('translations');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class)->with('translations');
    }
    
    /**
     * @param int $value
     */
    public function setDepartmentIdAttribute($value)
    {
        $this->attributes['department_id'] = empty($value) ? null : (int) $value;
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
     * @return string
     */
    public function getDepartmentName()
    {
        return empty($this->department_id) ? '' : $this->department->name;
    }
}
