<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbSetting
 * 
 * @property int $id
 * @property string|null $setting_logoWeb
 * @property string|null $setting_iconWeb
 * @property string|null $setting_nameWeb
 * @property string|null $setting_detail
 * @property string|null $setting_keyword
 * @property string|null $setting_telContact
 * @property string|null $setting_faxContact
 * @property string|null $setting_emailContact
 * @property string|null $setting_idLine
 * @property string|null $setting_LinkYoutube
 * @property string|null $setting_LinkTwitter
 * @property string|null $setting_LinkInstagram
 * @property string|null $setting_LinkFacebook
 * @property string|null $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class TbSetting extends Model
{
	protected $table = 'tb_setting';

	protected $fillable = [
		'setting_logoWeb',
		'setting_iconWeb',
		'setting_nameWeb',
		'setting_detail',
		'setting_keyword',
		'setting_telContact',
		'setting_faxContact',
		'setting_emailContact',
		'setting_idLine',
		'setting_LinkYoutube',
		'setting_LinkTwitter',
		'setting_LinkInstagram',
		'setting_LinkFacebook',
		'updated_by'
	];
}
