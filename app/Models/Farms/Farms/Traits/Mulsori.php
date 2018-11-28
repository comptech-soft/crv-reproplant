<?php

namespace App\Models\Farms\Farms\Traits;

use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use DB;
use Exception;
use Sentinel;
use App\Models\App\Log\Action;

trait Mulsori
{

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
    
}