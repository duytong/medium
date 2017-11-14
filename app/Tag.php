<?php

namespace App;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use TraitUuid;

    /**
     * All attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $incrementing = false;

    public function path()
    {
    	return 'tag/' . $this->slug;
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
