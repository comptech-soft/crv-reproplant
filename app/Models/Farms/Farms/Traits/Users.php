<?php

namespace App\Models\Farms\Farms\Traits;

use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use DB;
use Exception;
use Sentinel;
use App\Models\App\Log\Action;
use Comptechsoft\Helpers\Models\Cartalyst\Users\User;

trait Users
{

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
    
}