<?php

use Illuminate\Support\Facades\Redirect;
class StudentController extends BaseController {
	
// 	protected $fillable = ['*'];

	public function getAdd()
	{
		return View::make('student.add');
	}
	
	public function postAdd() {
		$input = Input::all();

		$rules = Student::$rules;
		$item = Item::find((int)Input::get('item_id'));
		if ($item) {
			if ($item->type=='个人项目') {
				$rules['name'] = 'required|max:4';
			}
		}

		$valication = Validator::make($input, $rules, Student::$messages);
		if ($valication->passes() ) {
			//检测是否现报项目与已报项目是否不可兼报
			$alreadys = Student::where('name', trim(Input::get('name')))
						->where('user_id', Auth::user()->id)
						->get();
			foreach ($alreadys as $already) {
				if ($already) {
					$cantTogethers = Cache::get('不可兼报的项目',[]);
					$min = min(Input::get('item_id'), $already->item_id);
					$max = max(Input::get('item_id'), $already->item_id);
					$_key = "$min,$max";
					if (isset($cantTogethers[$_key])) {
						$msg = Input::get('name')." 同学已经报了“".$already->item->name."”，该项目与“".$item->name."”不可兼报！";
						return Redirect::back()->with('danger', $msg)->withInput();
					}
				}
			}


			$student = new Student();
			$student->user_id = Auth::user()->id;
			$student->group_id = Input::get('group_id');
			$student->item_id = Input::get('item_id');
			$student->name = trim( Input::get('name') );
			$student->remark = trim( Input::get('remark') );
			$student->save();
	
			return Redirect::to('student/add')->with('message', "选手 {$student->name} 添加成功！");
		}
	
		return Redirect::to('student/add/')->withErrors($valication)->withInput();
	}
	
	public function getList() {
		$students = Student::where('user_id', $this->userId)
			->orderBy('item_id')
			->orderBy('group_id')
			->get();
		return View::make('student.list')->with('students', $students );
	}
	
	public function getEdit($id) {
		$student = Student::where('id',$id)
			->where('user_id', $this->userId)
			->first();
		return View::make('student.edit')->with('student', $student );
	}
	
	public function postEdit($id) {
		$input = Input::all();
		
		$rules = Student::$rules;
		$item = Item::find((int)Input::get('item_id'));
		if ($item) {
			if ($item->type=='个人项目') {
				$rules['name'] = 'required|max:10';
			}
		}

		$valication = Validator::make($input, $rules, Student::$messages);
		if ($valication->passes() ) {
			$student = Student::where('id',$id)
				->where('user_id', $this->userId)
				->first();
			$student->group_id = Input::get('group_id');
			$student->item_id = Input::get('item_id');
			$student->name = trim( Input::get('name') );
			$student->remark = trim( Input::get('remark') );
			$student->save();
	
			return Redirect::to('student/list')->with('message', "选手 {$student->name} 修改成功！");
		}
	
		return Redirect::to('student/edit/'.$id)->withErrors($valication)->withInput();
	}
	
	public function getDel($id) {
		Student::where('id', $id)->where('user_id', Auth::user()->id)->delete();
		return Redirect::to('student/list')->with('message', '选手删除成功!');
	}
	
	public function getTest() {
		echo '<pre>';
		$item = Item::find(3);
		print_r($item);
		$rs=$item->student();
		dd($rs);
		foreach ($rs as $v) {
			print_r($v->name);
		}
	}

}