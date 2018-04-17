<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DepartmentTranslation
 * @package App\Models
 */
class DepartmentTranslation extends Model
{

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'address', 'description'];
}