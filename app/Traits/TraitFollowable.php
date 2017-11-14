<?php

namespace App\Traits;

trait TraitFollowable {
    /**
     * Get all of the objects is following for the user.
     */
    public function followers()
    {
        return $this->morphToMany('App\User', 'followable');
    }
}
