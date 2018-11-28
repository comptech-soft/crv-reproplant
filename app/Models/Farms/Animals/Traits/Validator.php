<?php

namespace App\Models\Farms\Animals\Traits;

trait Validator
{
    protected static function Rules($action, $record = NULL)
    {
        if($action == 'delete')
        {
            return [];
        }
        $result = [
            'farm_id' => 'required|max:191|exists:farms,id',
        ];
        if( ! array_key_exists('animal_required', $record) || $record['animal_required'])
        {
            $result['animal_id'] = 'required|exists:animals,id';
        }
        return $result;
    }

	protected static function Messages($action)
    {
        return [
            'farm_id.required' => 'Numele fermei trebuie completat.',
            'animal_id.required' => 'Animalul trebuie completat.',
        ];
    }

}
