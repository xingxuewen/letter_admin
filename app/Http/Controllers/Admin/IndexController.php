<?php
/**
 * Created by PhpStorm.
 * User: yunli
 * Date: 2019/5/19
 * Time: 下午1:17
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\RestResponseFactory;
use Illuminate\Support\Facades\App;

class IndexController extends BaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            App::setLocale($data['language']);
            $res = $request->session()->put('language', $data['language']);
            return RestResponseFactory::ok($res);
        } else {
            //刷新后页面，再去获取语言包
            $rr = App::getLocale();
            return view('admin.index',compact('rr'));
        }
    }
}