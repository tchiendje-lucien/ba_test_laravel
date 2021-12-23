<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImagesPub
 * 
 * @property int $ID_IMAGE
 * @property int $ID_PUBLICATION
 * @property string $LIBELLE_IMAGE
 * 
 * @property Publication $publication
 *
 * @package App\Models
 */
class ImagesPub extends Model
{
	protected $table = 'images_pub';
	protected $primaryKey = 'ID_IMAGE';
	public $timestamps = false;

	protected $casts = [
		'ID_PUBLICATION' => 'int'
	];

	protected $fillable = [
		'ID_PUBLICATION',
		'LIBELLE_IMAGE'
	];

	public function publication()
	{
		return $this->belongsTo(Publication::class, 'ID_PUBLICATION');
	}
}
