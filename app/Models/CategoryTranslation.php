<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryTranslation
 * @package App\Models
 */
class CategoryTranslation extends Model
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description'];
}