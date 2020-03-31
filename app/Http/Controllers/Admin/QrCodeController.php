<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ResetPwdRequest;
use App\Logs\QALog;
use App\Helpers\RestResponseFactory;
use App\Helpers\RestUtils;
use App\Services\CacheService;
use App\Models\CrmAdminUserModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Services\QrCodeService;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class QrCodeController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * @var UserService
     */
    private $QrCodeService;

    const LOG_FILE = 'crm';

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     * @return void
     */
    public function __construct(QrCodeService $QrCodeService)
    {
        $this->QrCodeService = $QrCodeService;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $value = 'https://www.baidu.com'; //二维码内容
        //生成二维码图片
       $qr = QrCode::size(200)->generate(date('Y-m-d H:i:s'),public_path('qrcode').'qr1.png');
        //        (new QrCode())->format('png')->png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
        echo $qr;
//        return $res;
        return view('admin.qrcode.index');
    }

    //使用二维码code 登陆
    public function codeLogin(Request $request)
    {
        if($request->ajax()) {
            $codeId = $request->input('codeId');
            $arr = ['kcl5642703','kcl5627382','kcl2367190'];
            if(in_array($codeId,$arr)){
                return RestResponseFactory::ok(['message'=>'success']);
            }else{
                return RestResponseFactory::ok(RestUtils::getStdObj(), RestUtils::getErrorMessage(3301), 3301);
            }
        }
        return view('admin.qrcode.codeIndex');
    }
    //完善信息页面
    public function userInfo(Request $request)
    {
        echo 1;die;
        if($request->ajax()) {
            $codeId = $request->input('codeId');
            $arr = ['kcl5642703','kcl5627382','kcl2367190'];
            if(in_array($codeId,$arr)){
                return RestResponseFactory::ok(['message'=>'success']);
            }else{
                return RestResponseFactory::ok(RestUtils::getStdObj(), RestUtils::getErrorMessage(3301), 3301);
            }
        }
        return view('admin.qrcode.codeIndex');
    }

}
