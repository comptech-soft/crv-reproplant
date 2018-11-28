<?php

namespace App\Models\Farms\Animals\Traits;


trait Relations
{
    public function animal()
	{
		return $this->belongsTo(\App\Models\Animals\Animals\Animal::class, 'animal_id');
	}
}