<?php

namespace App\Models\Farms\Animals;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
	use
		SoftDeletes
	;

	protected $table = 'farms_animals';
	protected $guarded = ['id'];

	public static function getDatatableQuery()
	{
		return self::query()->with(['animal.father', 'animal.mother', 'animal.father.father', 'animal.father.mother', 'animal.mother.father', 'animal.mother.mother']);
	}

	public function animal()
	{
		return $this->belongsTo(\App\Models\Animals\Animals\Animal::class, 'animal_id');
	}
}
