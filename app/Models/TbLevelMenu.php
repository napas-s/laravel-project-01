<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbLevelMenu
 * 
 * @property int $id
 * @property int|null $level
 * @property int $l_artlicle
 * @property int $l_about
 * @property int $l_ads
 * @property int $l_banner
 * @property int $l_category
 * @property int $l_customcode
 * @property int $l_setting
 * @property int $l_setting_ads
 * @property int $l_user
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TbLevel|null $tb_level
 *
 * @package App\Models
 */
class TbLevelMenu extends Model
{
	protected $table = 'tb_level_menu';

	protected $casts = [
		'level' => 'int',
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
		'level',
		'l_artlicle',
		'l_about',
		'l_ads',
		'l_banner',
		'l_category',
		'l_customcode',
		'l_setting',
		'l_setting_ads',
		'l_user'
	];

	public function tb_level()
	{
		return $this->belongsTo(TbLevel::class, 'level');
	}
}
