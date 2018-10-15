<?php

namespace App\Models\Locations\Judete;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Locations\Judete\Traits\Relations;

class Judet extends Model
{
	use
		SoftDeletes,
		Relations
	;

	protected $table = 'geo_judete';
	protected $guarded = ['id'];

	public static function getDatatableQuery()
	{
		return
			self::query()
			->leftJoin(
				'geo_regions',
				function($j)
				{
					$j->on('geo_regions.id', '=', 'geo_judete.region_id')
					->leftJoin(
						'geo_countries',
						function($j)
						{
							$j->on('geo_countries.id', '=', 'geo_regions.country_id');
						}
					);
				}
			)
			->with(['region.country'])
			->withCount(['localities'])
		;
	}
}
