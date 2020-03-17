<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannerModel;
use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;

class BannerController extends BaseController
{
    /**
     * 日志文件
     */
    const LOG_FILE = 'crm';

    /**
     * @var RoleService
     */
    private $lmBannerService;

    public function __construct(BannerService $lmBannerService)
    {
        $this->lmBannerService = $lmBannerService;
    }
    //
    public function index(Request $request){
        $requestData             = $request->all();
        $requestData['is_admin'] = 1;
        $result                  = $this->lmBannerService->getLists($requestData);
        $title                   = '首页Banner';
        $data                    = compact('result', 'title', 'requestData');
        return view('admin.banner.index', $data);
    }
    /**
     * 查看单个角色详情
     * @param Request $request
     * @return mixed
     * @user yun.li
     * @time 2019/5/6 下午6:26
     */
    public function edit(Request $request)
    {
        $id = $request->input('id', 0);
        if (empty($id)) {
            return $this->error('params_error', trans('common.params_error'));
        }
        $postUrl = route('userAuth.update');
        $result  = $this->lmBannerService->getUserById($id);
        $data    = compact('result', 'postUrl');
        return view('admin.userAuth.create', $data);
    }
    /**
     * 修改单个角色信息
     * @param Request $request
     * @return mixed
     * @user yun.li
     * @time 2019/5/6 下午6:35
     */
    public function update(Request $request)
    {
        $id     = $request->input('id', 0);
        $name   = $request->input('name', '');
        $status = $request->input('status', 1);
        if (empty($id) || empty($name)) {
            return $this->error('params_error', trans('common.params_error'));
        }
        try {
            $this->lmBannerService->updateUserById($id, ['name' => $name, 'status' => $status]);
            return $this->success();
        } catch (\Exception $e) {
            $errData = [
                'errMsg'      => $e->getMessage(),
                'errTrace'    => $e->getTraceAsString(),
                'requestData' => $request->all(),
            ];
            QALog::error(__METHOD__, $errData, self::LOG_FILE);
            return $this->error('service_error', trans('common.service_error'));
        }
    }
    /**
     * 修改单项字段
     * @param Request $request
     * @return mixed
     * @user yun.li
     * @time 2019/5/20 下午3:18
     */
    public function updateField(Request $request)
    {
        $requestData = $request->all();
        if (empty($requestData['id']) || empty($requestData['field'])) {
            return $this->error('params_error', trans('common.params_error'));
        }
        try {
            $updateData = [
                $requestData['field'] => $requestData['value']
            ];
            $this->lmBannerService->updateUserById($requestData['id'], $updateData);
            return $this->success();
        } catch (\Exception $e) {
            $errLog = [
                'errMsg'      => $e->getMessage(),
                'requestData' => $requestData
            ];
            QALog::error(__METHOD__, $errLog, self::LOG_FILE);
            return $this->error();
        }
    }
    /**
     * 删除角色
     * @param Request $request
     * @return mixed
     * @user yun.li
     * @time 2019/5/6 下午6:49
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id', 0);
        if (empty($id)) {
            return $this->error('params_error', trans('common.params_error'));
        }
        try {
            $id = is_array($id) ? $id : [$id];
            $this->lmBannerService->deleteUserById($id);
            return $this->success();
        } catch (\Exception $e) {
            $errData = [
                'errMsg'      => $e->getMessage(),
                'errTrace'    => $e->getTraceAsString(),
                'requestData' => $request->all(),
            ];
            QALog::error(__METHOD__, $errData, self::LOG_FILE);
            return $this->error('service_error', trans('common.service_error'));
        }
    }
}
