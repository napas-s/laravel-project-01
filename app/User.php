<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $displayname
 * @property string|null $img
 * @property string|null $tel
 * @property string|null $penname
 * @property int $status
 * @property string|null $aboutme
 * @property string|null $lastlogin
 * @property string|null $update_by
 * @property string|null $crate_by
 * @property int|null $level
 *
 * @property TbLevel|null $tb_level
 * @property Collection|UsersLevel[] $users_levels
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	protected $table = 'users';

	protected $casts = [
		'status' => 'int',
		'level' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'remember_token',
		'displayname',
		'img',
		'tel',
		'penname',
		'status',
		'aboutme',
		'lastlogin',
		'update_by',
		'crate_by',
		'level'
	];

	public function tb_level()
	{
		return $this->belongsTo(TbLevel::class, 'level');
	}

	public function users_levels()
	{
		return $this->hasMany(UsersLevel::class, 'UserId');
	}
}
