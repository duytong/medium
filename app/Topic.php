<?php

namespace App;

use App\Traits\TraitUuid;
use App\Traits\TraitFollowable;
use App\Traits\TraitImageError;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use TraitUuid, TraitFollowable, TraitImageError;

    public $incrementing = false;

    public function path()
    {
        return 'topic/' . $this->slug;
    }

    public function pathImage()
    {
        return 'storage/topics/' . $this->image;
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function posts()
    {
    	return $this->hasMany('App\Post');
    }
}
