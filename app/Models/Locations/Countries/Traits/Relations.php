<?php

namespace App\Models\Locations\Countries\Traits;

trait Relations
{

    /**
     * Get the regions for a  country.
     */
    public function regions()
    {
        return $this->hasMany(\App\Models\Locations\Regions\Region::class);
    }

}
