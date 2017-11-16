<?php

namespace App;

use App\Traits\TraitUuid;
use App\Traits\TraitLike;
use App\Traits\TraitBookmark;
use App\Traits\TraitImageError;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use TraitUuid, TraitLike, TraitBookmark, TraitImageError;

    public $incrementing = false;

	public function path()
	{
		return '@' . $this->user->username . '/' . $this->slug;
	}

    public function createdAt()
    {
        return date('M d', strtotime($this->created_at)) . ' · ' . $this->created_at->diffForHumans();
    }

    public function createdAtShort()
    {
        return date('M d, Y', strtotime($this->created_at));
    }

    public function updatedAt()
    {
        return date('M d', strtotime($this->updated_at)) . ' · ' . $this->updated_at->diffForHumans();
    }

    public function pathImage()
    {
        return 'storage/posts/' . $this->image;
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function pathUser()
    {
        return $this->user->path();
    }

    public function pathImageUser()
    {
        return $this->user->pathImage();
    }

    public function createdAtUser()
    {
        return date('M Y', strtotime($this->created_at));
    }

    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
