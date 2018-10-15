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
            'name' => $record['name'],
            'type' => $record['type'],
            'type_id' => $record['type_id'],
            'size_id' => $record['size_id'],
            'is_supplier' => $record['is_supplier'],
            'is_customer' => $record['is_customer'],
            'has_services' => $record['has_services'],
            'has_works' => $record['has_works'],
            'has_supply' => $record['has_supply'],
            'has_consultancy' => $record['has_consultancy'],
            'has_design' => $record['has_design'],
            'phone_number' => $record['phone_number'],
            'fax_number' => $record['fax_number'],
            'email' => $record['email'],

            'country_id' => $record['country_id'],
            'region_id' => $record['region_id'],
            'judet_id' => $record['judet_id'],
            'locality_id' => $record['locality_id'],

            'address' => $record['address'],
            'postal_code' => $record['postal_code'],

            'is_vat_payer' => $record['is_vat_payer'],
            'fiscal_code' => $record['fiscal_code'],
            'commerce_registry_number' => $record['commerce_registry_number'],
            'year_of_establishment' => $record['year_of_establishment'],

            'capital_social' => $record['capital_social'],
            'procent_cs_pf' => $record['procent_cs_pf'],
            'procent_cs_imm' => $record['procent_cs_imm'],
            'procent_cs_scm' => $record['procent_cs_scm'],
            
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
            'type' => $record['type'],
            'type_id' => $record['type_id'],
            'size_id' => $record['size_id'],
            'is_supplier' => $record['is_supplier'],
            'is_customer' => $record['is_customer'],
            'has_services' => $record['has_services'],
            'has_works' => $record['has_works'],
            'has_supply' => $record['has_supply'],
            'has_consultancy' => $record['has_consultancy'],
            'has_design' => $record['has_design'],
            'phone_number' => $record['phone_number'],
            'fax_number' => $record['fax_number'],
            'email' => $record['email'],
            
            'country_id' => $record['country_id'],
            'region_id' => $record['region_id'],
            'judet_id' => $record['judet_id'],
            'locality_id' => $record['locality_id'],
            
            'address' => $record['address'],
            'postal_code' => $record['postal_code'],

            'is_vat_payer' => $record['is_vat_payer'],
            'fiscal_code' => $record['fiscal_code'],
            'commerce_registry_number' => $record['commerce_registry_number'],
            'year_of_establishment' => $record['year_of_establishment'],

            'capital_social' => $record['capital_social'],
            'procent_cs_pf' => $record['procent_cs_pf'],
            'procent_cs_imm' => $record['procent_cs_imm'],
            'procent_cs_scm' => $record['procent_cs_scm'],

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
        return self::with(['vision'])->where('id', $id)->first();
    }

    /**
     * Initiaza salvarea viziunii unei companii
     */
    public static function saveVision($record)
    {
        $rules = [
            'company_id' => 'required',
            'vision' => 'required'
        ];
        
        $messages = [
            'company_id.required' => 'Id-ul companiei nu trebuie să lipsească.',
            'vision' => 'Visiunea trebuie completată.'
        ];

        $validator = \Validator::make($record, $rules, $messages);
        if( $validator->fails() )
        {
            return Response::ValidatorFails($validator, $record, $rules, $messages);
        }

        DB::beginTransaction();
        try
        {
            $user = Sentinel::check();
            $company = self::find($record['company_id']);

            if( ! $company->vision )
            {
                $company->vision()->create([
                    'company_id' => $record['company_id'],
                    'vision' => $record['vision'],
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]);
            }
            else
            {
                $company->vision->update([
                    'vision' => $record['vision'],
                    'updated_by' => $user->id,
                ]);
            }
            /*
            | Log the action
            */
            Action::create([
                'user_id' => $user->id,
                'model' => '\\' . __CLASS__,
                'action' => 'save-company-vision',
                'record' => json_encode($record),
            ]);
            DB::commit();
            return Response::Success('Viziunea a fost salvată.', ['company' => $company, 'user' => $user]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu funcționează bine. Încercați mai târziu.', ['user' => $user]);
        }
    }
}
