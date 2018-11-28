<?php

namespace App\Models\Farms\Animals\Traits;

trait Datatable
{
    public static function getDatatableQuery()
	{
		return 
			self::query()
			->leftJoin('animals', 'farms_animals.animal_id', '=', 'animals.id')
			->select('farms_animals.*')
			->with(['animal.father', 'animal.mother', 'animal.father.father', 'animal.father.mother', 'animal.mother.father', 'animal.mother.mother', 'animal.rasa', 'animal.company']);
	}
}