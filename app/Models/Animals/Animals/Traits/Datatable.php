<?php

namespace App\Models\Animals\Animals\Traits;

trait Datatable
{
    public static function getDatatableQuery()
	{
		return self::query()->with(['rasa', 'company', 'father', 'mother']);
	}
}
