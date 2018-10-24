<?php

namespace App\Models\Animals\Animals\Traits;

use Illuminate\Http\Request;
use Sentinel;
use Carbon\Carbon;
use Comptechsoft\Helpers\App\Response;
use DB;
use App\Models\App\Log\Action;

trait Actions
{

    protected static function InsertRecord($user_id, $record)
    {
        $record = self::create($data = [
            'type' => $record['type'],
            'gender' => $record['gender'],
            'animal_status' => $record['animal_status'],

            'long_name' => $record['long_name'],
            'short_name' => $record['short_name'],

            'interbull_code' => $record['interbull_code'],
            'naab' => $record['naab'],
            'matricol_number' => $record['matricol_number'],
            'cod_ro' => $record['cod_ro'],
            
            'birth_date' => $record['birth_date'] ? Carbon::createFromFormat('d.m.Y', $record['birth_date'])->format('Y-m-d') : NULL,
            'breed_id' => $record['breed_id'],
            'color_id' => $record['color_id'],
            'company_id' => $record['company_id'],
            
            'father_id' => $record['father_id'],
            'mother_id' => $record['mother_id'],
            
            'created_at' => Carbon::now(),
            'created_by' => $user_id,
            'updated_at' => Carbon::now(),
            'updated_by' => $user_id,
        ]);
        return $record;
    }

    protected static function UpdateRecord($user_id, $current, $record)
    {
        $current->update([
            'type' => $record['type'],
            'gender' => $record['gender'],
            'animal_status' => $record['animal_status'],

            'long_name' => $record['long_name'],
            'short_name' => $record['short_name'],

            'interbull_code' => $record['interbull_code'],
            'naab' => $record['naab'],
            'matricol_number' => $record['matricol_number'],
            'cod_ro' => $record['cod_ro'],
            
            'birth_date' => $record['birth_date'] ? Carbon::createFromFormat('d.m.Y', $record['birth_date'])->format('Y-m-d') : NULL,
            'breed_id' => $record['breed_id'],
            'color_id' => $record['color_id'],
            'company_id' => $record['company_id'],
            
            'father_id' => $record['father_id'],
            'mother_id' => $record['mother_id'],

            'updated_by' => $user_id,
        ]);
        return self::getRecord($current->id);
    }

    protected static function DeleteRecord($user_id, $current, $record)
    {
        $current->update([
            'deleted_by' => $user_id,
        ]);
        $current->delete();
        return $current;
    }

    protected static function getRecord($id)
    {
        return self::where('id', $id)->with(['rasa', 'company', 'father.father', 'father.mother', 'mother.father', 'mother.mother'])->first();
    }

}
