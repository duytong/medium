<?php

namespace App;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use TraitUuid;

    /**
     * All attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $incrementing = false;

    public function bookmarkable()
    {
        return $this->morphTo();
    }

    public function createdAt()
    {
        return date('M d', strtotime($this->created_at)) . ' · ' . $this->created_at->diffForHumans();
    }
}
