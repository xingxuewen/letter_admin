<?php
/**
 * Created by PhpStorm.
 * User: yunli
 * Date: 2019/4/29
 * Time: 下午2:01
 */

namespace App\Models;

class BannerModel extends BaseModel
{

    protected $rememberTokenName = '';

    protected $table = 'crm_banner';

    protected $fillable = [
        'name',
        'position',
        'status',
    ];

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    protected $dates = ['ctime'];

//    public function userRole(){
//        return $this->belongsTo(CrmAdminUserRoleModel::class,'id','user_id');
//    }




}