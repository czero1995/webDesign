<?php
namespace app\api\controller\wx;

use think\Controller;
use think\Request;

class Index extends Base
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


    public function index()
    {
        echo 'hello, wx api';
    }


    /**
     * 获取课程类型
     */
    public function get_course_type()
    {
        $course_type = $this->courseService->get_course_type();

        if($course_type)
        {
            return result($course_type);

        } else {
            return result([],'500','调用失败');
        }
    }

    /**
     * 获取位置
     */
    public function get_area_type()
    {
        $area_type = $this->stadiumService->get_area_type();

        if($area_type)
        {
            return result($area_type);

        } else {
            return result([],'500','调用失败');
        }
    }

    /**
     * 获取从业经验
     */
    public function get_exper_type()
    {
        $exper_type = $this->coachService->get_exper_type();

        if($exper_type)
        {
            return result($exper_type);

        } else {
            return result([],'500','调用失败');
        }
    }

    /**
     *获取banner图
     */
    public function get_banner_list()
    {
        $type = input('type');
        $banner_list = $this->bannerService->get_banner_list($type);
        if($banner_list)
        {
            return result($banner_list);

        } else {
            return result([],'500','调用失败');
        }
    }



}
