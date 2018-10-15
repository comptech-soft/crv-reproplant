<?php

namespace App\Models\Locations\Localities\Traits;

trait Relations
{

    /**
     * Get the judet that owns the region.
     */
    public function judet()
    {
        return $this->belongsTo(\App\Models\Locations\Judete\Judet::class);
    }

}
