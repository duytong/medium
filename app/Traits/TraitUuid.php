<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait TraitUuid {
	public static function boot()
	{
		parent::boot();
		static::creating(function ($model) {
			$model->{ $model->getKeyName() } = Uuid::generate()->string;
		});
	}
}
