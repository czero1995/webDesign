<?php 
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;


class Auth extends Controller{


	protected $weObj;

    protected $MemberService;


	public function __construct()
    {
        import('wechat.wechat', EXTEND_PATH, '.class.php');

        $this->MemberService = \think\Loader::model('MemberService','service\wechat');

        $options = array(
                    'token'=>config('wechat.token'), //填写你设定的key
                    'encodingaeskey'=>config('wechat.encodingaeskey'), //填写加密用的EncodingAESKey
                    'appid'=> config('wechat.app_id'), //填写高级调用功能的app id
                    'appsecret'=> config('wechat.app_secret') //填写高级调用功能的密钥
                );
        $this->weObj = new \Wechat($options);
    }


    public function index()
    {
        $redirect = input('param.redirect');
    	$redirect_uri = url('dologin?redirect='. urlencode($redirect), '', true, true);
        $url = $this->weObj->getOauthRedirect($redirect_uri);
        //dump($redirect_uri);
        $this->redirect($url);
    	//header('Location:'.$url);
    }


    public function dologin()
    {	
        $redirect = input('param.redirect');
        if(empty($redirect)){
            $redirect = url('index/index');
        }
    	$oauthData = $this->weObj->getOauthAccessToken();
        if(isset($oauthData)){
            $userInfo = $this->weObj->getOauthUserinfo($oauthData['access_token'], $oauthData['openid']);
            //$userInfo = $this->weObj->getUserInfo($oauthData['openid']);
            if(isset($userInfo)){
                $data = [
                    'openid'        =>     $userInfo['openid'],
                    'nickname'      =>     base64_encode($userInfo['nickname']),
                    'sex'           =>     $userInfo['sex'],
                    'headimg'       =>     $userInfo['headimgurl'],
                    'create_time'   =>     date("Y-m-d H:i:s")
                ];
                $meb = $this->MemberService->get_user_info($userInfo['openid']);

                if($meb)
                {
                    Session::set('userinfo',$userInfo);
                    Session::set('openid',$userInfo['openid']);
                    //用户信息存在，则更新用户信息
                    unset($data['create_time']);
                    $data['update_time'] = date("Y-m-d H:i:s");

                    Db::name("member")->where('openid',$userInfo['openid'])->update($data);
                } else {
                    //用户信息不存在，则新增用户信息
                    Db::name('member')->insertGetId($data);
                }
                $this->redirect($redirect);
            }else{
                $this->error("获取用户信息出错了");                
            }
        }else{
            $this->error("网页授权出错了");
        }
    }


}



 ?>