<?php

namespace App\Traits;

trait TraitBookmark {
    public function bookmarks()
    {
        return $this->morphMany('App\Bookmark', 'bookmarkable');
    }

	public function bookmark()
    {
        return $this->bookmarks()->create(['user_id' => auth()->id()]);
    }

    public function bookmarked()
    {
        return $this->bookmarks()->where('user_id', auth()->id())->exists();
    }

    public function getBookmarkIdAttribute()
    {
        return $this->bookmarks()->where('user_id', auth()->id())->value('id');
    }
}
