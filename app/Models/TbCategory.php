<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbCategory
 * 
 * @property int $id
 * @property string|null $cat_name
 * @property string|null $cat_parmalink
 * @property int $cat_show
 * @property int $cat_status
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbCategory extends Model
{
	protected $table = 'tb_category';

	protected $casts = [
		'cat_show' => 'int',
		'cat_status' => 'int'
	];

	protected $fillable = [
		'cat_name',
		'cat_parmalink',
		'cat_show',
		'cat_status',
		'created_by',
		'updated_by'
	];
}
