<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbBanner
 * 
 * @property int $id
 * @property string|null $banner_link
 * @property string|null $banner_img
 * @property int $banner_show
 * @property int $banner_sort
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbBanner extends Model
{
	protected $table = 'tb_banner';

	protected $casts = [
		'banner_show' => 'int',
		'banner_sort' => 'int'
	];

	protected $fillable = [
		'banner_link',
		'banner_img',
		'banner_show',
		'banner_sort',
		'updated_by',
		'created_by'
	];
}
