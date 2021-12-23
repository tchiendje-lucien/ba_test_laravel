<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Produit
 * 
 * @property int $ID_PRODUIT
 * @property string $NOM_PROD
 * @property float $PRIX_PROD
 * @property string|null $DESC_PRODUIT
 * @property bool $ETAT_STOCK
 * @property Carbon $DATE_CREATE
 * @property Carbon|null $DATE_UPDATE
 * 
 * @property Collection|Publication[] $publications
 *
 * @package App\Models
 */
class Produit extends Model
{
	protected $table = 'produits';
	protected $primaryKey = 'ID_PRODUIT';
	public $timestamps = false;

	protected $casts = [
		'PRIX_PROD' => 'float',
		'ETAT_STOCK' => 'bool'
	];

	protected $dates = [
		'DATE_CREATE',
		'DATE_UPDATE'
	];

	protected $fillable = [
		'NOM_PROD',
		'PRIX_PROD',
		'DESC_PRODUIT',
		'ETAT_STOCK',
		'DATE_CREATE',
		'DATE_UPDATE'
	];

	public function publications()
	{
		return $this->hasMany(Publication::class, 'ID_PRODUIT');
	}
}
