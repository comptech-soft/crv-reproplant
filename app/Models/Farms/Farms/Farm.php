<?php

namespace App\Models\Farms\Farms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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


}
