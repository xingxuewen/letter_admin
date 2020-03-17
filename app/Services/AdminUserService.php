<?php
/**
 * Created by PhpStorm.
 * User: yunli
 * Date: 2019/4/30
 * Time: 上午10:48
 */

namespace App\Services;


use App\Models\UserModel;
use App\Models\CrmAdminRolePermissionModel;

class AdminUserService
{

    /**
     * 列表查询
     * @param array $data
     * @return mixed
     * @user yun.li
     * @time 2019/5/6 下午6:45
     */
    public function getLists(array $data = [])
    {
        $page = $data['page'] ?? 1;
        $pageCount = $data['pageCount'] ?? config('crm.pageCount');
        $result = UserModel::query();
        if (!empty($data['name'])) {
            $result->where('name', 'like', $data['name'] . '%');
        }
        if (!empty($data['status'])) {
            $result->where('status', '=', $data['status']);
        }
        if (!empty($data['sex'])) {
            $result->where('sex', '=', $data['sex']);
        }
        $result->orderBy('created_at','desc');
        if(!empty($data['is_admin'])){
            $result = $result->paginate($pageCount);
            return $result;
        }

        $totalCount = $result->count();
        $rows = $result->offset(($page - 1) * $pageCount)
            ->limit($pageCount)
            ->get();
        $return = formatPage($rows, $totalCount, $page, $pageCount);
        return $return;
    }

    /**
     * 创建角色
     * @param array $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     * @user yun.li
     * @time 2019/5/6 下午6:13
     */
    public function createRole(array $data)
    {
        return UserModel::create($data);
    }
    /**
     * 查询权限信息
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object|static
     * @user yun.li
     * @time 2019/5/7 上午11:55
     */
    public function getPermissionByCond(array $data = [])
    {
        $result = CrmAdminPermissionModel::query();
        if ($data['id']) {
            $result->where('id', '=', $data['id']);
        }
        $result = $result->first();
        return $result;
    }

    /**
     * 通过ID查询
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     * @user yun.li
     * @time 2019/5/6 下午6:23
     */
    public function getUserById(int $id)
    {
        $result = UserModel::where('id', '=', $id)->first();
        return $result;
    }

    /**
     * 通过ID修改用户信息
     * @param int $id
     * @param array $updateData
     * @return int
     * @user yun.li
     * @time 2019/5/6 下午6:30
     */
    public function updateUserById(int $id, array $updateData)
    {
        return UserModel::where('id', '=', $id)
            ->update($updateData);
    }

    /**
     * 通过ID删除角色
     * @param $id
     * @return int
     * @user yun.li
     * @time 2019/5/6 下午6:47
     */
    public function deleteUserById($id)
    {
        return UserModel::destroy($id);
    }

    /**
     * 修改角色拥有的权限
     * @param int $roleId
     * @param array $permissionId
     * @return bool
     * @user yun.li
     * @time 2019/5/7 下午3:38
     * @throws
     */
    public function updateRolePermission(int $roleId, array $permissionId = [])
    {
        try {
            \DB::beginTransaction();
            CrmAdminRolePermissionModel::where('role_id', '=', $roleId)->delete();
            if (!empty($permissionId)) {
                $addData = [];
                foreach ($permissionId as $value) {
                    $addData[] = [
                        'role_id' => $roleId,
                        'permission_id' => $value
                    ];
                }
                CrmAdminRolePermissionModel::insert($addData);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw new \Exception($e->getMessage());
        }
        return true;
    }

    /**
     * 查询角色拥有的权限
     * @param int $roleId
     * @return array
     * @user yun.li
     * @time 2019/5/7 下午6:07
     */
    public function getRolePermission(int $roleId)
    {
        $result = CrmAdminRolePermissionModel::with('permission')
            ->where('role_id', '=', $roleId)
            ->get();

        if ($result->isEmpty()) {
            return [];
        }
        $detail = [];
        foreach ($result as $value) {
            if (!empty($value->permission)) {
                $detail[] = [
                    'permission_id' => $value->permission->id,
                    'permission_name' => $value->permission->title,
                ];
            }
        }
        return $detail;
    }

    /**
     * 获取所有角色
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @user yun.li
     * @time 2019/5/20 上午10:15
     */
    public function getAllRole()
    {
        return CrmAdminRoleModel::where('status', '=', 1)->get();
    }





}