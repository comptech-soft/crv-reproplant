<?php

namespace App\Models\Locations\Countries\Traits;

trait Datatable
{
    public static function getDatatableQuery()
	{
		return self::query()->withCount(['regions']);
	}
}
