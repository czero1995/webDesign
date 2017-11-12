<?php
namespace app\common\service\wechat;

use think\Model;

class MemberService extends Model
{
    protected $memberService;

    public function __construct()
    {
        $this->memberService = \think\Loader::model('Member','model');
    }

    /**
     * 获取用户信息
     */
    public function get_user_info($openid)
    {
        return $this->memberService->get_user_info($openid);
    }

    /**
     *会员注册
     */
    public function register($data)
    {
        return $this->memberService->register($data);
    }
    /**
     * 完善个人信息
     */
    public function perfectInfo($params)
    {
        return $this->memberService->perfectInfo($params);
    }

    /**
     * 修改手机号码
     */
    public function editMobile($mobile)
    {
        return $this->memberService->editMobile($mobile);
    }

    /**
     * 修改姓名
     */
    public function editRealname($realname)
    {
        return $this->memberService->editMobile($realname);
    }

    /**
     * 修改其他信息
     */
    public function editOthers($params)
    {
        return $this->memberService->editOthers($params);
    }

    /**
     * 不再提醒注册
     */
    public function remind()
    {
        return $this->memberService->remind();
    }
}