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

    // /**
    //  * Initiaza salvarea viziunii unei companii
    //  */
    // public static function saveVision($record)
    // {
    //     $rules = [
    //         'company_id' => 'required',
    //         'vision' => 'required'
    //     ];
        
    //     $messages = [
    //         'company_id.required' => 'Id-ul companiei nu trebuie să lipsească.',
    //         'vision' => 'Visiunea trebuie completată.'
    //     ];

    //     $validator = \Validator::make($record, $rules, $messages);
    //     if( $validator->fails() )
    //     {
    //         return Response::ValidatorFails($validator, $record, $rules, $messages);
    //     }

    //     DB::beginTransaction();
    //     try
    //     {
    //         $user = Sentinel::check();
    //         $company = self::find($record['company_id']);

    //         if( ! $company->vision )
    //         {
    //             $company->vision()->create([
    //                 'company_id' => $record['company_id'],
    //                 'vision' => $record['vision'],
    //                 'created_by' => $user->id,
    //                 'updated_by' => $user->id,
    //             ]);
    //         }
    //         else
    //         {
    //             $company->vision->update([
    //                 'vision' => $record['vision'],
    //                 'updated_by' => $user->id,
    //             ]);
    //         }
    //         /*
    //         | Log the action
    //         */
    //         Action::create([
    //             'user_id' => $user->id,
    //             'model' => '\\' . __CLASS__,
    //             'action' => 'save-company-vision',
    //             'record' => json_encode($record),
    //         ]);
    //         DB::commit();
    //         return Response::Success('Viziunea a fost salvată.', ['company' => $company, 'user' => $user]);
    //     }
    //     catch(Exception $e)
    //     {
    //         DB::rollBack();
    //         return Response::Exception($e, 'Ceva nu funcționează bine. Încercați mai târziu.', ['user' => $user]);
    //     }
    // }
}
