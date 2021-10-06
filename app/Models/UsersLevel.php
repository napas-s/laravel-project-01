<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsersLevel
 * 
 * @property int $id
 * @property int|null $UserId
 * @property int $l_artlicle
 * @property int $l_about
 * @property int $l_ads
 * @property int $l_banner
 * @property int $l_category
 * @property int $l_customcode
 * @property int $l_setting
 * @property int $l_setting_ads
 * @property int $l_user
 * @property string|null $update_by
 * @property string|null $crate_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 *
 * @package App\Models
 */
class UsersLevel extends Model
{
	protected $table = 'users_level';

	protected $casts = [
		'UserId' => 'int',
		'l_artlicle' => 'int',
		'l_about' => 'int',
		'l_ads' => 'int',
		'l_banner' => 'int',
		'l_category' => 'int',
		'l_customcode' => 'int',
		'l_setting' => 'int',
		'l_setting_ads' => 'int',
		'l_user' => 'int'
	];

	protected $fillable = [
		'UserId',
		'l_artlicle',
		'l_about',
		'l_ads',
		'l_banner',
		'l_category',
		'l_customcode',
		'l_setting',
		'l_setting_ads',
		'l_user',
		'update_by',
		'crate_by'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'UserId');
	}
}
