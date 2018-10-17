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
                'action' => 'salvare-ore-mulsori',
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
		 *  Validate the request data
         */
		$rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users,email',
			'role' => 'required|exists:roles,id'
		];
        $validator = \Validator::make($record = $data['record'], $rules, []);
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
			$farm = self::find($data['farm_id']);
			if( ($action = $data['action']) == 'insert' )
			{
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
            DB::commit();
            return Response::Success('Salvarea s-a efectuat cu succes.', []);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Salvarea nu s-a putut efectua', []);
		}
	}

}
