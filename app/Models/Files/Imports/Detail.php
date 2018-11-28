<?php

namespace App\Models\Files\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
	use SoftDeletes;

	protected $table = 'imports_details';
    protected $guarded = ['id'];
    protected $appends  = ['columns'];

    public function getColumnsAttribute()
    {
        return $this->row ? json_decode($this->row) : NULL;
    }
}
