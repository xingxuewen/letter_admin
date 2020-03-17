@extends('admin.layout.iframe_main')
@section('content')

<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="add-role-form">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 用户真实名称：</label>
            <div class="formControls col-xs-8 col-sm-5">
                <input type="text" class="input-text" id="name" name="username" required="required" value="{{$result->username ?? ''}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 论坛名称：</label>
            <div class="formControls col-xs-8 col-sm-5">
                <input type="text" class="input-text" id="name" name="ucenter_name" required="required" value="{{$result->ucenter_name ?? ''}}">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">状态：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box" style="padding-left: 0px;">
                    <input type="radio" id="status-1" name="app_status" value="1" @if(!empty($result->status) && $result->app_status == 1) checked @endif>
                    <label for="status-1">在线</label>
                </div>
                <div class="radio-box" style="padding-left: 0px;">
                    <input type="radio" id="status-2" name="app_status" value="0" @if(isset($result->status) && $result->app_status == 0) checked @endif>
                    <label for="status-2">离线</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 宠宠币：</label>
            <div class="formControls col-xs-8 col-sm-5">
                <input type="text" class="input-text" id="money" name="money" required="required" value="{{$result->money ?? ''}}">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span> 用户积分：</label>
            <div class="formControls col-xs-8 col-sm-5">
                <input type="text" class="input-text" id="score" name="score" required="required" value="{{$result->score ?? ''}}">
            </div>
        </div>

        <div class="row cl">
            <input type="hidden" value="{{$result->id ?? 0}}" name="id" />
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-success radius" id="admin-add-role" name="admin-add-role"><i class="icon-ok"></i> 确定</button>
            </div>
        </div>

    </form>
</article>

@endsection
@section('script')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
    $(function(){
        //提交
        $('#add-role-form').submit(function(){
            var index;
            $.ajax({
                type:"POST",
                url:"{{$postUrl}}",
                data: $(this).serialize(),
                dataType: 'JSON',
                beforeSend:function(XMLHttpRequest)
                {
                    index = layer.load(0, {shade: false});
                },
                success: function(data){
                    // console.log(data); return false;
                    if (data.status == 'error') {
                        layer.msg(data.error.message, {icon: 2, time: 1500});
                        return false;
                    }
                    layer.msg('添加成功!',{icon:1,time:1000});
                    window.parent.location.reload();
                    return true;
                }
            });
            return false;
        })


    });
</script>
@endsection




