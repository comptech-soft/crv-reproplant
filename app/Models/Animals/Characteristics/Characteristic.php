<?php

namespace App\Models\Animals\Characteristics;

use Illuminate\Database\Eloquent\Model;
use App\Models\Animals\Characteristics\Traits\Actions;
use App\Models\Animals\Characteristics\Traits\Relations;

class Characteristic extends Model
{

    use Actions, Relations;

	protected $table = 'animal_traits';
	protected $guarded = ['id'];

}