<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Publication
 * 
 * @property int $ID_PUBLICATION
 * @property int $ID_USER
 * @property int $ID_PRODUIT
 * @property bool $ETAT_PUB
 * @property string $DATE_PUB
 * @property string|null $DATE_MODIF_PUB
 * 
 * @property Produit $produit
 * @property User $user
 * @property Collection|ImagesPub[] $images_pubs
 *
 * @package App\Models
 */
class Publication extends Model
{
	protected $table = 'publications';
	protected $primaryKey = 'ID_PUBLICATION';
	public $timestamps = false;

	protected $casts = [
		'ID_USER' => 'int',
		'ID_PRODUIT' => 'int',
		'ETAT_PUB' => 'bool'
	];

	protected $fillable = [
		'ID_USER',
		'ID_PRODUIT',
		'ETAT_PUB',
		'DATE_PUB',
		'DATE_MODIF_PUB'
	];

	public function produit()
	{
		return $this->belongsTo(Produit::class, 'ID_PRODUIT');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'ID_USER');
	}

	public function images_pubs()
	{
		return $this->hasMany(ImagesPub::class, 'ID_PUBLICATION');
	}
}
