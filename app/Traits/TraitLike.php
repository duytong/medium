<?php

namespace App\Traits;

trait TraitLike {
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

	public function like()
    {
        return $this->likes()->create(['user_id' => auth()->id()]);
    }

    public function liked()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function getLikeIdAttribute()
    {
       return $this->likes()->where('user_id', auth()->id())->value('id');
    }
}
