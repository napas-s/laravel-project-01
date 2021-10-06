<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbPage
 * 
 * @property int $id
 * @property string|null $page_detail
 * @property string|null $page_seo_detail
 * @property string|null $page_parmalink
 * @property int $page_show
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbPage extends Model
{
	protected $table = 'tb_pages';

	protected $casts = [
		'page_show' => 'int'
	];

	protected $fillable = [
		'page_detail',
		'page_seo_detail',
		'page_parmalink',
		'page_show',
		'updated_by',
		'created_by'
	];
}
