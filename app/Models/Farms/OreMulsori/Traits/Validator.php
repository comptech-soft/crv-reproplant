<?php

namespace App\Models\Farms\OreMulsori\Traits;

trait Validator
{
    // protected static function Rules($action, $record = NULL)
    // {
    //     if($action == 'delete')
    //     {
    //         return [];
    //     }
    //     $result = [
    //         'farm' => 'required|max:191|unique:farms,farm',
    //     ];
    //     if($record['email'])
    //     {
    //         $result['email'] = 'email';
    //     }
    //     if( $action == 'update')
    //     {
    //         $result['farm'] .= (',' . $record['id']);
    //     }
    //     return $result;
    // }

	// protected static function Messages($action)
    // {
    //     return [
    //         'farm.required' => 'Numele fermei trebuie completat.',
    //         'farm.max' => 'Numele fermei nu poate conține mai mult de 191 caractere.',
    //         'farm.unique' => 'Numele fermei este deja înregistrat.',

    //         'email.email' => 'Adresa de email nu pare să fie corectă.',
    //     ];
    // }

}
