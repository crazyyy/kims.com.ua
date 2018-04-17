<?php
/**
 * Created by Newway, info@newway.com.ua
 * User: ddiimmkkaass, ddiimmkkaass@gmail.com
 * Date: 29.08.15
 * Time: 15:53
 */

namespace App\Models;

use App\Traits\Models\WithTranslationsTrait;
use Dimsav\Translatable\Translatable;
use Eloquent;

/**
 * Class Contaminant
 * @package App\Models
 */
class Contaminant extends Eloquent
{

    use Translatable;
    use WithTranslationsTrait;

    /**
     * @var array
     */
    public $translatedAttributes = [
        'name',
        'description',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'share_id',
        'name',
        'description',
        'class',
        'status',
        'default',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function share()
    {
        return $this->belongsTo(Share::class, 'share_id')->with('translations');
    }

    /**
     * @param int $value
     */
    public function setShareIdAttribute($value)
    {
        $this->attributes['share_id'] = empty($value) ? null : (int) $value;
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
}