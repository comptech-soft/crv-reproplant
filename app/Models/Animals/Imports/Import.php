<?php

namespace App\Models\Animals\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model
{
	use
		SoftDeletes
	;

	protected $table = 'animal_imports';
	protected $guarded = ['id'];

}
