<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $ID_USER
 * @property string $EMAIL
 * @property string $PASSWORD
 * @property string $FULL_NAME
 * @property int $ETAT_USER
 * @property string|null $PHOTO_USER
 * @property Carbon $DATE_CREATE
 * @property Carbon|null $DATE_UPDATE
 * 
 * @property Collection|Publication[] $publications
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'ID_USER';
	public $timestamps = false;

	protected $casts = [
		'ETAT_USER' => 'int'
	];

	protected $dates = [
		'DATE_CREATE',
		'DATE_UPDATE'
	];

	protected $fillable = [
		'EMAIL',
		'PASSWORD',
		'FULL_NAME',
		'ETAT_USER',
		'PHOTO_USER',
		'DATE_CREATE',
		'DATE_UPDATE'
	];

	public function publications()
	{
		return $this->hasMany(Publication::class, 'ID_USER');
	}
}
