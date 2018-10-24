<?php

namespace App\Models\Animals\Companies\Traits;

use Carbon\Carbon;

trait Actions
{

    protected static function InsertRecord($user_id, $record)
    {
        $record = self::create($data = [
            'name' => $record['name'],
            'logo' => $record['logo'],
            'width' => $record['width'],
            'height' => $record['height'],
                
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
            'logo' => $record['logo'],
            'width' => $record['width'],
            'height' => $record['height'],

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
        return self::where('id', $id)->first();
    }

}
