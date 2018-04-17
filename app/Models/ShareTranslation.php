<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ShareTranslation
 * @package App\Models
 */
class ShareTranslation extends Model
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'image'];
}