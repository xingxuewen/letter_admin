<?php
/**
 * Created by PhpStorm.
 * User: yunli
 * Date: 2019/4/29
 * Time: 下午2:01
 */

namespace App\Models;

class UserAuthModel extends BaseModel
{

    protected $rememberTokenName = '';

    protected $table = 'crm_user_auth';

    protected $fillable = [
        'username',
        'mobile',
        'status',
    ];

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['created_at'];

//    public function userRole(){
//        return $this->belongsTo(CrmAdminUserRoleModel::class,'id','user_id');
//    }




}