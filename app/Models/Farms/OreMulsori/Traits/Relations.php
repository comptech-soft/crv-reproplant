<?php

namespace App\Models\Farms\OreMulsori\Traits;

trait Relations
{

    /**
     * ferma
     */
    public function farm()
    {
        return $this->belongsTo(\App\Models\Farms\Farms\Farm::class, 'farm_id');
    }

}
