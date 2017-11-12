<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Base extends Controller
{
    protected $weObj;

    public function _initialize()
    {
        import('wechat.wechat', EXTEND_PATH, '.class.php');

        $options = array(
            'token'=>config('wechat.token'), //填写你设定的key
            'encodingaeskey'=>config('wechat.encodingaeskey'), //填写加密用的EncodingAESKey
            'appid'=> config('wechat.app_id'), //填写高级调用功能的app id
            'appsecret'=> config('wechat.app_secret') //填写高级调用功能的密钥
        );

        $this->weObj = new \Wechat($options);

        if(!session('?'.'userinfo')){
            $request = Request::instance();
            $url = url('Auth/index?redirect='. urlencode($request->url(true)), '', true, true);
            $this->redirect($url);
        }

        $member = session('userinfo');

        $this->assign('openid', $member['openid']);
    }


}