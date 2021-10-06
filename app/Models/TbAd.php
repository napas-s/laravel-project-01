<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbAd
 * 
 * @property int $id
 * @property string|null $ads_name
 * @property string|null $ads_link
 * @property string|null $ads_display
 * @property int $ads_set_date_status
 * @property string|null $ads_set_date_start
 * @property string|null $ads_set_date_end
 * @property string|null $ads_img
 * @property string|null $ads_note
 * @property int $ads_show
 * @property int|null $ads_position
 * @property int $ads_sort
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbAd extends Model
{
	protected $table = 'tb_ads';

	protected $casts = [
		'ads_set_date_status' => 'int',
		'ads_show' => 'int',
		'ads_position' => 'int',
		'ads_sort' => 'int'
	];

	protected $fillable = [
		'ads_name',
		'ads_link',
		'ads_display',
		'ads_set_date_status',
		'ads_set_date_start',
		'ads_set_date_end',
		'ads_img',
		'ads_note',
		'ads_show',
		'ads_position',
		'ads_sort',
		'updated_by',
		'created_by'
	];
}
