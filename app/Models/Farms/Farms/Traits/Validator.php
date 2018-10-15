<?php

namespace App\Models\Farms\Farms\Traits;

trait Validator
{
    protected static function Rules($action, $record = NULL)
    {
        if($action == 'delete')
        {
            return [];
        }
        $result = [
            'name' => 'required|max:128|unique:companies,name',
            'type' => 'required',
        ];
        if($record['email'])
        {
            $result['email'] = 'email';
        }
        if( $action == 'update')
        {
            $result['name'] .= (',' . $record['id']);
        }
        return $result;
    }

	protected static function Messages($action)
    {
        return [
            'name.required' => 'Numele companiei trebuie completat.',
            'name.max' => 'Numele companiei nu poate conține mai mult de 128 caractere.',
            'name.unique' => 'Numele companiei este deja înregistrat.',

            'type.required' => 'Categoria companiei trebuie completată.',

            'email.email' => 'Adresa de email nu pare să fie corectă.',
        ];
    }

}
