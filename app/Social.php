<?php

namespace App;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use TraitUuid;

    /**
     * All attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public $incrementing = false;

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
