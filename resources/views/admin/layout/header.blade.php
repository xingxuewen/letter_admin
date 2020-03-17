<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="{{route('admin.index')}}">
            @lang('common.crm')
            </a>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    @if(\App::getLocale() == "zh")
                        <li id="Hui-skin2" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_C" title="en">English</a></li>
                    @else
                        <li id="Hui-skin1" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_B" title="zh">简体中文</a></li>
                    @endif
                    <li>{{--角色--}}@lang('common.role')</li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A">{{Auth::user()->username ?? ''}}<i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="{{route('admin.editPwd')}}">{{--修改密码--}}@lang('common.update_password')</a></li>
                            <li><a href="{{route('admin.logout')}}">{{--注销--}}@lang('common.Cancellation')</a></li>
                        </ul>
                    </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">{{--默认（黑色）--}}@lang('common.black')</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">{{--蓝色--}}@lang('common.blue')</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">{{--绿色--}}@lang('common.green')</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">{{--红色--}}@lang('common.red')</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">{{--黄色--}}@lang('common.yellow')</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">{{--橙色--}}@lang('common.orange')</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>