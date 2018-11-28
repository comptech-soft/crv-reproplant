<?php

namespace App\Models\Farms\Animals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Farms\Animals\Traits\Actions;
use App\Models\Farms\Animals\Traits\Validator;
use App\Models\Farms\Animals\Traits\Datatable;
use App\Models\Farms\Animals\Traits\Relations;

class Animal extends Model
{
	use
		SoftDeletes,
		Actions,
		Validator,
		Datatable,
		Relations
	;

	protected $table = 'farms_animals';
	protected $guarded = ['id'];

	

	
}
