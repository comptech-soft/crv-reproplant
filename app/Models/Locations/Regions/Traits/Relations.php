<?php

namespace App\Models\Locations\Regions\Traits;

trait Relations
{

    /**
     * Get the country that owns the region.
     */
    public function country()
    {
        return $this->belongsTo(\App\Models\Locations\Countries\Country::class);
    }

    /**
     * Get the judete for a region.
     */
    public function judete()
    {
        return $this->hasMany(\App\Models\Locations\Judete\Judet::class);
    }

}
