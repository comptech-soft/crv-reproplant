<?php

namespace App\Models\Locations\Countries\Traits;

trait Validator
{
    protected static function Rules($action, $record = NULL)
    {
        if($action == 'delete')
        {
            return [];
        }
        $result = [
            'name' => 'required|max:128|unique:geo_countries,name',
            'code' => 'required|max:2|unique:geo_countries,code',
        ];
        if( $action == 'update')
        {
            $result['name'] .= (',' . $record['id']);
            $result['code'] .= (',' . $record['id']);
        }
        return $result;
    }

	protected static function Messages($action)
    {
        return [
            'name.required' => 'Numele țării trebuie completat.',
            'name.max' => 'Numele țării nu poate conține mai mult de 128 caractere.',
            'name.unique' => 'Numele țării este deja înregistrat.',

            'code.required' => 'Codul țării trebuie completat.',
            'code.max' => 'Codul țării nu poate conține mai mult de 128 caractere.',
            'code.unique' => 'Codul țării este deja înregistrat.',
        ];
    }

}
