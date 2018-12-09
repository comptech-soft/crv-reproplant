<?php

namespace App\Models\Farms\Farms\Traits;

use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use DB;
use Exception;
use Sentinel;
use App\Models\App\Log\Action;
use App\Models\Animals\Animals\Animal;
use App\Models\Farms\Animals\Animal as FarmAnimal;

trait Animals
{

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
    
    protected function animalsDelete($data)
    {
        DB::beginTransaction();
        try
        {
			$farm = self::find($data['farm_id']);
            $animals = $farm->animals()
                ->where('type', $data['type'])
                ->where('gender', $data['gender'])
                ->pluck('farms_animals.animal_id')->toArray();

            $farm->animals()->detach($animals);

			Action::create([
                'user_id' => Sentinel::check()->id,
                'model' => '\App\Models\Farms\Farms',
                'action' => 'delete-all-animals',
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

    protected function changeStatusInFarm($data)
    {
        DB::beginTransaction();
        try
        {
            $animal = FarmAnimal::find($data['id']);
            $animal->update([
                'status_in_farm' => ($animal->status_in_farm == 'activ' ? 'inactiv' : 'activ'),
                'updated_by' => Sentinel::check()->id,
				'updated_at' => \Carbon\Carbon::now(),
            ]);
			Action::create([
                'user_id' => Sentinel::check()->id,
                'model' => '\App\Models\Farms\Farms',
                'action' => 'change-animal-status-in-farm',
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

    protected function deleteAnimalFromFarm($data)
    {
        DB::beginTransaction();
        try
        {
            $animal = FarmAnimal::find($data['id']);
            $animal->update([
                'deleted_by' => Sentinel::check()->id,
            ]);
            $animal->delete();
			Action::create([
                'user_id' => Sentinel::check()->id,
                'model' => '\App\Models\Farms\Farms',
                'action' => 'delete-animal-from-farm',
                'record' => json_encode($data),
            ]);
            DB::commit();
            return Response::Success('Ștergerea s-a efectuat cu succes.', ['record' => $data]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Acțiunea nu s-a putut efectua', []);
		}
    }
    
}