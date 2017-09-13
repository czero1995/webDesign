<?php
namespace app\api\controller;

class Wechat  extends Base
{
    public function index()
    {
        $rawData = file_get_contents('php://input');  //获取原始数据
        // 保存微信服务器推送过来的原始数据
        $message = [
            "request" => $rawData,
            "create_time" => date("Y-m-d H:i:s"),
            "update_time" => date("Y-m-d H:i:s")
        ];
        // db("mp_message")->insert($message);

        //需要判断请求类型，微信配置接口更改请求类型为get
        if(request()->isGet()){
            $this->weObj->valid();
        }else if(request()->isPost()){
            // 需要判断请求类型，微信消息推送接口请求类型为post
            $type = $this->weObj->getRev()->getRevType();
            // Db::name("log")->insert(array('content'=>$type, 'cereate_time'=>date("Y-m-d H:i:s")));
            switch($type) {
                case \Wechat::MSGTYPE_TEXT:
                    $this->weObj->text("hello, I'm wechat")->reply();
                    break;
                case \Wechat::MSGTYPE_EVENT:
                    $event = $this->weObj->getRev()->getRevEvent();
                    switch($event['event']){
                        // 未关注的用户关注事件
                        case \Wechat::EVENT_SUBSCRIBE:
                            if(isset($event['key'])){
                                //未关注用户扫描带参数二维码事件
                                $this->weObj->text("亲，你可是扫了二维码进来的啊！".$this->weObj->getRev()->getRevSceneId())->reply();
                            }else{
                                // 未关注用户关注公众号事件
                                $this->weObj->text("亲，终于等到你了！")->reply();
                            }
                            break;
                        // 已关注的用户取消关注事件
                        case \Wechat::EVENT_UNSUBSCRIBE:
                            $this->weObj->text("亲，求你别走！")->reply();
                            break;
                        // 已关注的用户扫描带参数二维码
                        case \Wechat::EVENT_SCAN:
                            $this->weObj->text("亲，你咋又扫了二维码了".$this->weObj->getRev()->getRevSceneId())->reply();
                            break;
                        // 上报地理位置事件
                        case \Wechat::EVENT_LOCATION:
                            $eventGeo = $this->weObj->getRev()->getRevEventGeo();
                            $this->weObj->text("亲，我知道你的位置了哦"."latitude = ". $eventGeo['x']. " longitude = ". $eventGeo['y']. " precision = ". $eventGeo['precision'])->reply();
                            break;
                        // 自定义菜单点击事件
                        case \Wechat::EVENT_MENU_CLICK:
                            $this->weObj->text("亲，你点击了自定义菜单".$event['key'])->reply();
                            break;
                        // 自定义菜单页面跳转事件
                        case \Wechat::EVENT_MENU_VIEW:
                            $this->weObj->text("亲，你点击了自定义菜单页面跳转".$event['key'])->reply();
                            break;
                        // 模板消息发送结果通知事件
                        case \Wechat::EVENT_SEND_TEMPLATE:
                            $this->weObj->text("模板消息发送结果".$this->weObj->getRev()->getRevStatus())->reply();
                            break;
                        // 群发消息结果推送事件
                        case \Wechat::EVENT_SEND_MASS:
                            $this->weObj->text("群发消息结果")->reply();
                            break;
                        default:
                            $this->weObj->text("接收到事件消息")->reply();
                    }
                    break;
                case \Wechat::MSGTYPE_IMAGE:
                    $this->weObj->image("回复一张图片消息")->reply();
                    break;
                case \Wechat::MSGTYPE_VOICE:
                    $this->weObj->voice("回复一条语音消息")->reply();
                    break;
                case \Wechat::MSGTYPE_VIDEO:
                    $this->weObj->video("回复一条视频消息", "视频标题", "视频描述")->reply();
                    break;
                case \Wechat::MSGTYPE_SHORTVIDEO:
                    $this->weObj->video("回复一条小视频消息", "视频标题", "视频描述")->reply();
                    break;
                case \Wechat::MSGTYPE_LOCATION:
                    $this->weObj->text("接收到一条地理位置信息")->reply();
                    break;
                case \Wechat::MSGTYPE_LINK:
                    $this->weObj->text("接收到一条连接消息")->reply();
                    break;
                default:
                    $this->weObj->text("help info")->reply();
            }
        }

    }

    /**
     * 微信支付申请预付单 prepay_id
     */
    public function getBusinessmenWxPayConf($mebid, $odid)
    {
        $order = $this->orderModel->getByOdid($mebid, $odid);
        $member = $this->memberModel->findById($mebid);
        if(isset($order) && isset($member)){
            //如果处于生产环境支付结果通知地址可能会变动，请检查去微信支付后台设置允许地址
            //获取perpay_id
            $odid = $odid;
            $time = time();
            $sign = paySign($odid, $time);
            $attach = $odid . '&'.$time . '&' . $sign;
            $body = '美足圈科技有限公司订单支付';
            $notify_url = url('index/notify/wxpay', '', true, true);
            $openid = $member['openid'];
            $total = $order['amount'] * 100; // 微信支付的单位为分，这里需要 * 100

            $payConf = $this->getWxPayConf($attach, $body, $notify_url, $openid, $total);

            return $payConf;
        }else{
            return null;
        }
    }

    public function getWxPayConf($attach, $body, $notify_url, $openid, $total)
    {
        $time = time();
        $data = array(
            'appid' => config('wechat.app_id'),  //微信ID
            'attach' => $attach,  //附加信息
            'body' => $body,   //支付标题
            'mch_id' => config('wechat.partner_id'),
            //'detail' => '<![CDATA[{ "goods_detail":[ { "goods_id":"iphone6s_16G", "wxpay_goods_id":"1001", "goods_name":"iPhone6s 16G", "quantity":1, "price":528800, "goods_category":"123456", "body":"苹果手机" }, { "goods_id":"iphone6s_32G", "wxpay_goods_id":"1002", "goods_name":"iPhone6s 32G", "quantity":1, "price":608800, "goods_category":"123789", "body":"苹果手机" } ] }]]>',      //商品详情
            'out_trade_no' => $time,   //商户订单号
            'nonce_str' => md5($time),
            'notify_url' => $notify_url,  //支付结果通知页面
            'openid' => $openid,  //微信OPenid
            'fee_type' => 'CNY',  //交易货币类型
            'total_fee' => $total,    //金额
            'spbill_create_ip' => '127.0.0.1',   //客户端IP
            'time_start' => date('YmdHis', $time),   //交易开始时间
            'goods_tag' => '',
            'time_expire' => date('YmdHis', $time + 3600),  //交易结束时间
            'trade_type' => 'JSAPI',    //调用方式
            'product_id' => '',   //商品ID
        );
        ksort($data);
        $data['sign'] = wxSign($data);
        $xml = array2xml($data);
        $res = post('https://api.mch.weixin.qq.com/pay/unifiedorder', $xml);
        $res = XML2Array($res);

        //H5支付调用
        $time = time();
        $payConf = array(
            'appId' => config('wechat.app_id'),
            'timeStamp' => "$time",
            'nonceStr' => md5(mt_srand()),
            'package' => 'prepay_id='.$res['prepay_id'],
            'signType' => 'MD5',
        );
        //生成paySign
        $payConf['paySign'] = wxSign($payConf);
        return $payConf;
    }

}
