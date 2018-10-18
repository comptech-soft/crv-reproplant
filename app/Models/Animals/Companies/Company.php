<?php

namespace App\Models\Animals\Companies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\Animals\Animals\Traits\Relations;
// use App\Models\Animals\Animals\Traits\Actions;
// use App\Models\Animals\Animals\Traits\Validator;
// use App\Models\Animals\Animals\Traits\Datatable;
// use App\Models\Animals\Animals\Traits\Attributes;

class Company extends Model
{
	use
		SoftDeletes
		// Relations,
		// Actions,
		// Validator,
		// Attributes,
		// Datatable
	;

	protected $table = 'companies';
	protected $guarded = ['id'];

}
