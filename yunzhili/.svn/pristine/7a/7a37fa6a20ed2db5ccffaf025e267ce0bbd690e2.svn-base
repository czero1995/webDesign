<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
/**
 * 首页模块
 */
class Index extends Base
{
    protected $MemberService;

    public function __construct()
    {
        parent::__construct();

        $this->MemberService = \think\Loader::model('MemberService','service\wechat');

    }

    public function index()
    {
        $redirect_uri = url('dologin', '', true, true);
        $url = $this->weObj->getOauthRedirect($redirect_uri);
        $this->redirect($url);
    }

    public function dologin()
    {
        $oauthData = $this->weObj->getOauthAccessToken(); //通过code获取Access Token
        if(!empty($oauthData))
        {
            $userInfo = $this->weObj->getOauthUserinfo($oauthData['access_token'], $oauthData['openid']);
            if(!empty($userInfo))
            {
                $data = [
                    'openid'        =>     $userInfo['openid'],
                    'nickname'      =>     base64_encode($userInfo['nickname']),
                    'sex'           =>     $userInfo['sex'],
                    'member_num'    =>     0,
                    'headimg'       =>     $userInfo['headimgurl'],
                    'create_time'   =>     date("Y-m-d H:i:s")
                ];
                $meb = $this->MemberService->get_user_info($userInfo['openid']);
                $member_id = 0;

                if($meb)
                {
                    Session::set('openid',$userInfo['openid']);
                    //用户信息存在，则更新用户信息
                    unset($data['create_time']);
                    $data['update_time'] = date("Y-m-d H:i:s");

                    Db::name("member")->where('openid',$userInfo['openid'])->update($data);
                    $member_id = $meb['id'];
                } else {
                    //用户信息不存在，则新增用户信息
                    $member_id = Db::name('member')->insertGetId($data);
                }

                if(!$member_id){
                    // 验证出错
                    $this->error('验证用户信息有问题');
                }

                $this->redirect(url('course/index'));
                //$this->redirect('/index/course/index');


            } else {
                $this->error('获取用户信息出错！');
            }
        }
    }


}
