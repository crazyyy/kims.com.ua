<?php namespace App\Models;

use Eloquent;

/**
 * Class ProductTranslation
 * @package App\Models
 */
class ProductTranslation extends Eloquent
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'price'];
    
    /**
     * @var array
     */
    protected $casts = ['price' => 'array'];
}