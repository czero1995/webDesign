<?php
namespace app\api\controller\wx;


use think\Request;

class Stadium extends Base
{
    protected $stadiumService;

    public function __construct()
    {
        parent::__construct();

        $this->stadiumService = \think\Loader::model('StadiumService','service\wechat');

    }
    /**
     *获取推荐场馆列表
     */
    public function get_stadium_list()
    {
        $param = Request::instance()->param();
//        $param = [
//            'type'  =>  'tuijian',
//            'where' =>  [
//                'type'  =>  [],
//                'area'  =>  []
//            ],
//            'page_size'  =>  5,
//            'page'       =>  1
//        ];

        $stadium_list = $this->stadiumService->get_stadium_list($param);

        if($stadium_list)
        {
            return result($stadium_list);
        } else {
            return result([],'500','调用失败');
        }

    }

    /**
     * 获取场地详情
     */
    public function get_stadium_info()
    {
        $param = Request::instance()->param('stadium_id');
        $stadium_info = $this->stadiumService->get_stadium_info($param);

        if($stadium_info)
        {
            return result($stadium_info);
        } else {
            return result([],'500','调用失败');
        }

    }
}