@extends('layouts.main')


<div style="width:800px; MARGIN-RIGHT: auto; MARGIN-LEFT: auto; ">
@section('content')

<style>
	input { width:500px;}
</style>

<div id="main_body">

<div id="myselect"> 
    {{Form::open(['url'=>'user/reg'])}}
      <table class="tb">
        <tr>
            <th colspan="2"><h3>新用户注册</h3></th>
        </tr>
        
      
        <tr>
          <td class="td_w120">参赛队</td>
            <td>
          {{ Form::text('username') }}
           {{ $errors->first('username', '<div style="color:red">:message</div>') }}
            </td>
        </tr>
        <tr>
          <td class="td_w120">登陆密码</td>
          <td>
          {{ Form::text('password') }}
           {{ $errors->first('password', '<div style="color:red">:message</div>') }}
            </td>
        </tr>

        {{--<tr>--}}
          {{--<td class="td_w120">领队姓名</td>--}}
          {{--<td>--}}
          {{--{{ Form::text('leader') }}--}}
           {{--{{ $errors->first('leader', '<div style="color:red">:message</div>') }}--}}
            {{--</td>--}}
        {{--</tr>--}}

        {{--<tr>--}}
          {{--<td class="td_w120">领队电话</td>--}}
          {{--<td>--}}
                    {{--{{ Form::text('tel') }}--}}
           {{--{{ $errors->first('tel', '<div style="color:red">:message</div>') }}--}}
             {{--</td>--}}
        {{--</tr>--}}

        {{--<tr>--}}
          {{--<td class="td_w120">联系地址</td>--}}
          {{--<td>--}}
                    {{--{{ Form::text('address') }}--}}
           {{--{{ $errors->first('address', '<div style="color:red">:message</div>') }}--}}
          {{--</td>--}}
        {{--</tr>--}}
        <tr>
          <td class="td_w120"></td>
          <td>{{ Form::submit('确定') }}          </td>
        </tr>
    </table>
  {{Form::close()}}

</div>
</div>
</div>
@stop


