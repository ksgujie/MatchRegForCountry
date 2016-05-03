@extends('layouts.admin.main')

@section('content')

    <div id="main_body">

        {{Form::open(['url'=>"admin/item/add"])}}
        <table class="tb">
            <tr>
                <th colspan="2"><h3>添加项目</h3></th>
            </tr>
            <tr>
                <td class="td_w120">项目名称</td>
                <td>

                    {{Form::text('name')}}
                    {{Form::select('type', ['个人项目'=>'个人项目', '团体项目'=>'团体项目'])}}
                    {{Form::submit('添加')}}
                    <div style='color:red'>{{$errors->first('name')}}</div>
                </td>
            </tr>
            <tr>
                <td class="td_w120"></td>
                <td>

                </td>
            </tr>
        </table>
        {{Form::close()}}


        <table width="500" border="0" cellpadding="10" cellspacing="0" class="tb">
            <tr>
                <th colspan="4"><h3>已设项目</h3></th>
            </tr>
            <tr>
                <td class="td_w120"><strong>序号</strong></td>
                <td><strong>项目名称</strong></td>
                <td><strong>项目类别</strong></td>
                <td><strong>改/删</strong></td>
            </tr>
            <!-- {{$i=0}} -->
            @foreach ($items as $d)
                    <!-- {{$i++}} -->
            <tr>
                <td>{{$i}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->type}}</td>
                <td>
                    {{HTML::link("admin/item/edit/$d->id", '修改')}}
                    {{HTML::link("admin/item/del/$d->id", '删除', ['onclick'=>"return confirm(\"确认删除 $d->name ？\")"] )}}
                </td>
            </tr>
            @endforeach
        </table>


        <table width="500" border="0" cellpadding="10" cellspacing="0" class="tb">
            <tr>
                <th colspan="4"><h3>设定不可兼报的项目</h3></th>
            </tr>
            {{Form::open(['url'=>'admin/item/setcanttogether'])}}
            <tr>
                <td class="td_w120"></td>
                <td colspan="3">
                    {{Form::select('id1', Item::getall())}}
                    {{Form::select('id2', Item::getall())}}
                    {{Form::submit()}}
                </td>
            </tr>
            {{Form::close()}}
            <tr>
                <th colspan="4"><h3>已设定的不可兼报的项目</h3></th>
            </tr>
                    <!-- {{$__i__=0}} -->
            @foreach($cantTogethers as $k=>$t)
                    <!-- {{$__i__++}} -->
            <tr>
                <td class="td_w120"> {{$__i__}} </td>
                <td> {{Item::find($t[0])->name}} </td>
                <td> {{Item::find($t[1])->name}} </td>
                <td> {{Html::link('admin/item/delcanttogether/'.$k, '删除')}} </td>
            </tr>
            @endforeach
        </table>



    </div>

@stop