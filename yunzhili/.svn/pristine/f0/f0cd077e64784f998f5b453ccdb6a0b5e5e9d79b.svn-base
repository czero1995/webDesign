<?php
namespace app\common\service\wechat;
use think\Model;

class SMSService extends Model
{

    /**
     * 发送短信通知
     * @param  [type] $mobile     [description]
     * @param  [type] $templateId [description]
     * @param  [type] $p1         [description]
     * @param  [type] $p2         [description]
     * @param  [type] $p3         [description]
     * @return [type]             [description]
     */
    protected function sendSMS($mobile, $templateId, $p1, $p2, $p3)
    {
        import('rongcloud.rongcloud', EXTEND_PATH, '.php');
        $appKey = config('rongcloud.app_key');
        $appSecret = config('rongcloud.app_secret');
        $RongCloud = new \RongCloud($appKey,$appSecret);
        $region = '86';
        $result = $RongCloud->SMS()->sendNotify($mobile, $templateId, $region, $p1, $p2, $p3);
        return $result;
    }


    /**
     * 发送新增水票短信通知
     * @param  [type] $mobile       [接收人手机号码]
     * @param  [type] $ticket_count [水票数量，例如：10]
     * @param  [type] $ticket_name  [水票名称，例如：大地山泉]
     * @param  [type] $service_tel  [客服热线：例如：0733-24228192]
     * @return [type]               [description]
     */
    public function sendAddTicketSMS($mobile, $ticket_count, $ticket_name, $service_tel)
    {
        $templateId = config('rongcloud.add_ticket_templateId');
        $result = $this->sendSMS($mobile, $templateId, $ticket_count, $ticket_name, $service_tel);
        return $result;
    }


    /**
     * 发送减少水票短信通知
     * @param  [type] $mobile       [接收人手机号码]
     * @param  [type] $ticket_count [水票数量，例如：10]
     * @param  [type] $ticket_name  [水票名称，例如：大地山泉]
     * @param  [type] $service_tel  [客服热线：例如：0733-24228192]
     * @return [type]               [description]
     */
    public function sendSubTicketSMS($mobile, $ticket_count, $ticket_name, $service_tel)
    {
        $templateId = config('rongcloud.sub_ticket_templateId');
        $result = $this->sendSMS($mobile, $templateId, $ticket_count, $ticket_name, $service_tel);
        return $result;
    }


    /**
     * 像指定的手机号发送6位数字的短信验证码
     * @param  [type] $mobile [description]
     * @return [type]         [description]
     */
    public function sendSMSCode($mobile)
    {
        $templateId = config('rongcloud.common_sms_code_templateId');
        import('rongcloud.rongcloud', EXTEND_PATH, '.php');
        $appKey = config('rongcloud.app_key');
        $appSecret = config('rongcloud.app_secret');
        $RongCloud = new \RongCloud($appKey,$appSecret);
        $region = '86';
        $result = $RongCloud->SMS()->sendCode($mobile, $templateId, $region);
        return $result;
    }


    /**
     * 验证短信验证码是否正确
     * @param  [type] $sessionId [description]
     * @param  [type] $code      [description]
     * @return [type]            [description]
     */
    public function verifyCode($sessionId, $code)
    {
        import('rongcloud.rongcloud', EXTEND_PATH, '.php');
        $appKey = config('rongcloud.app_key');
        $appSecret = config('rongcloud.app_secret');
        $RongCloud = new \RongCloud($appKey,$appSecret);
        $result = $RongCloud->SMS()->verifyCode($sessionId, $code);
        return $result;
    }


}



?>