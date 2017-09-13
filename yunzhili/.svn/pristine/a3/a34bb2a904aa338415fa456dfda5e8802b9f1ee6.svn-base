<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
/**
 * 会员相关模块
 */
class Member extends Base
{
    /**
     * 会员首页
     * @return [type] [description]
     */
    public function index()
    {
        return $this->fetch('index',['openid'=>\request()->session('openid')]);
    }


    /**
     * 个人信息
     * @return [type] [description]
     */
    public function profile()
    {
        return $this->fetch('profile',['openid'=>\request()->session('openid')]);
    }

    /**
     * 协议
     * @return [type] [description]
     */
    public function aggreement()
    {
        return $this->fetch();
    }


    /**
     * 关于我们
     * @return [type] [description]
     */
    public function aboutus()
    {
        return $this->fetch();
    }

    /**
     * 获取个人信息
     */
    public function getMemeberInfo()
    {

    }

}