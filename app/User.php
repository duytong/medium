<?php

namespace App;

use App\Traits\TraitUuid;
use App\Traits\TraitFollowable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use TraitUuid, TraitFollowable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $incrementing = false;

    public function path()
    {
        return '@' . $this->username;
    }

    public function pathImage()
    {
        return 'storage/users/' . $this->avatar;
    }

    public function createdAt()
    {
        return date('M Y', strtotime($this->created_at));
    }

    public function socials()
    {
        return $this->hasMany('App\Social');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get all of the users followed by a particular user.
     */
    public function users()
    {
        return $this->morphedByMany('App\User', 'followable');
    }

    public function follower()
    {
        return $this->morphedByMany('App\User', 'followable', 'followables', 'followable_id', 'user_id');
    }

    public function following()
    {
        return $this->morphedByMany('App\User', 'followable', 'followables', 'user_id', 'followable_id');
    }

    public function follow(User $user)
    {
        return $this->users()->attach($user->id);
    }

    public function unfollow(User $user)
    {
        return $this->users()->detach($user->id);
    }

    public function isFollowing(User $user)
    {
        return $this->users()->where('followable_id', $user->id)->exists();
    }

    /**
     * Get all of the topics subscribed by a particular user.
     */
    public function topics()
    {
        return $this->morphedByMany('App\Topic', 'followable');
    }

    public function subscribe(Topic $topic)
    {
        return $this->topics()->attach($topic->id);
    }

    public function unsubscribe(Topic $topic)
    {
        return $this->topics()->detach($topic->id);
    }

    public function subscribed(Topic $topic)
    {
        return $this->topics()->where('followable_id', $topic->id)->exists();
    }
}
