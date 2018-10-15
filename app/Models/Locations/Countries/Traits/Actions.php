<?php

namespace App\Models\Locations\Countries\Traits;

use Illuminate\Http\Request;
use Sentinel;
use Carbon\Carbon;

trait Actions
{

    protected static function InsertRecord($user_id, $record)
    {
        $record = self::insert($data = [
            'name' => $record['name'],
            'code' => $record['code'],
            'icon' => $record['icon'],
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
            'name' => $record['name'],
            'code' => $record['code'],
            'icon' => $record['icon'],
            'updated_by' => $user_id,
        ]);
        return $current;
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
        return self::find($id);
    }
}
