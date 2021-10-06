<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSettingAd
 * 
 * @property int $id
 * @property int $set_head_show
 * @property int $set_banner_show
 * @property int $set_right1_show
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbSettingAd extends Model
{
	protected $table = 'tb_setting_ads';

	protected $casts = [
		'set_head_show' => 'int',
		'set_banner_show' => 'int',
		'set_right1_show' => 'int'
	];

	protected $fillable = [
		'set_head_show',
		'set_banner_show',
		'set_right1_show',
		'updated_by',
		'created_by'
	];
}
