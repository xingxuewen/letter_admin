@extends('admin.layout.iframe_main')

@section('content')

<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> {{--首页--}}@lang('common.Home')
    <span class="c-gray en">&gt;</span> {{--用户管理--}}@lang('common.UserManage')
    <a class="btn btn-success radius r  refresh-btn" style="line-height:1.6em;margin-top:3px" title="刷新">
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
        <div class="text-l">
            <form method="GET" action="{{route('user.lists')}}">
                <p style="display: inline-block;" class="search_p">
                    <span>{{--用户真实姓名--}}@lang('common.username')</span>
                    <input type="text" class="input-text radius" value="{{$requestData['username'] ?? ''}} " style="width:200px" placeholder="用户真实姓名" id="" name="username">
                </p>
                <p style="display: inline-block;" class="search_p">
                    <span>{{--用户论坛名称--}}@lang('common.ClubName')</span>
                    <input type="text" class="input-text radius" value="{{$requestData['ucenter_name'] ?? ''}} " style="width:200px" placeholder="用户论坛名称" id="" name="ucenter_name">
                </p>
                <p style="display: inline-block" class="search_p">
                    <span>分类</span>
                    <span class="select-box radius"  style="width:150px;">
                        <select class="select " name="indent" size="1">
                            <option value="">请选择</option>
                            <option value="1" @if(isset($requestData['indent']) && $requestData['indent'] == 1) selected @endif>大学生</option>
                            <option value="2" @if(isset($requestData['indent']) && $requestData['indent'] == 2) selected @endif>上班族</option>
                            <option value="3" @if(isset($requestData['indent']) && $requestData['indent'] == 3) selected @endif>企业主</option>
                            <option value="4" @if(isset($requestData['indent']) && $requestData['indent'] == 4) selected @endif>其他</option>
                        </select>
                    </span>
                </p>
                <p style="display: inline-block" class="search_p">
                    <span>状态</span>
                    <span class="select-box radius"  style="width:150px;">
                        <select class="select " name="status" size="1">
                            <option value="">请选择</option>
                            <option value="1" @if(isset($requestData['status']) && $requestData['status'] == 1) selected @endif>启用</option>
                            <option value="0" @if(isset($requestData['status']) && $requestData['status'] == 0) selected @endif>禁用</option>
                        </select>
                    </span>
                </p>
                <button type="submit" class="btn btn-success radius"><i class="Hui-iconfont">&#xe665;</i> 查询
                </button>
            </form>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20">
            <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a></span>
        </div>

        <table class="table table-border table-bordered table-bg  table-hover radius">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th>ID</th>
                <th>{{--用户真实名称--}}@lang('common.username')</th>
                <th>{{--用户论坛名称--}}@lang('common.UcenterName')</th>
                <th>{{--是否激活--}}@lang('common.IsActivated')</th>
                <th>{{--分类--}}@lang('common.Type')</th>
                <th>{{--终端--}}@lang('common.Version')</th>
                <th>宠宠币</th>
                <th>用户积分</th>
                <th>登录状态</th>
                <th>创建时间</th>
                <th>状态</th>
                <th width="300px">操作</th>
            </tr>
            </thead>
            <tbody>
                @forelse($result as $row)
                <tr class="text-c">
                    <td><input type="checkbox" value="{{$row->id}}" name="ids"></td>
                    <td class="id">{{$row->id}}</td>
                    <td>{{$row->username}}</td>
                    <td>{{$row->ucenter_name}}</td>
                    <td>
                        @if($row->activated == 1)
                            <span class="label label-success">激活</span>
                        @else($row->activated == 0)
                            <span class="label label-danger">未激活</span>
                        @endif
                    </td>
                    <td>
                        @if($row->indent == 1)
                            <span class="label label-success">大学生</span>
                        @elseif($row->indent == 2)
                            <span class="label label-success">上班族</span>
                        @elseif($row->indent == 3)
                            <span class="label label-success">企业主</span>
                        @else
                        <span class="label label-success">其他</span>
                        @endif
                    </td>
                    <td>
                        @if($row->version == 1)
                            <span class="label label-success">ios</span>
                        @elseif($row->version == 2)
                            <span class="label label-success">android</span>
                        @else
                            <span class="label label-success">h5</span>
                        @endif
                    </td>
                    <td>{{$row->money}}</td>
                    <td>{{$row->user_score}}</td>
                    <td>
                        @if($row->app_status == 1)
                            <span class="label label-success">在线</span>
                        @else($row->app_status == 0)
                            <span class="label label-success">离线</span>
                        @endif
                    </td>
                    <td>{{$row->created_at}}</td>
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
                           onclick="node_edit('权限编辑','{{route('userAuth.edit',['id' => $row->id])}}','800','500')"
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
        {{$result->appends($requestData)->links()}}{{'共：'.$result->total().'条'}}

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
