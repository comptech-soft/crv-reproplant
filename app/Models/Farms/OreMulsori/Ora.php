<?php

namespace App\Models\Farms\OreMulsori;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Farms\OreMulsori\Traits\Relations;
// use App\Models\Farms\OreMulsori\Traits\Actions;
// use App\Models\Farms\OreMulsori\Traits\Validator;
// use App\Models\Farms\OreMulsori\Traits\Datatable;

class Ora extends Model
{
	use
		SoftDeletes,
		Relations
		// Actions,
		// Validator,
		// Datatable
	;

	protected $table = 'farms_ore_mulsori';
	protected $guarded = ['id'];


}
