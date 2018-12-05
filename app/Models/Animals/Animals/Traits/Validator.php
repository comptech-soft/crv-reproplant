<?php

namespace App\Models\Animals\Animals\Traits;

trait Validator
{
    protected static function Rules($action, $record = NULL)
    {
        if($action == 'delete')
        {
            return [];
        }

        if( $record['type'] == 'sire' )
        {
            $result = [
                'type' => 'in:sire,cow',
                'gender' => 'in:male,female',
                'animal_status' => 'in:valid,invalid,adaugat-ferma',

                'names' => 'required',
                'codes' => 'required',

                'interbull_code' => 'nullable|sometimes|unique:animals,interbull_code',
                'naab' => 'nullable|sometimes|unique:animals,naab',
                'matricol_number' => 'nullable|sometimes|unique:animals,matricol_number',
                'cod_ro' => 'nullable|sometimes|unique:animals,cod_ro',
            ];
            if( $action == 'update')
            {
                $result['interbull_code'] .= (',' . $record['id']);
                $result['naab'] .= (',' . $record['id']);
                $result['matricol_number'] .= (',' . $record['id']);
                $result['cod_ro'] .= (',' . $record['id']);
            }
            return $result;
        }
        $result = [
            'type' => 'in:sire,cow',
            'gender' => 'in:male,female',
            'animal_status' => 'in:valid,invalid,adaugat-ferma',
            'interbull_code' => 'nullable|sometimes|unique:animals,interbull_code',
        ];
        if( $action == 'update')
        {
            $result['matricol_number'] .= (',' . $record['id']);
        }
        return $result;
    }

	protected static function Messages($action)
    {
        return [
            'names.required' => 'Completaţi cel puţin un nume (nume sau nume scurt).',
            'codes.required' => 'Completaţi cel puţin un cod de identificare (cod interbull, număr matricol, naab sau cod ro).',

            'interbull_code.unique' => 'Codul interbull este deja înregistrat.',
            'naab.unique' => 'Codul NAAB este deja înregistrat.',
            'matricol_number.unique' => 'Codul matricol este deja înregistrat.',
            'cod_ro.unique' => 'Codul RO  este deja înregistrat.',
        ];
    }

}
