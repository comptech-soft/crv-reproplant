<?php

namespace App\Models\Animals\Companies\Traits;

trait Datatable
{
    public static function getDatatableQuery()
	{
		return self::query();
	}
}
