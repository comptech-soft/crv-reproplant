<?php

namespace App\Models\Locations\Judete\Traits;

trait Relations
{

    /**
     * Get the judet that owns the region.
     */
    public function region()
    {
        return $this->belongsTo(\App\Models\Locations\Regions\Region::class);
    }

    /**
     * Get the localities for a judet.
     */
    public function localities()
    {
        return $this->hasMany(\App\Models\Locations\Localities\Locality::class);
    }

}
