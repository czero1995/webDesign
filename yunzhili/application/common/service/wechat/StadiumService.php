<?php
namespace app\common\service\wechat;

use think\Model;

class StadiumService extends Model
{
    protected $stadiumService;
    protected $stadiumCourse;
    protected $course;
    protected $stadiumCoach;
    protected $coach;
    protected $tags;
    protected $tagsConn;
    protected $stadium;

    public function __construct()
    {
        $this->stadiumService = \think\Loader::model('Stadium','model');
        $this->stadiumCourse = \think\Loader::model('StadiumCourse','model');
        $this->course = \think\Loader::model('Course','model');
        $this->stadiumCoach = \think\Loader::model('StadiumCoach','model');
        $this->coach = \think\Loader::model('Coach','model');
        $this->tags = \think\Loader::model('Tags','model');
        $this->tagsConn = \think\Loader::model('TagsConn','model');
    }

    public function get_stadium_list($param)
    {
        try {

            isset($param['type']) ? $param['type'] : $param['type'] = 'tuijian';

            switch ($param['type'])
            {
                //人气 => 排序
                case 'renqi':
                    $list = $this->stadiumService->get_stadium_sort($param);
                    break;

                //筛选
                case 'screen':
                    //按推荐筛选
                    $list = $this->stadiumService->get_stadium_screen($param);
                    break;

                //默认推荐
                default:
                    $list = $this->stadiumService->get_stadium_recommend($param);
                    break;

            }

            $res = $this->get_data($list['data']);

            return ['data'=>$res, 'page'=>$list['page']];
        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }
    }

    protected function get_data($data)
    {

        try {

            foreach ($data as $key => $val)
            {
                //获取课程
                $ids[$key] = $this->stadiumCourse->get_course_id($val['id']); //获取课程ID

                foreach ($ids[$key] as $key2 => $val2)
                {
                    $arr_courses[$key2] = $this->course->get_course_info($val2['course_id']); //课程名称
                    foreach ($arr_courses[$key2] as $k2 => $v2)
                    {
                        $course[$k2][$key2] = $v2;
                    }
                }

                $data[$key]['course_info'] = $course[0] ; //课程信息
                $data[$key]['count_course'] =   count($course[0]); //课程数
            }


            return $data;

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }


    }

    public function get_stadium_info($id)
    {
        $res = $this->stadiumService->get_stadium_info($id);

        try {

            $arr_coachs = $this->stadiumCoach->get_coach_id($id);
            if($arr_coachs)
            {
/*               foreach ($arr_coachs as $key => $val)
               {
                   $arr_coach[$key] = $this->coach->get_coach_info($val['coach_id']); //教练名称
                   foreach ($arr_coach[$key] as $k2 => $v2)
                   {
                       $coach[$k2][$key] = $v2;
                       $coach[$k2][$key]['tags_name'] = $this->get_tags($v2['id']); //追加标签
                       $coachs[$k2][$key]['address'] = $this->get_address($v2['id']); //追加地区
                       $coach[$k2][$key]['stadium'] = $coachs[$k2][$key]['address'][0];
                   }

               }*/
                foreach ($arr_coachs as $key => $val)
                {
                    $arr_coach[$key] = $this->coach->get_coach_info($val['coach_id']); //教练名称
                    foreach ($arr_coach[$key] as $k2 => $v2)
                    {
                        $coach[$k2][] = $v2;
                    }

                }

                foreach ($coach[0] as $k3 => $v3)
                {
                    $coach[0][$k3]['tags_name'] = $this->get_tags($v3['id']); //追加标签
                    $coachs[0][$k3]['address'] = $this->get_address($v3['id']); //追加地区
                    $coach[0][$k3]['stadium'] = $coachs[0][$k3]['address'][0];
                }
            }
            $res['count_coach'] = isset($coach) ? count($arr_coach) : 0;
            $res['coach_info'] = isset($coach) ? $coach[0] : null;


            $arr_courses = $this->stadiumCourse->get_course_id($id);
            if($arr_courses)
            {
                foreach ($arr_courses as $key => $val)
                {
                    $arr_course[$key] = $this->course->get_course_info($val['course_id']); //课程名称
                    foreach ($arr_course[$key] as $k2 => $v2)
                    {
                        $course[$k2][$key] = $v2;
                    }
                }

            }
            $res['count_course'] = isset($course) ? count($arr_course) : 0;
            $res['course_info'] = isset($course) ? $course[0] : null;

            return $res;

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }


    }

    protected function get_tags($id)
    {
        try {

            //获取标签
            $ids = $this->tagsConn->get_tagsId($id); //获取标签ID

            foreach ($ids as $key => $val)
            {
                $arr_tags[$key] = $this->tags->get_tags_name($val['tags_id']); //标签名称
                foreach ($arr_tags[$key] as $k2 => $v2)
                {
                    $tags[$k2][$key] = $v2;
                }
            }

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }

        return $tags[0];

    }

    protected function get_address($id)
    {
        try {
            //获取场馆
            $arr_id = $this->stadiumCoach->get_stadium_id($id); //获取场馆ID

            foreach ($arr_id as $key => $val)
            {
                $arr_stadium[$key] = $this->stadiumService->get_stadium_name($val['stadium_id']); //场馆名称
                foreach ($arr_stadium[$key] as $k2 => $v2)
                {
                    $stadium[$k2][$key] = $v2;
                }
            }

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }

        return $stadium[0];

    }

    /**
     *
     */
    public function get_area_type()
    {
        return $this->stadiumService->get_area_type();
    }


}