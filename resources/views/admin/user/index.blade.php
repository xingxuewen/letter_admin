@extends('admin.layout.iframe_main')

@section('content')

<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> {{--首页--}}@lang('common.Home')
    <span class="c-gray en">&gt;</span> {{--用户中心--}}@lang('common.UserCenter')
    <a class="btn btn-success radius r  refresh-btn" style="line-height:1.6em;margin-top:3px" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
        <div class="text-l">
            <form method="GET" action="{{route('user.lists')}}">
                <p style="display: inline-block;" class="search_p">
                    <span>{{--用户名--}}@lang('common.username')</span>
                    <input type="text" class="input-text radius" value="{{$requestData['name'] ?? ''}} " style="width:200px" placeholder="用户名" id="" name="name">
                </p>
                <p style="display: inline-block" class="search_p">
                    <span>{{--性别--}}@lang('common.Sex')</span>
                    <span class="select-box radius"  style="width:150px;">
                        <select class="select " name="sex" size="1">
                            <option value="">{{--请选择--}}@lang('common.Select')</option>
                            <option value="1" @if(isset($requestData['sex']) && $requestData['sex'] == 1) selected @endif>{{--男--}}@lang('common.Man')</option>
                            <option value="0" @if(isset($requestData['sex']) && $requestData['sex'] == 0) selected @endif>{{--女--}}@lang('common.Female')</option>
                        </select>
                    </span>
                </p>
                <p style="display: inline-block" class="search_p">
                    <span>{{--状态--}}@lang('common.Status')</span>
                    <span class="select-box radius"  style="width:150px;">
                        <select class="select " name="status" size="1">
                            <option value="">{{--请选择--}}@lang('common.Select')</option>
                            <option value="1" @if(isset($requestData['status']) && $requestData['status'] == 1) selected @endif>{{--启用--}}@lang('common.Yes')</option>
                            <option value="0" @if(isset($requestData['status']) && $requestData['status'] == 0) selected @endif>{{--禁用--}}@lang('common.No')</option>
                        </select>
                    </span>
                </p>
                <button type="submit" class="btn btn-success radius"><i class="Hui-iconfont">&#xe665;</i> {{--查询--}}@lang('common.seek')
                </button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> {{--批量删除--}}@lang('common.Batch_deletion')</a></span>
        </div>

        <table class="table table-border table-bordered table-bg  table-hover radius">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th>ID</th>
                <th>{{--用户名称--}}@lang('common.username')</th>
                <th>{{--用户邮箱--}}@lang('common.Email')</th>
                <th>{{--性别--}}@lang('common.Sex')</th>
                <th>{{--创建时间--}}@lang('common.Create_Time')</th>
                <th>{{--更新时间--}}@lang('common.Edit_Time')</th>
                <th>{{--状态--}}@lang('common.Status')</th>
                <th width="300px">{{--操作--}}@lang('common.Actions')</th>
            </tr>
            </thead>
            <tbody>
                @forelse($result as $row)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$row->id}}" name="ids"></td>
                    <td class="id">{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>
                        @if($row->sex == 1)
                            <span class="label label-success">{{--男--}}@lang('common.Man')</span>
                        @elseif($row->sex == 0)
                            <span class="label label-danger">{{--女--}}@lang('common.Female')</span>
                        @else
                            <span class="label">{{--未填写--}}...</span>
                        @endif
                    </td>
                    <td>{{$row->created_at}}</td>
                    <td>{{$row->updated_at}}</td>
                    {{--<td>--}}
                        {{--<input class="input-text set-sort" type="number" style="width: 50px;text-align: center" value="{{$row->sort}}" autocomplete="off">--}}
                    {{--</td>--}}
                    <td>
                        <span class="label @if($row->status == 1) label-success @else label-danger @endif radius">
                        {{trans('common.status_'.$row->status)}}
                        </span>
                    </td>
                    <td class="f-14">
                        @if($row->status == 1)
                            <a class="set-btn" style="text-decoration:none" data-status="0" href="javascript:;"><i class="Hui-iconfont">&#xe631;</i></a>
                        @else
                            <a class="set-btn"  style="text-decoration:none" data-status="1" href="javascript:;"><i class="Hui-iconfont">&#xe615;</i></a>
                        @endif
                        <a title="编辑" href="javascript:;"
                           onclick="node_edit('权限编辑','{{route('user.edit',['id' => $row->id])}}','800','500')"
                           class="ml-5"
                           style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="node_del(this,'{{$row->id}}')" class="ml-5"
                           style="text-decoration:none">
                            <i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
                    @empty
                <tr>
                    <td colspan="100" style="color: red;text-align: center">无数据</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{$result->appends($requestData)->links()}}{{trans('common.of').":".$result->total().trans('common.entries')}}

</div>
@endsection
@section('script')
<script type="text/javascript">

    //  添加菜单
    function addMenu(title, url, weight, hight) {
        layer_show(title, url, weight, hight);
    }

    /*菜单-编辑*/
    function node_edit(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    $(function () {
        // 设置状态
        $('.set-btn').click(function () {
            var status = $(this).data('status');
            var col_id = $(this).parents('tr').find('.id').text();
            var msg = '';
            if(status == 1){
                msg = '确认要启用吗？';
            }else {
                msg = '确认要禁用吗？';
            }
            layer.confirm(msg, function (index) {
                setField('status', status, col_id);
            });
            return true;
        })

        $('.set-sort').change(function () {
            var col_id = $(this).parents('tr').find('.id').text();
            setField('sort',$(this).val(),col_id);
            return true;
        });
    });

    // 设置单项属性
    function setField(field, value, col_id) {
        $.ajax({
            url: '{{route('user.updateFielduser')}}',
            data: {
                'field': field,
                'value': value,
                'id': col_id
            },
            dataType: 'json',
            type: 'post',
            success: function (data) {
                if (data.status == 'error') {
                    layer.msg(data.error.message, {icon: 2, time: 1500});
                    return false;
                }
                layer.msg('修改成功!',{icon:1,time:1000});
                location.reload();
                return true;
            }
        });
    }

    /*管理员-删除*/
    function node_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '{{route('user.destroy')}}',
                data: {
                    'id': id
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status == 'error') {
                        layer.msg(data.error.message, {icon: 2, time: 1500});
                        return false;
                    }
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', {icon: 1, time: 1000});
                }
            });
        });
    }

    // 批量删除
    function datadel() {
        var id_arr = new Array();
        $('input:checkbox[name=ids]:checked').each(function (i) {
            id_arr[i] = $(this).val();
        });
        if (id_arr.length === 0) {
            layer.msg('未选中数据', {icon: 2, time: 1500});
            return false;
        }
        layer.confirm('确认要删除吗？', function () {
            $.ajax({
                type: 'POST',
                url: '{{route('user.destroy')}}',
                data: {
                    'id': id_arr
                },
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if (data.status == 'error') {
                        layer.msg(data.error.message, {icon: 2, time: 1500});
                        return false;
                    }
                    layer.msg('已删除!', {icon: 1, time: 1000});
                    location.reload();
                }
            });
        });
    }

</script>

@endsection
