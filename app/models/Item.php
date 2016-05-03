<?php

class Item extends BaseModel {
	
	public $timestamps=false;

// 	protected $table = 'users';

	
	public static $rules = array(
		'name'	=>	'required',		
	);
	
	public static function getall() {
		$items = array_multi2single(Item::all(), 'name', 'id');
//		$items['']='请选择';
//		$items = array_merge($items_1, $items_2);
		if(count($items)<=2) {
			unset($items['']);
		}
		return (array)$items;
	}
	
	public function teacher() {
// 		return $this->hasOne('Teacher', 'item_id', 'user_id');
		return Teacher::where('user_id', Auth::user()->id)->
							  where('item_id', $this->id)->first();
	}

	public function students() {
		return $this->hasMany('Student');
	}
	
	
}