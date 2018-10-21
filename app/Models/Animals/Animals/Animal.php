<?php

namespace App\Models\Animals\Animals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Animals\Animals\Traits\Relations;
use App\Models\Animals\Animals\Traits\Actions;
use App\Models\Animals\Animals\Traits\Validator;
use App\Models\Animals\Animals\Traits\Datatable;
use App\Models\Animals\Animals\Traits\Attributes;
use App\Models\Animals\Animals\Traits\Import;

class Animal extends Model
{
	use
		SoftDeletes,
		Relations,
		Actions,
		Validator,
		Attributes,
		Datatable,
		Import
	;

	protected $table = 'animals';
	protected $guarded = ['id'];
	protected $appends = ['age'];
	
	public static function getAnimalCharacteristics($data)
	{
		$animal = self::find($data['animal_id']);
		return $animal->characteristics()->with(['parameter'])->get();
	}
}
