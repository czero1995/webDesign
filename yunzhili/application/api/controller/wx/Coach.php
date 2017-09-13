<?php
namespace app\api\controller\wx;

use think\Request;

class Coach extends Base
{

    protected $coachService;
    protected $courseService;
    protected $memberService;
    protected $stadiumService;
    protected $bannerService;

    public function __construct()
    {
        parent::__construct();

        $this->coachService = \think\Loader::model('CoachService','service\wechat');
        $this->courseService = \think\Loader::model('CourseService','service\wechat');
        $this->memberService = \think\Loader::model('MemberService','service\wechat');
        $this->stadiumService = \think\Loader::model('StadiumService','service\wechat');
        $this->bannerService = \think\Loader::model('BannerService','service\admin');

    }


    /**
     * 获取教练列表
     */
    public function get_coach_list()
    {
        $param = Request::instance()->param();

        $coach_list = $this->coachService->get_coach_list($param);

        if($coach_list)
        {
            return result($coach_list);
        } else {
            return result($coach_list,'500','调用失败');
        }

    }

    /**
     * 获取教练信息
     */
    public function get_coach_info()
    {
        $param = request()->param('coach_id');
        $coach_info = $this->coachService->get_coach_info($param);

        if($coach_info)
        {
            return result($coach_info);
        } else {
            return result([],'500','调用失败');
        }

    }


}