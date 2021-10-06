<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbExtension
 * 
 * @property int $id
 * @property string|null $ext_googleWebmaster
 * @property string|null $ext_googleAnalytics
 * @property string|null $ext_googleAdsense
 * @property string|null $ext_histats
 * @property int $ext_captcha_status
 * @property string|null $ext_captcha
 * @property string|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $created_by
 *
 * @package App\Models
 */
class TbExtension extends Model
{
	protected $table = 'tb_extensions';

	protected $casts = [
		'ext_captcha_status' => 'int'
	];

	protected $fillable = [
		'ext_googleWebmaster',
		'ext_googleAnalytics',
		'ext_googleAdsense',
		'ext_histats',
		'ext_captcha_status',
		'ext_captcha',
		'updated_by',
		'created_by'
	];
}
