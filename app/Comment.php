<?php

namespace App;

use App\Traits\TraitUuid;
use App\Traits\TraitLike;
use App\Traits\TraitBookmark;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use TraitUuid, TraitLike, TraitBookmark;

    /**
     * All attributes that are mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

    public $incrementing = false;

    public function path()
    {
        return '@' . $this->user->username . '/' . text_limit($this->body, 9) . '/' . $this->id; 
    }

    public function createdAt()
    {
        return date('M d', strtotime($this->created_at)) . ' · ' . $this->created_at->diffForHumans();
    }

    public function createdAtShort()
    {
        return $this->created_at->diffForHumans();
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

    public function post()
    {
    	return $this->belongsTo('App\Post', 'post_id');
    }
}
