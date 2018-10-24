<?php

namespace App\Models\Animals\Companies\Traits;

trait Validator
{
    protected static function Rules($action, $record = NULL)
    {
        if($action == 'delete')
        {
            return [];
        }
        $result = [
            'name' => 'required|unique:companies,name',
        ];
        if( $action == 'update')
        {
            $result['name'] .= (',' . $record['id']);
        }
        return $result;
    }

	protected static function Messages($action)
    {
        return [
            'name.required' => 'Completaţi  numele firmei.',
            'name.unique' => 'Numele firmei este deja înregistrat.',
        ];
    }

}
