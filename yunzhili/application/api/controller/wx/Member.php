<?php
namespace app\api\controller\wx;

use think\Controller;
use think\Db;
use app\common\service\wechat\SMSService;
use think\Exception;
use think\Request;
use think\Session;

class Member extends Base
{
    protected $MemberService;

    public function __construct()
    {
        parent::__construct();

        $this->MemberService = \think\Loader::model('MemberService', 'service\wechat');
    }

    /**
     * @return $userinfo
     */
    public function get_user_info(Request $request)
    {

        $openid = $request->param('openid');
        Session::set('openid',$openid);
        //$openid = 'olfJ6xNXY--9QaW7QJhxpZJyBVlY';
        $info = $this->MemberService->get_user_info($openid);

        $info['nickname'] = base64_decode($info['nickname']);
        return $info;
    }

    /**
     * 发送验证码
     */
    public function sendSMSCode()
    {
        $mobile = Request::instance()->param('mobile');
        //判断是否已是会员
//        $openid = 'olfJ6xNXY--9QaW7QJhxpZJyBVlY';
//        $userinfo = $this->MemberService->get_user_info($openid);
//
//        if($userinfo['member'])
//        {
//            show_json(500, '您已经是会员，无需再次注册！');
//        }

        $sms = new SMSService();
        $res = $sms->sendSMSCode($mobile);
        $res = json_decode($res, true);
        if($res['code'] == 200){
            Db::name("sms")->insert(
                array(
                        'member_id'=>'1111111',
                        'mobile'=>$mobile,
                        'session_id'=>$res['sessionId'],
                        'status'=>1,
                        'code'=>$res['code'],
                        'create_time'=>date('Y-m-d H:i:s'),
                        'expire_time'=>date('Y-m-d H:i:s',(time()+900))
                     )
            );
            show_json(200, '获取成功');
        }else{
            show_json(500, '获取失败，请稍后再试。');
        }
    }
    /**
     * 注册会员
     * @param mobile
     * @return code
     */
    public function register()
    {
//        if(request()->isPost()){
//
//
//        }

        try {
            $data = Request::instance()->param();
            $mobile = $data['mobile'];
            $sessionId = Db::name("sms")->where('mobile', $mobile)->order('id desc')->value('session_id');
            $smsCode = (int)trim($data['sms_code']);

            $sms = new SMSService();
            $res = $sms->verifyCode($sessionId, $smsCode);
            $res = json_decode($res, true);

            if($res['code'] == 200 && $res['success']){

                $res = $this->MemberService->register($data);

                if($res < 0){
                    exit(json_encode(array('status'=>false,'msg'=>'注册失败')));
                }

            }else{
                exit(json_encode(array('status'=>false,'msg'=>'验证码错误')));
            }

            exit(json_encode(array('status'=>true,'member_num'=>$res)));
        } catch (\Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>'注册失败')));
        }

    }

    /**
     * 完善个人信息
     * @return array
     */
    public function perfectInfo()
    {
        try {

            $params = request()->param();

            if(isset($params['sms_code']))
            {

                $mobile = $params['mobile'];
                $sessionId = Db::name("sms")->where('mobile', $mobile)->order('id desc')->value('session_id');
                $smsCode = (int)trim($params['sms_code']);

                $sms = new SMSService();
                $res = $sms->verifyCode($sessionId, $smsCode);
                $res = json_decode($res, true);

                if($res['code'] == 200 && $res['success']){

                    return result(true,200,'验证成功');

                } else {

                    return result(false,500,'验证码错误');

                }

            } else {

                $res = $this->MemberService->perfectInfo($params);

                if($res)
                {
                    return result(true,200,'提交成功');
                } else {
                    return result(false,500,'提交失败');
                }

            }




        } catch (\Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }

    }

    /**
     * 不再提醒
     */
    public function remind()
    {
        try {
            $res = $this->MemberService->remind();
            if($res)
            {
                return result($res);
            } else {
                return result(false,500,'调用失败');
            }

        } catch (\Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }

    /**
     * 修改手机号码
     */
    public function editMobile()
    {
        try {

            $data = Request::instance()->param();
            $mobile = $data['mobile'];
            $sessionId = Db::name("sms")->where('mobile', $mobile)->order('id desc')->value('session_id');
            $smsCode = (int)trim($data['sms_code']);

            $sms = new SMSService();
            $res = $sms->verifyCode($sessionId, $smsCode);
            $res = json_decode($res, true);

            if($res['code'] == 200 && $res['success']){

                $insertLastId = $this->MemberService->editMobile($mobile);

                if(!$insertLastId){
                    exception("修改失败");
                }

            }else{
                exception("验证码错误");
            }

        } catch (\Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }


    /**
     * 修改姓名
     */
    public function editRealname()
    {
        try {

            $data = Request::instance()->param();
            $mobile = $data['mobile'];
            $sessionId = Db::name("sms")->where('mobile', $mobile)->order('id desc')->value('session_id');
            $smsCode = (int)trim($data['sms_code']);

            $sms = new SMSService();
            $res = $sms->verifyCode($sessionId, $smsCode);
            $res = json_decode($res, true);

            if($res['code'] == 200 && $res['success']){

                $res = $this->MemberService->editRealname($data['realname']);

                if(!$res){
                    exception("注册失败");
                }

            }else{
                exception("验证码错误");
            }

        } catch (\Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }

    /**
     * 修改其他信息
     */
    public function editOthers()
    {
        try {

            $data = Request::instance()->param();
            $res = $this->MemberService->editOthers($data);

            if($res)
            {
                return result(true,200,'修改成功');
            }

        } catch (\Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }
}