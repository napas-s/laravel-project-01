<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSettingDisplay
 * 
 * @property int $id
 * @property string|null $display_name
 * @property int $display_show
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbSettingDisplay extends Model
{
	protected $table = 'tb_setting_display';

	protected $casts = [
		'display_show' => 'int'
	];

	protected $fillable = [
		'display_name',
		'display_show',
		'updated_by',
		'created_by'
	];
}
