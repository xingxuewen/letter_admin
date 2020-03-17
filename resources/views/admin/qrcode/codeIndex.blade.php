<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <style type="text/css">
        * {
            margin: 0px;
        }

        #content {
            margin: 150px auto;
            width: 100%;
            height: 460px;
            border: 1px transparent solid;
            background-color: #21D4FD;
            background-image: linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
            background-image: -webkit-linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
            background-image: -moz-linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
            background-image: -o-linear-gradient(243deg, #21D4FD 0%, #B721FF 100%);
        }

        #box {
            margin: 50px auto;
            width: 30%;
            height: 360px;
            background-color: #fff;
            text-align: center;
            border-radius: 15px;
            border: 2px #fff solid;
            box-shadow: 10px 10px 5px #000000;
        }

        .title {
            line-height: 58px;
            margin-top: 20px;
            font-size: 36px;
            color: #000;
            height: 58px;
        }

        #box:hover {
            border: 2px #fff solid;
        }

        .input {
            margin-top: 20px;
        }

        input {
            margin-top: 5px;
            outline-style: none;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 13px 14px;
            width: 70%;
            font-size: 14px;
            font-weight: 700;
            font-family: "Microsoft soft";
        }

        button {
            margin-top: 20px;
            border: none;
            color: #000;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 15px;
            background-color: #CCCCCC;
        }
        button:hover{
            background-color: #B721FF;
            color: #fff;
        }
    </style>
</head>
<body>
<div id="content">
    <div id="box">
        <div class="title">Login</div>
{{--        <form method="POST" action="{{route('admin.code.index')}}">--}}
            <div class="input">
                <input type="text" id="codeId" value="" placeholder="二维码标识号" />
                <br>
                <br>
                <br>
                <button type="button" id="sub">下一步</button>
            </div>
        {{--</form>--}}
    </div>
</div>

</body>
<script type="text/javascript" src="{{asset('H-ui-admin/lib/jquery/1.9.1/jquery.min.js')}}"></script>
<script type="text/javascript">
    $('#sub').click(function () {
        var codeId = $('#codeId').val();
        if (codeId == "") {
            alert("请填写二维码标识号");
            return false;
        }
        $.ajax({
            url:"{{route('admin.code.login')}}",    //请求的url地址
            dataType:"json",   //返回格式为json
            async:true,//请求是否异步，默认为异步，这也是ajax重要特性
            data:{"codeId":codeId},    //参数值
            type:"GET",   //请求方式
            beforeSend:function(){
            },
            success:function(req){
                var code = req.error_code;
                if(code == 0){
                    window.location.href = "{{route('admin.user.info')}}";
                }else{
                    alert("二维码标识号不正确");
                    return false;
                }
                //请求成功时处理
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
</html>