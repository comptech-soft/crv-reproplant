<?php

namespace App\Models\Farms\Farms\Traits;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnimalsExport;
use Storage;

trait Exports
{

    /**
     * Export vaci in fisier excel
     * https://laravel-excel.maatwebsite.nl/3.1/exports/
     */
	public static function animalsDownload($data)
	{	
        $farm = self::find($data['farm_id']);
        $file = 'exports/Cows-list-' . str_replace(['.', ' '], '', $farm->farm) . '.xlsx';
        $result = Excel::store(new AnimalsExport($farm, $data['type'], $data['gender']), $file, 's3');
        Storage::disk('s3')->setVisibility($file, 'public');
        $visibility = Storage::disk('s3')->getVisibility($file);
        return [
            'success' => $result,
            'file' => $file,
            'url' => config('services.aws.url') . $file,
            'visibility' => $visibility
        ];
    }

    
}
