<?php

namespace App;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TraitUuid;

    /**
     * All attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $incrementing = false;

    public function topics()
    {
    	return $this->hasMany('App\Topic');
    }
}
