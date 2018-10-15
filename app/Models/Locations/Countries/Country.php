<?php

namespace App\Models\Locations\Countries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Locations\Countries\Traits\Relations;
use App\Models\Locations\Countries\Traits\Actions;
use App\Models\Locations\Countries\Traits\Validator;
use App\Models\Locations\Countries\Traits\Datatable;

class Country extends Model
{
	use
		SoftDeletes,
		Relations,
		Actions,
		Validator,
		Datatable
	;

	protected $table = 'geo_countries';
	protected $guarded = ['id'];


}
