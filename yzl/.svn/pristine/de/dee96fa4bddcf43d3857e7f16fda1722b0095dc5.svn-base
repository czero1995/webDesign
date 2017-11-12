<?php
namespace app\api\controller\wx;

use think\Controller;

class Base extends Controller
{
    protected $weObj;

    public function _initialize()
    {
//         import('wechat.wechat', EXTEND_PATH, '.class.php');
//
//         $options = array(
//             'token'=>config('wechat.token'), //填写你设定的key
//             'encodingaeskey'=>config('wechat.encodingaeskey'), //填写加密用的EncodingAESKey
//             'appid'=> config('wechat.app_id'), //填写高级调用功能的app id
//             'appsecret'=> config('wechat.app_secret') //填写高级调用功能的密钥
//         );
//
//         $this->weObj = new \Wechat($options);

        //配置跨域
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Token,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since");
        header('Access-Control-Allow-Methods: GET, POST, PUT');

    }

}