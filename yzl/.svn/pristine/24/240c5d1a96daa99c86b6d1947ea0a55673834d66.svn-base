<?php
namespace app\api\controller\wx;


use think\Request;

class Course extends Base
{


    protected $courseService;

    public function __construct()
    {
        parent::__construct();

        $this->courseService = \think\Loader::model('CourseService', 'service\wechat');
    }

    /**
     * 获取筛选课程列表
     */
    public function get_course_list()
    {
        $param = Request::instance()->param();
        $course_list = $this->courseService->get_course_list($param);

        if($course_list)
        {
            return result($course_list);
        } else {
            return result([],'500','调用失败');
        }

    }

    /**
     * 获取课程信息
     */
    public function get_course_info()
    {
        $param = Request::instance()->param('course_id');

        $course_info = $this->courseService->get_course_info($param);

        if($course_info)
        {
            return result($course_info[0]);
        } else {
            return result([],'500','调用失败');
        }

    }





}