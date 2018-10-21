<?php

namespace App\Models\Animals\Animals\Traits;

use App\Models\Animals\Characteristics\Characteristic;

trait Import
{

    public function saveImport($data, $calculation_base)
    {
        $this->long_name = $data['long_name'];
        $this->short_name = $data['short_name'];
        $this->save();
        $this->saveGeneral($data['general']);
        $this->saveDescendents($data['descendents']);
        $this->saveBreedingvalues($data['breedingvalues'], $calculation_base);
        $this->saveProduction($data['production'], $calculation_base);
        $this->saveExterior($data['exterior'], $calculation_base);
        $this->saveFeedIntake($data['feed-intake'], $calculation_base);
        $this->saveLifetimeProduction($data['lifetime-production'], $calculation_base);
        $this->saveOtherTraits($data['other-traits'], $calculation_base);
        $this->saveFunctionalTraits($data['functional-traits'], $calculation_base);
        $this->saveExteriorTraits($data['exterior-traits'], $calculation_base);
    }

    public function saveGeneral($data)
    {
        foreach($data as $i => $item)
        {
            Characteristic::saveCharacteristic($this->id, 'general', $item['caption'], $item['value'], NULL);
        }
    }

    public function saveDescendents($data)
    {
        foreach($data as $i => $item)
        {
            $this->{'save' . str_replace(' ', '', $item['caption']) }($item['value']['long_name'], $item['value']['interbull_code']);
        }
    }

    /**
     * Salvare father (sire)
     */
    public function saveSire($long_name, $interbull_code)
    {
        $father = self::where('interbull_code', $interbull_code)->first();
        if( ! $father )
        {
            $father = self::create([
                'interbull_code' => $interbull_code,
                'long_name' => $long_name,
                'type' => 'sire',
                'gender' => 'male',
                'animal_status' => 'inactiv',
            ]);
        }
        $this->father_id = $father->id;
        $this->save();
    }

    /**
     * Salvare mother (dam)
     */
    public function saveDam($long_name, $interbull_code)
    {
        $mother = self::where('interbull_code', $interbull_code)->first();
        if( ! $mother )
        {
            $mother = self::create([
                'interbull_code' => $interbull_code,
                'long_name' => $long_name,
                'type' => 'cow',
                'gender' => 'female',
                'animal_status' => 'inactiv',
            ]);
        }
        $this->mother_id = $mother->id;
        $this->save();
    }

    /**
     * Salvare tatal mamei (bunic din partea mamei = Maternal Grand Sire)
     */
    public function saveMaternalGrandSire($long_name, $interbull_code)
    {
       
        $grandfather = self::where('interbull_code', $interbull_code)->first();
        if( ! $grandfather )
        {
            $grandfather = self::create([
                'interbull_code' => $interbull_code,
                'long_name' => $long_name,
                'type' => 'sire',
                'gender' => 'male',
                'animal_status' => 'inactiv',
            ]);
        }
        $mother = self::where('id', $this->mother_id)->first();
        $mother->father_id = $grandfather->id;
        $mother->save();
    }

    public function saveBreedingvalues($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            if($item['caption'] != '&nbsp;')
            {
                Characteristic::saveCharacteristic($this->id, 'breeding-values', $item['caption'], $item['values'][0]['value'], $calculation_base,  $item['values'][1]['value']);
            }
        }
    }

    public function saveProduction($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            Characteristic::saveCharacteristic($this->id, 'production', $item['caption'], $item['value'], $calculation_base);
        }
    }

    public function saveExterior($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            Characteristic::saveCharacteristic($this->id, 'exterior', $item['caption'], $item['value'], $calculation_base);
        }
    }

    public function saveFeedIntake($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            Characteristic::saveCharacteristic($this->id, 'feed-intake', $item['caption'], $item['value'], $calculation_base);
        }
    }

    public function saveLifetimeProduction($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            Characteristic::saveCharacteristic($this->id, 'lifetime-production', $item['caption'], $item['value'], $calculation_base);
        }
    }

    public function saveOtherTraits($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            Characteristic::saveCharacteristic($this->id, 'other-traits', $item['caption'], $item['value'], $calculation_base);
        }
    }

    public function saveFunctionalTraits($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            if( ! $item['error'] )
            {
                Characteristic::saveCharacteristic($this->id, 'functional-traits', $item['caption'], $item['value'], $calculation_base, $item['percent']);
            }
        }
    }

    public function saveExteriorTraits($data, $calculation_base)
    {
        foreach($data as $i => $item)
        {
            if( ! $item['error'] )
            {
                Characteristic::saveCharacteristic($this->id, 'exterior-traits', $item['caption'], $item['value'], $calculation_base);
            }
        }
    }

}