<?php

namespace App\Models\Farms\Farms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Farms\Farms\Traits\Relations;
use App\Models\Farms\Farms\Traits\Actions;
use App\Models\Farms\Farms\Traits\Validator;
use App\Models\Farms\Farms\Traits\Datatable;
use App\Models\Farms\Farms\Traits\Imports;
use App\Models\Farms\Farms\Traits\Exports;
use App\Models\Farms\Farms\Traits\Mulsori;
use App\Models\Farms\Farms\Traits\Users;
use App\Models\Farms\Farms\Traits\Cows;
use App\Models\Farms\Farms\Traits\Animals;

class Farm extends Model
{
	use
		SoftDeletes,
		Relations,
		Actions,
		Validator,
		Datatable,
		Mulsori,
		Exports,
		Users,
		Cows,
		Animals
	;

	protected $table = 'farms';
	protected $guarded = ['id'];
	
}
