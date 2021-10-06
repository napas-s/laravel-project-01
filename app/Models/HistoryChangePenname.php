<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class HistoryChangePenname
 * 
 * @property int|null $userId
 * @property string|null $penname_new
 * @property string|null $penname_old
 * @property string|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class HistoryChangePenname extends Model
{
	protected $table = 'history_change_penname';
	public $incrementing = false;

	protected $casts = [
		'userId' => 'int'
	];

	protected $fillable = [
		'userId',
		'penname_new',
		'penname_old',
		'updated_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'userId');
	}
}
