<?php
namespace app\common\service\wechat;

use think\Model;

class CourseService extends Model
{
    protected $courseService;
    protected $course;
    protected $coachCourse;
    protected $coachService;
    protected $CoachCategory;
    protected $courseCategory;
    protected $stadiumCourse;
    protected $stadiumService;

    public function __construct()
    {
        $this->courseService = \think\Loader::model('Course', 'model');
        $this->course = \think\Loader::model('Course','model');
        $this->coachService = \think\Loader::model('Coach','model');
        $this->coachCourse = \think\Loader::model('CoachCourse','model');
        $this->courseCategory = \think\Loader::model('CourseCategory','model');
        $this->CoachCategory = \think\Loader::model('CoachCategory','model');
        $this->stadiumCourse = \think\Loader::model('StadiumCourse', 'model');
        $this->stadiumService = \think\Loader::model('Stadium', 'model');
    }

    public function get_course_list($param)
    {
        try {

            isset($param['type']) ? $param['type'] : $param['type'] = 'tuijian';

            switch ($param['type'])
            {
                //人气 => 排序
                case 'renqi':
                    $list = $this->courseService->get_course_sort($param);
                    break;

                //筛选
                case 'screen':
                    //按推荐筛选
                    $list = $this->courseService->get_course_screen($param);
                    break;

                //默认推荐
                default:
                    $list = $this->courseService->get_course_list($param);
                    break;

            }

            return $list;

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }
    }

    public function get_course_info($id)
    {
        $res = $this->courseService->get_course_info($id);

        try {

            $arr_coachs = $this->coachCourse->get_coach_id($id);
            if($arr_coachs)
            {
                foreach ($arr_coachs as $key => $val)
                {
                    $arr_coach[$key] = $this->coachService->get_coach_info($val['coach_id']); //教练名称
                    foreach ($arr_coach[$key] as $k2 => $v2)
                    {
                        $coach[$k2][] = $v2;
                    }
                }

            }
            $res[0]['coach_info'] = empty($coach[0]) ? null : $coach[0];

            $arr_stadiums = $this->stadiumCourse->get_stadium_id($id);
            if($arr_stadiums)
            {
                $stadium = $this->stadiumService->get_stadium_one($arr_stadiums[0]['stadium_id']);

            }
            $res[0]['stadium_info'] = empty($stadium) ? null : $stadium;



        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }

        return $res;
    }

    /**
     * 获取课程类型
     */
    public function get_course_type()
    {
        return $this->courseCategory->get_course_type();
    }

}