<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbTagmanager
 * 
 * @property int $id
 * @property string|null $setting_tag
 * @property string|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbTagmanager extends Model
{
	protected $table = 'tb_tagmanager';

	protected $fillable = [
		'setting_tag',
		'updated_by'
	];
}
