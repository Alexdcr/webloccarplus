<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharedCarsModel extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'shared_cars';

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
			'created_at', 'updated_at',
	];
}
