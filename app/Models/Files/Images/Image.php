<?php

namespace App\Models\Files\Images;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
	use
		SoftDeletes
	;

	protected $table = 'images';
	protected $guarded = ['id'];

}
