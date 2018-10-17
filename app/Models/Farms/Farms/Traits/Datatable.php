<?php

namespace App\Models\Farms\Farms\Traits;

trait Datatable
{
    public static function getDatatableQuery()
	{
		return self::query()->with(['locality.judet.region.country', 'oremulsori']);
	}
}
