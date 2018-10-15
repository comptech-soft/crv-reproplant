<?php

namespace App\Models\Locations\Localities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Locations\Localities\Traits\Relations;

class Locality extends Model
{
	use
		SoftDeletes,
		Relations
	;

	protected $table = 'geo_localities';
	protected $guarded = ['id'];

	public static function getDatatableQuery()
	{
		return
			self::query()
			->leftJoin(
				'geo_judete',
				function($j)
				{
					$j->on('geo_judete.id', '=', 'geo_localities.judet_id')
					->leftJoin(
						'geo_regions',
						function($j)
						{
							$j->on('geo_regions.id', '=', 'geo_judete.region_id')
							->leftJoin('geo_countries', 'geo_countries.id', '=', 'geo_regions.country_id');
						}
					);
				}
			)
			->select('geo_localities.*')
			->with(['judet.region.country'])
		;
	}

}
