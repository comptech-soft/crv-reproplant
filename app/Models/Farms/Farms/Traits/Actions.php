<?php

namespace App\Models\Farms\Farms\Traits;

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
        $record = self::insert($data = [
            'farm' => $record['farm'],
            'address' => $record['address'],
            'locality_id' => $record['locality_id'],
            'cod_exploatatie' => $record['cod_exploatatie'],
            'cif' => $record['cif'],
            'status' => $record['status'],
            'email' => $record['email'],

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
            'farm' => $record['farm'],
            'address' => $record['address'],
            'locality_id' => $record['locality_id'],
            'cod_exploatatie' => $record['cod_exploatatie'],
            'cif' => $record['cif'],
            'status' => $record['status'],
            'email' => $record['email'],

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
        return self::where('id', $id)->with(['locality.judet.region.country', 'oremulsori'])->first();
    }

}
