<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbCustomcode
 * 
 * @property int $id
 * @property string $custom_parmalink
 * @property string $custom_title
 * @property string $custom_detail
 * @property string $custom_type
 * @property int $custom_show
 * @property string $custom_crateby
 * @property string $custom_updateby
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbCustomcode extends Model
{
	protected $table = 'tb_customcode';

	protected $casts = [
		'custom_show' => 'int'
	];

	protected $fillable = [
		'custom_parmalink',
		'custom_title',
		'custom_detail',
		'custom_type',
		'custom_show',
		'custom_crateby',
		'custom_updateby'
	];
}
