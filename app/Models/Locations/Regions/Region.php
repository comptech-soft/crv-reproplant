<?php

namespace App\Models\Locations\Regions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Locations\Regions\Traits\Relations;

class Region extends Model
{
	use
		SoftDeletes,
		Relations
	;

	protected $table = 'geo_regions';
	protected $guarded = ['id'];

	public static function getDatatableQuery()
	{
		return
			self::query()
			->leftJoin('geo_countries', 'geo_countries.id', '=', 'geo_regions.country_id')
			->select('geo_regions.*', 'geo_countries.name as tara')
			->with(['country'])
			->withCount(['judete']);
	}

}

/*
return Query::getDatatableRows(
            self::query()->leftJoin(
                'cities', function($join){
                    $join->on('cities.id', '=', 'ferme.localitate_id')
                    ->leftJoin('regions', function($join){
                        $join->on('regions.id', '=', 'cities.region_id');
                    })
                    ;

                }
            )
            ->select('ferme.*', 'regions.country_id')
            ->with(['city.region.country']),
            $request
        );
*/
