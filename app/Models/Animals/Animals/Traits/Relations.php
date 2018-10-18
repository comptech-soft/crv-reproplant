<?php

namespace App\Models\Animals\Animals\Traits;

trait Relations
{

    /**
     * Ce rasa are animalul
     */
    public function rasa()
    {
        return $this->belongsTo(\App\Models\Animals\Breeds\Breed::class, 'breed_id');
    }

    /**
     * ce companie are animalul
     */
    public function company()
    {
        return $this->belongsTo(\App\Models\Animals\Companies\Company::class, 'company_id');
    }

    /**
     * ce tata are animalul
     */
    public function father()
    {
        return $this->belongsTo(\App\Models\Animals\Animals\Animal::class, 'father_id');
    }

    /**
     * ce mama are animalul
     */
    public function mother()
    {
        return $this->belongsTo(\App\Models\Animals\Animals\Animal::class, 'mother_id');
    }

}
