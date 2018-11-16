<?php

namespace App\Models\Farms\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
	use
		SoftDeletes
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
