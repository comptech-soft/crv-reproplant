<?php

namespace App\Models\Locations\Countries\Traits;

trait Datatable
{
    public static function getDatatableQuery()
	{
		return self::query()->withCount(['regions']);
	}

	public static function getAllRecords()
	{
		return self::query()->get();
	}
}
