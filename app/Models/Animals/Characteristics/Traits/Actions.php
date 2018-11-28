<?php

namespace App\Models\Animals\Characteristics\Traits;

use App\Models\Animals\Parameters\Parameter;
use Sentinel;
use Exception;

trait Actions
{
    public static function saveCharacteristic($animal_id, $category, $caption, $value, $calculation_base, $percent = NULL)
    {
        $parameter = Parameter::where('category', $category)->where('caption', $caption)->first();
        if( ! $parameter )
        {
            $parameter = Parameter::create([
                'category' => $category,
                'caption' => $caption,
            ]);
        }
        if(! $calculation_base )
        {
            $characteristic = self::where('animal_id', $animal_id)->where('trait_id', $parameter->id)->whereNull('calculation_base')->first();
        }
        else
        {   
            $characteristic = self::where('animal_id', $animal_id)->where('trait_id', $parameter->id)->where('calculation_base', $calculation_base)->first();

        }
        try
        {
            if( ! $characteristic )
            {
                return self::create([
                    'animal_id' => $animal_id,
                    'trait_id' => $parameter->id,
                    'calculation_base' => $calculation_base,
                    'value' => $value,
                    'percent' => $percent,
                    'created_by' => Sentinel::check()->id,
                    'updated_by' => Sentinel::check()->id,
                ]);
            }
            return $characteristic->update([
                'calculation_base' => $calculation_base,
                'value' => $value,
                'percent' => $percent,
                'updated_by' => Sentinel::check()->id,
            ]);
        }
        catch(Exception $e)
        {
            dd([
                'animal_id' => $animal_id, 
                'category' => $category, 
                'caption' => $caption, 
                'value' => $value, 
                'calculation_base' => $calculation_base, 
                'percent' => $percent,
                'error' => $e->getMessage(),
            ]);
        }
    }
}