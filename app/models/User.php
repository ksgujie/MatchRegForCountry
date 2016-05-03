<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
include app_path().'/libs/functions.php';

class User extends Eloquent implements UserInterface, RemindableInterface {
	
	public $timestamps=false;

    protected $guarded=[];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public static $rulesLeader = array(
 		'username'	=>	'required',
		'leader'	=>	'required',
		'address'	=>	'required',
		'tel'		=>	'required',
		'diners'	=>	'required|numeric',
		'boys'		=>	'required|numeric',
		'girls'		=>	'required|numeric',
		'adultmales'	=>	'required|numeric',
		'adultfemales'	=>	'required|numeric',
	);

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	public static function getAll() {
		$admin=User::where('isadmin',1)->first();
		$r[""][0]='请选择帐号';
		$r[""][$admin->id]=$admin->username;
// 		$r['admin']='管理员';
		$users=User::where('isadmin',0)->orderby('id')->get();
		foreach ($users as $user) {
			$pinyin = pinyin($user->username);
			$firstLetter = strtoupper($pinyin[0]);
			$r[$firstLetter][$user->id]= $user->username;
		}
		ksort($r,SORT_STRING);
		return $r;
	}

	public function students() {
		return $this->hasMany('Student');
	}

	public static $rulesAdd = array(
		'username'	=>	'required',
		'password'	=>	'required',
//		'leader'	=>	'required',
//		'address'	=>	'required',
//		'tel'	=>	'required',
	);


	

}