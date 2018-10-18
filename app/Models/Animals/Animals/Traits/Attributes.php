<?php

namespace App\Models\Animals\Animals\Traits;

trait Attributes
{
    public function getAgeAttribute()
	{
        try
        {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $this->birth_date)->age;
        }
        catch(\Exception $e)
        {
            return '<span style="color:red">' . $this->birth_date . '</span>';
        }
	}
}

