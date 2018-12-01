<?php

namespace App\Models\Farms\Animals\Traits;

// use Illuminate\Http\Request;
// use Sentinel;
use Carbon\Carbon;
// use Comptechsoft\Helpers\App\Response;
// use DB;
// use App\Models\App\Log\Action;
use App\Models\Animals\Animals\Animal;

trait Actions
{

    protected static function InsertRecord($user_id, $record)
    {
        
        if( array_key_exists('animal_id', $record) )
        {
            $animal_id = $record['animal_id'];
        }
        else 
        {
            $animal = Animal::findByCode(NULL, $record['matricol_number'], NULL, NULL);
            if( ! $animal )
            {
                $animal = Animal::create([
                    'type' => $record['type'],
                    'gender' => $record['gender'],
                    'animal_status' => $record['animal_status'],
                    'matricol_number' => $record['matricol_number'],
                    'birth_date' => $record['birth_date'] ? Carbon::createFromFormat('d.m.Y', $record['birth_date'])->format('Y-m-d') : NULL,
                    'last_calving_date' => $record['last_calving_date'] ? Carbon::createFromFormat('d.m.Y', $record['last_calving_date'])->format('Y-m-d') : NULL,
                    'breed_id' => $record['breed_id'],                  
                    'father_id' => $record['father_id'],
                    'mother_id' => $record['mother_id'],
                    'created_at' => Carbon::now(),
                    'created_by' => $user_id,
                    'updated_at' => Carbon::now(),
                    'updated_by' => $user_id,
                ]);
            }
            else
            {
                $animal->update([
                    'type' => $record['type'],
                    'gender' => $record['gender'],
                    'animal_status' => $record['animal_status'],
                    'matricol_number' => $record['matricol_number'],
                    'birth_date' => $record['birth_date'] ? Carbon::createFromFormat('d.m.Y', $record['birth_date'])->format('Y-m-d') : NULL,
                    'last_calving_date' => $record['last_calving_date'] ? Carbon::createFromFormat('d.m.Y', $record['last_calving_date'])->format('Y-m-d') : NULL,
                    'breed_id' => $record['breed_id'],                  
                    'father_id' => $record['father_id'],
                    'mother_id' => $record['mother_id'],
                    'updated_at' => Carbon::now(),
                    'updated_by' => $user_id,
                ]);
            }
            $animal_id = $animal->id;
        }
        $animal_in_farm = self::where('farm_id', $record['farm_id'])->where('animal_id', $animal_id)->first();
        if( ! $animal_in_farm )
        {
            $record = self::insert($data = [
                'farm_id' => $record['farm_id'],
                'animal_id' => $animal_id,
                'status_in_farm' => $record['status_in_farm'],
                'short_number' => $record['short_number'],
                'internal_number' => $record['internal_number'],
                'created_at' => Carbon::now(),
                'created_by' => $user_id,
                'updated_at' => Carbon::now(),
                'updated_by' => $user_id,
            ]);
            return $record;
        }
        return $animal_in_farm->update([
            'status_in_farm' => $record['status_in_farm'],
            'short_number' => $record['short_number'],
            'internal_number' => $record['internal_number'],
            'updated_at' => Carbon::now(),
            'updated_by' => $user_id,
        ]);
    }

    // protected static function UpdateRecord($user_id, $current, $record)
    // {
    //     $current->update([
    //         'farm' => $record['farm'],
    //         'address' => $record['address'],
    //         'locality_id' => $record['locality_id'],
    //         'cod_exploatatie' => $record['cod_exploatatie'],
    //         'cif' => $record['cif'],
    //         'status' => $record['status'],
    //         'email' => $record['email'],

    //         'updated_by' => $user_id,
    //     ]);
    //     return self::getRecord($current->id);
    // }

    // protected static function DeleteRecord($user_id, $current, $record)
    // {
    //     $current->update([
    //         'deleted_by' => $user_id,
    //     ]);
    //     $current->delete();
    //     return $current;
    // }

    // protected static function getRecord($id)
    // {
    //     return self::where('id', $id)->with(['locality.judet.region.country', 'oremulsori'])->first();
    // }

    
}
