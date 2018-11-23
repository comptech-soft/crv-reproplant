<?php

namespace App\Models\Farms\Farms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use DB;
use Exception;
use Sentinel;
use App\Models\App\Log\Action;
use Comptechsoft\Helpers\Models\Cartalyst\Users\User;
use App\Models\Farms\Users\User as FarmUser;
use App\Models\Animals\Animals\Animal;

use App\Models\Farms\Farms\Traits\Relations;
use App\Models\Farms\Farms\Traits\Actions;
use App\Models\Farms\Farms\Traits\Validator;
use App\Models\Farms\Farms\Traits\Datatable;

class Farm extends Model
{
	use
		SoftDeletes,
		Relations,
		Actions,
		Validator,
		Datatable
	;

	protected $table = 'farms';
	protected $guarded = ['id'];

	/**
	 * salveaza orele mulsorilor
	 */
	public static function saveOreMulsori($data)
	{
        /**
		 *  Validate the request data
         */
        $validator = \Validator::make($data, [], []);
        if( $validator->fails() )
        {
            return Response::ValidatorFails($validator, $data, [], []);
        }

        /**
		 * Start the transaction
         */
        DB::beginTransaction();
        try
        {
			$user = Sentinel::check();
			$farm = self::find($data['farm_id']);

			foreach($data['ora'] as $parte_zi => $ora)
			{
				$record = $farm->oremulsori()->where('parte_zi', $parte_zi)->first();
				if( $record )
				{
					$record->ora = $ora;
					$record->updated_by = $user->id;
					if( ! $record->created_by )
					{
						$record->created_by = $user->id;
					}
					if( ! $record->created_at )
					{
						$record->created_at = \Carbon\Carbon::now();
					}
					$record->save();
				}
				else
				{
					$record = $farm->oremulsori()->create([
						'parte_zi' => $parte_zi,
						'ora' => $ora,
						'created_by' => $user->id,
						'updated_by' => $user->id,
					]);
				}
			}		
            Action::create([
                'user_id' => $user->id,
                'model' => '\App\Models\Farms\Farms',
                'action' => 'save-farm-ore-mulsori',
                'record' => json_encode($data),
            ]);
            DB::commit();
            return Response::Success('Salvarea s-a efectuat cu succes.', []);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Salvarea nu s-a putut efectua', []);
		}
	}

	/**
     * Actualizeaza informatiile despre un user
     */
	public static function saveUser($data)
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
				'first_name' => 'required',
				'last_name' => 'required',
				'email' => 'required|email|unique:users,email',
				'role' => 'required|exists:roles,id'
			];
			if( $action != 'insert')
			{
				$rules['email'] .= (',' . $old['user_id']);
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
				 * The Sentinel user
				 */
				$user = User::where('email', $record['email'])->first();
				if(! $user)
				{
					$user = Sentinel::registerAndActivate([
						'first_name' => $record['first_name'],
						'last_name' => $record['last_name'],
						'email' => $record['email'],
						'password' => $record['password'],
						'created_by' => Sentinel::check()->id,
						'updated_by' => Sentinel::check()->id,
					]);
				}
				$role = Sentinel::findRoleById($record['role']);
				$user->roles()->sync([$role->id]);
				$farm->users()->attach($user->id, [
					'phone' => $record['phone'],
					'created_by' => Sentinel::check()->id,
					'updated_by' => Sentinel::check()->id,
					'created_at' => \Carbon\Carbon::now(),
					'updated_at' => \Carbon\Carbon::now(),
				]);

			}
			if( $action == 'delete' )
			{
				/**
				 * The Sentinel user
				 */
				$user = User::where('id', $old['user_id'])->first();
				$farm->users()->detach($user->id);
			}
			if( $action == 'update' )
			{
				/**
				 * The Sentinel user
				 */
				$user = User::where('id', $old['user_id'])->first();
				$user->update([
					'first_name' => $record['first_name'],
					'last_name' => $record['last_name'],
					'email' => $record['email'],
					'updated_by' => Sentinel::check()->id,
				]);
				$role = Sentinel::findRoleById($record['role']);
				$user->roles()->sync([$role->id]);
				$farm->users()->syncWithoutDetaching([
					$user->id => [
						'phone' => $record['phone'],
						'updated_by' => Sentinel::check()->id,
						'updated_at' => \Carbon\Carbon::now(),
					]
				]);
			}
			if( $action == 'change-password' )
			{
				/**
				 * The Sentinel user
				 */
				$user = User::where('id', $old['user_id'])->first();
				Sentinel::update($user, [
					'password' => $record['password'],
					'updated_by' => Sentinel::check()->id,
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
			if( $action == 'delete' )
			{
				/**
				 * The Sentinel user
				 */
				$user = User::where('id', $old['user_id'])->first();
				$farm->users()->detach($user->id);
			}
			if( $action == 'update' )
			{
				/**
				 * The Sentinel user
				 */
				$user = User::where('id', $old['user_id'])->first();
				$user->update([
					'first_name' => $record['first_name'],
					'last_name' => $record['last_name'],
					'email' => $record['email'],
					'updated_by' => Sentinel::check()->id,
				]);
				$role = Sentinel::findRoleById($record['role']);
				$user->roles()->sync([$role->id]);
				$farm->users()->syncWithoutDetaching([
					$user->id => [
						'phone' => $record['phone'],
						'updated_by' => Sentinel::check()->id,
						'updated_at' => \Carbon\Carbon::now(),
					]
				]);
			}
			if( $action == 'change-password' )
			{
				/**
				 * The Sentinel user
				 */
				$user = User::where('id', $old['user_id'])->first();
				Sentinel::update($user, [
					'password' => $record['password'],
					'updated_by' => Sentinel::check()->id,
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

	/**
     * Ataseaza un animal la o ferma
     */
	public static function attachAnimal($data)
	{		
		$rules = [
			'farm_id' => 'required|exists:farms,id',
			'animal_id' => 'required|exists:animals,id',
		];
        $validator = \Validator::make($data, $rules, []);
        if( $validator->fails() )
        {
            return Response::ValidatorFails($validator, $data, $rules, []);
        }

        DB::beginTransaction();
        try
        {
			$farm = self::find($data['farm_id']);
			$animal = Animal::find($data['animal_id']);

			$farm->animals()->attach($animal->id, [
				'short_number' => null,
				'internal_number' => null,
				'status_in_farm' => $data['status_in_farm'],
				
				'created_by' => Sentinel::check()->id,
				'updated_by' => Sentinel::check()->id,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			]);

			Action::create([
                'user_id' => Sentinel::check()->id,
                'model' => '\App\Models\Farms\Farms',
                'action' => 'attach-animal',
                'record' => json_encode($data),
            ]);
            DB::commit();
            return Response::Success('Acțiunea s-a efectuat cu succes.', ['record' => $data]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Acțiunea nu s-a putut efectua', []);
		}
	}

}
