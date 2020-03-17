<dt>@if(\App::getLocale() == "zh")
        {{$val['title']}}
    @else
        {{$val['en_title']}}
    @endif
        <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
<dd>
    <ul>
        @if(\App::getLocale() == "zh")
            @foreach($val['child'] as $v)
                <li><a data-href="{{url($v['path'])}}" title="{{$v['title']}}" data-title="{{$v['title']}}"
                       href="javascript:void(0)">{{$v['title']}}</a></li>
            @endforeach
        @else
            @foreach($val['child'] as $v)
                <li><a data-href="{{url($v['path'])}}" title="{{$v['en_title']}}" data-title="{{$v['en_title']}}"
                       href="javascript:void(0)">{{$v['en_title']}}</a></li>
            @endforeach
        @endif
    </ul>
</dd>
