@extends('layouts.main')

@section('content')

<div id="main_body">    
	
    {{Form::model($user)}}
      <table class="tb">
        <tr>
            <th colspan="2"><h3>参赛队信息</h3></th>
        </tr>
        <tr>
            <td class="td_w120">参赛队名</td>
          <td>
         
          {{Form::text('username')}}   
          {{ $errors->first('username', '<div style="color: red">:message</div>') }}
                 </td>
        </tr>        
        <tr>
            <td class="td_w120">领队姓名</td>
          <td>
         
          {{Form::text('leader')}}   
          {{ $errors->first('leader', '<div style="color: red">:message</div>') }}
                 </td>
        </tr>
        <tr>
          <td class="td_w120">联系地址</td>
          <td>{{Form::text('address')}} 
          {{ $errors->first('address', '<div style="color: red">:message</div>') }}
          </td>
        </tr>
        <tr>
          <td class="td_w120">联系电话</td>
          <td>{{Form::text('tel')}}
          {{ $errors->first('tel', '<div style="color: red">:message</div>') }}
           </td>
        </tr>
        <tr>
          <td class="td_w120">用餐人数　<div>　</div></td>
          <td>{{Form::text('diners')}}
				<div style="color:blue">注：这只是程序中预设的一个功能，具体比赛当天是否提供午餐请咨询承办单位！</div>
          
          {{ $errors->first('diners', '<div style="color: red">:message</div>') }}
          
          
           </td>
        </tr>
                <tr>
            <th colspan="2"><h3>需要安排住宿人数统计</h3></th>
        </tr>
        </tr>
                <tr>
            <td colspan="2">
				<div style="color:blue">注：这只是程序中预设的一个功能，是否安排住宿请咨询承办单位！</div>
				</td>
        </tr>
        
        <tr>
            <td class="td_w120">男性学生人数</td>
          <td>
         
          {{Form::text('boys')}}   
          {{ $errors->first('boys', '<div style="color: red">:message</div>') }}
                 </td>
        </tr>
        
        <tr>
            <td class="td_w120">女性学生人数</td>
          <td>
         
          {{Form::text('girls')}}   
          {{ $errors->first('girls', '<div style="color: red">:message</div>') }}
                 </td>
        </tr>
        
        <tr>
            <td class="td_w120">成年男性人数</td>
          <td>
         
          {{Form::text('adultmales')}}   
          {{ $errors->first('adultmales', '<div style="color: red">:message</div>') }}
                 </td>
        </tr>
        
        <tr>
            <td class="td_w120">成年女性人数</td>
          <td>
         
          {{Form::text('adultfemales')}}   
          {{ $errors->first('adultfemales', '<div style="color: red">:message</div>') }}
                 </td>
        </tr>
        
        
        <tr>
            <td class="td_w120"></td>
            <td>
            {{Form::submit('确定')}}            </td>
        </tr>
    </table>
  {{Form::close()}}

</div>

@stop