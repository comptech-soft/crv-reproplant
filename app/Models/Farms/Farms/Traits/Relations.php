<?php

namespace App\Models\Farms\Farms\Traits;

trait Relations
{

    /**
     * Viziunea companiei
     */
    public function locality()
    {
        return $this->belongsTo(\App\Models\Locations\Localities\Locality::class, 'locality_id');
    }

}
