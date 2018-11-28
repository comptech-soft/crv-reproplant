<?php

namespace App\Models\Farms\Farms\Traits;

use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use DB;
use Exception;
use Sentinel;
use App\Models\App\Log\Action;
use App\Models\Animals\Animals\Animal;

trait Cows
{

	/**
     * Actualizeaza informatiile despre o vaca
     */
	public static function saveCow($data)
	{

		/**
		 * The record to be updated
		 */
		$record = $data['record'];
		$old = $data['old'];
		

		/**
		 *  Validate the request data
         */
		if( ($action = $data['action']) == 'delete' )
		{
			$rules = [];
		}
		else
		{
			$rules = [
				'matricol_number' => 'required|unique:animals,matricol_number',
			];
			if( $action != 'insert')
			{
				$rules['matricol_number'] .= (',' . $old['id']);
			}
		}
        $validator = \Validator::make($record, $rules, []);
        if( $validator->fails() )
        {
            return Response::ValidatorFails($validator, $record, $rules, []);
        }

        /**
		 * Start the transaction
         */
        DB::beginTransaction();
        try
        {
			$farm = self::find($data['farm_id']);
			if( $action == 'insert')
			{
				/**
				 * The Animal
				 */
				$animal = Animal::where('matricol_number', $record['matricol_number'])->first();
				
				if(! $animal)
				{
					$animal = Animal::create([
						'type' => $record['type'],
						'gender' => $record['gender'],
						'animal_status' => $record['animal_status'],
						'matricol_number' => $record['matricol_number'],
						'birth_date' => $record['birth_date'],
						'last_calving_date' => $record['last_calving_date'],
						'breed_id' => $record['breed_id'],
						'parity' => $record['parity'],
						'father_id' => $record['father_id'],
						'mother_id' => $record['mother_id'],
						'created_by' => Sentinel::check()->id,
						'updated_by' => Sentinel::check()->id,
					]);
				}
				else
				{
					$animal->update([
						'birth_date' => $record['birth_date'],
						'last_calving_date' => $record['last_calving_date'],
						'breed_id' => $record['breed_id'],
						'parity' => $record['parity'],
						'father_id' => $record['father_id'],
						'mother_id' => $record['mother_id'],
						'updated_by' => Sentinel::check()->id,
					]);
				}
			
				$farm->animals()->attach($animal->id, [
					'short_number' => $record['short_number'],
					'internal_number' => $record['internal_number'],
					'status_in_farm' => $record['status_in_farm'],
					
					'created_by' => Sentinel::check()->id,
					'updated_by' => Sentinel::check()->id,
					'created_at' => \Carbon\Carbon::now(),
					'updated_at' => \Carbon\Carbon::now(),
				]);

			}
			Action::create([
                'user_id' => Sentinel::check()->id,
                'model' => '\App\Models\Farms\Farms',
                'action' => $action,
                'record' => json_encode($data),
            ]);
            DB::commit();
            return Response::Success('Acțiunea s-a efectuat cu succes.', ['record' => $record]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Acțiunea nu s-a putut efectua', []);
		}
	}
    
}