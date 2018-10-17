<?php

namespace App\Models\Farms\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\Farms\OreMulsori\Traits\Relations;
// use App\Models\Farms\OreMulsori\Traits\Actions;
// use App\Models\Farms\OreMulsori\Traits\Validator;
// use App\Models\Farms\OreMulsori\Traits\Datatable;

class User extends Model
{
	use
		SoftDeletes
		// Relations
		// Actions,
		// Validator,
		// Datatable
	;

	protected $table = 'farms_users';
	protected $guarded = ['id'];

	public static function getDatatableQuery()
	{
		return self::query()->with(['user.roles']);
	}

	public function user()
	{
		return $this->belongsTo(\Comptechsoft\Helpers\Models\Cartalyst\Users\User::class, 'user_id');
	}
}
