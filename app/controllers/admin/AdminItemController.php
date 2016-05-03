<?php

use Illuminate\Support\Facades\Redirect;
class AdminItemController extends AdminController {
	
	public function getList() {
		$items = Item::all();
		//读取不可兼报的项目
		$cantTogethers = Cache::get('不可兼报的项目', []);
		return View::make('admin.item.list')
				->with('items',$items)
				->with('cantTogethers', $cantTogethers);
	}
	
	public function postAdd() {
		$input = Input::all ();
		$validation = Validator::make ( $input, Item::$rules );
	
		if ($validation->passes ()) {
				
			$item = new Item();
			$item->name = trim(Input::get('name'));
			$item->type = trim(Input::get('type'));
			$item->save ();
			return Redirect::to ( 'admin/item/list' )->with('message', '项目添加成功!');
		}
	
		return Redirect::to('admin/item/list')->withErrors($validation);
	}

	public function getDel($id) {
		Item::find($id)->delete();
		return Redirect::to ( 'admin/item/list' )->with('message', '删除项目成功!');
	}
	
	public function getEdit($id) {
		$item = Item::find($id);
		return View::make('admin.item.edit')->with('item', $item);
	}
	
	public function postEdit($id) {
		$name = trim(Input::get('name'));
		$item = Item::find($id);
		$item->name = $name;
		$item->type = trim(Input::get('type'));
		$item->save();
		return Redirect::to('admin/item/list')->with('message', '修改成功！');
	}

	public function postSetcanttogether()
	{
		$id1=Input::get('id1');
		$id2=Input::get('id2');
		if (!strlen($id1) || !strlen($id2)) {
			return Redirect::back()->with('danger', '请选择项目后再提交');
		}

		$min = min($id1, $id2);
		$max = max($id1, $id2);
		$key = $min.','.$max;
		$cache = Cache::get('不可兼报的项目', []);
		$cache[$key] = [$min, $max];
		Cache::forever('不可兼报的项目', $cache);
		return Redirect::back()->with('message', '不可兼报项设定成功');
	}

	//删除已设定的不可兼报项目
	public function getDelcanttogether($key)
	{
		$cache=Cache::get('不可兼报的项目', []);
		unset($cache[$key]);
		Cache::forever('不可兼报的项目', $cache);
		return Redirect::back()->with('message', '删除成功');
	}
	
}