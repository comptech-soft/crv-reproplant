<?php

namespace App\Models\Files\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model
{
	use SoftDeletes;

	protected $table = 'imports';
	protected $guarded = ['id'];
	protected $appends  = ['columns'];

	public function details()
    {
        return $this->hasMany(\App\Models\Files\Imports\Detail::class, 'import_id');
	}
	
    public function getColumnsAttribute()
    {
        return $this->header ? json_decode($this->header) : NULL;
    }
}
