<?php

namespace App;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	use TraitUuid;

	/**
     * All attributes that are mass assignable.
     *
     * @var array
     */
	protected $guarded = [];

    public $incrementing = false;
	
	public function likeable()
    {
        return $this->morphTo();
    }
}
