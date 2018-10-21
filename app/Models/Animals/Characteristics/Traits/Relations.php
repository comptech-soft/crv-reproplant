<?php

namespace App\Models\Animals\Characteristics\Traits;

trait Relations
{
    public function parameter()
    {
        return $this->belongsTo(\App\Models\Animals\Parameters\Parameter::class, 'trait_id');
    }
}