<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCarsModel extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'user_cars';

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
			'created_at', 'updated_at',
	];
}
