<script type="text/javascript" src="{{asset('H-ui-admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('H-ui-admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('H-ui-admin/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('H-ui-admin/static/h-ui.admin/js/H-ui.admin.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#Hui-skin1').click(function () {
        var language =$('.dropDown_B').attr('title');
        $.ajax({
            url:"{{route('admin.index')}}",    //请求的url地址
            dataType:"json",   //返回格式为json
            async:true,//请求是否异步，默认为异步，这也是ajax重要特性
            data:{"language":language},    //参数值
            type:"GET",   //请求方式
            beforeSend:function(){
                //请求前的处理
            },
            success:function(req){
                //请求成功时处理
                if(req.code == "200"){
                    window.location.reload();
                }

            },
            complete:function(){
                //请求完成的处理
            },
            error:function(){
                //请求出错处理
            }
        });
    });
    $('#Hui-skin2').click(function () {
        var language =$('.dropDown_C').attr('title');
        $.ajax({
            url:"{{route('admin.index')}}",    //请求的url地址
            dataType:"json",   //返回格式为json
            async:true,//请求是否异步，默认为异步，这也是ajax重要特性
            data:{"language":language},    //参数值
            type:"GET",   //请求方式
            beforeSend:function(){
                //请求前的处理
            },
            success:function(req){
                //请求成功时处理
                if(req.code == "200"){
                    window.location.reload();
                }
            },
            complete:function(){
                //请求完成的处理
            },
            error:function(){
                //请求出错处理
            }
        });
    })
</script>