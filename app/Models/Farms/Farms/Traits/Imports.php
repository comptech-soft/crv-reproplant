<?php

namespace App\Models\Farms\Farms\Traits;

use Sentinel;
use App\Imports\SiresImport;
use App\Models\Files\Imports\Import;
use Exception;
use DB;
use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use App\Models\Animals\Animals\Animal;

trait Imports
{

    /**
     * Import tauri din fisier excek
     * https://laravel-excel.maatwebsite.nl/3.1/imports/
     */
	public static function siresUpload($data)
	{	
        DB::beginTransaction();
        try
        {
            $file = $data['excel-file'];
            $import = Import::create([
                'farm_id' => $data['farm_id'],
                'type' => $data['type'],
                'file_name' => $file->getClientOriginalName(),
                'file_extension' => $file->getClientOriginalExtension(),
                'file_mime' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'created_by' => Sentinel::check()->id,
                'updated_by' => Sentinel::check()->id,
                'deleted_by' => NULL,
            ]);
            // $x = Excel::import(new SiresImport, $file);
            $rows = (new SiresImport)->toCollection($file)->all();
            foreach($rows[0]->all() as $i => $row)
            {
                if($i == 0)
                {
                    $import->header = json_encode($row);
                    $import->save();
                }
                else 
                {
                    $import->details()->create([
                        'row' => json_encode($row)
                    ]);
                }
            }
            DB::commit();
            return Response::Success('Citirea fișierului s-a efectuat cu succes.', [
                'import' => $import = Import::find($import->id),
                'details' => $import->details
            ]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Salvarea nu s-a putut efectua', []);
        }
    }

    public static function siresImport($data)
	{
        DB::beginTransaction();
        try
        {
            $animal = Animal::findByCode(
                $data['animal']['cod_interbull'], 
                $data['animal']['crotalie'], 
                $data['animal']['naab'], 
                $data['animal']['cod_ro']
            );
            if( ! $animal )
            {
                $animal = Animal::create([
                    'short_name' => $data['animal']['nume'],
                    'long_name' => $data['animal']['nume_lung'],
                    'interbull_code' => $data['animal']['cod_interbull'],
                    'matricol_number' => $data['animal']['crotalie'],
                    'naab' => $data['animal']['naab'],
                    'cod_ro' => $data['animal']['cod_ro'],
                    'type' => array_key_exists('type', $data) ? $data['type'] : 'sire',
                    'gender' => array_key_exists('gender', $data) ? $data['gender'] : 'male',
                    'animal_status' => array_key_exists('animal_status', $data) ? $data['animal_status'] : 'invalid',
                ]);
            }
            $farm = self::find($data['farm_id']);
            if( ! $farm->animals()->where('animal_id', $animal->id)->first() )
			{
                $farm->animals()->attach($animal->id, [
                    'short_number' => null,
                    'internal_number' => null,
                    'status_in_farm' => array_key_exists('status_in_farm', $data) ? $data['status_in_farm'] : 'inactiv',
                    'created_by' => Sentinel::check()->id,
                    'updated_by' => Sentinel::check()->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            DB::commit();
            return Response::Success('Importul s-a efectuat cu succes.', [
            ]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Importul nu s-a putut efectua.', []);
        }
    }
    
}