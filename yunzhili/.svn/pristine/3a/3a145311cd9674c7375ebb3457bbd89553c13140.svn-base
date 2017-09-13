<?php
namespace app\common\service\wechat;

use think\Db;
use think\Model;

class CoachService extends Model
{
    protected $coachService;
    protected $coachCateConn;
    protected $coachCategory;
    protected $tags;
    protected $tagsConn;
    protected $stadium;
    protected $stadiumCoach;
    protected $course;
    protected $coachCourse;
    protected $courseCategory;

    public function __construct()
    {
        $this->coachService = \think\Loader::model('Coach','model');
        $this->coachCateConn = \think\Loader::model('CoachCateConn','model');
        $this->coachCategory = \think\Loader::model('CoachCategory','model');
        $this->tags = \think\Loader::model('Tags','model');
        $this->tagsConn = \think\Loader::model('TagsConn','model');
        $this->stadium = \think\Loader::model('Stadium','model');
        $this->stadiumCoach = \think\Loader::model('StadiumCoach','model');
        $this->course = \think\Loader::model('Course','model');
        $this->coachCourse = \think\Loader::model('CoachCourse','model');
        $this->courseCategory = \think\Loader::model('CourseCategory','model');

    }

    //获取教练列表
    public function get_coach_list($param)
    {

        try {

            isset($param['type']) ? $param['type'] : $param['type'] = 'tuijian';

            switch ($param['type'])
            {
                //人气 => 排序
                case 'renqi':
                    $list = $this->coachService->get_coach_sort($param);
                    break;

                //筛选
                case 'screen':
                    //按推荐筛选
                    $list = $this->coachService->get_coach_screen($param);
                    break;

                //默认推荐
                default:
                    $list = $this->coachService->get_coach_recommend($param);
                    break;

            }

//            if($param['type'] == 'screen')
//            {
//                return $list;
//
//            } else {
//
//                return $this->get_data($list);
//
//            }

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
                //获取标签
                $ids[$key] = $this->tagsConn->get_tagsId($val['id']); //获取标签ID

                foreach ($ids[$key] as $key2 => $val2)
                {
                    $arr_tags[$key2] = $this->tags->get_tags_name($val2['tags_id']); //标签名称
                    foreach ($arr_tags[$key2] as $k2 => $v2)
                    {
                        $tags[$k2][$key2] = $v2;
                    }
                }
                $data[$key]['tags_name'] = $tags[0];

                //获取场馆
                $arr_id[$key] = $this->stadiumCoach->get_stadium_id($val['id']); //获取场馆ID

                foreach ($arr_id[$key] as $key2 => $val2)
                {
                    $arr_stadium[$key2] = $this->stadium->get_stadium_name($val2['stadium_id']); //场馆名称
                    foreach ($arr_stadium[$key2] as $k2 => $v2)
                    {
                        $stadium[$k2][$key2] = $v2;
                    }
                }

                $data[$key]['stadium_info'] = $stadium[0][0]; //只要一条场馆信息
            }

            return $data;

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }


    }

    //教练详情
    public function get_coach_info($id)
    {
        $res = $this->coachService->get_coach_info($id);


        try {
            $res[0]['type'] = Db::name('coach_cate_conn')->alias('a')
                ->join('coach_category b','a.cate_id = b.id')
                ->where('a.coach_id',$id)
                ->field('b.id,b.title')
                ->find();

            $arr_tags = $this->tagsConn->get_tagsId($id);
            foreach ($arr_tags as $key => $val )
            {
                $arr_tags[$key] = $this->tags->get_tags_name($val['tags_id']); //标签名称
                foreach ($arr_tags[$key] as $k2 => $v2)
                {
                    $tags[$k2][$key] = $v2;
                }
            }
            $res[0]['tags_name'] = empty($tags[0]) ? null : $tags[0];


            $arr_stadiums = $this->stadiumCoach->get_stadium_id($id);
            foreach ($arr_stadiums as $key => $val)
            {
                $arr_stadium[$key] = $this->stadium->get_stadium_name($val['stadium_id']); //场馆名称
                if($arr_stadium)
                {
                    foreach ($arr_stadium[$key] as $k2 => $v2)
                    {
                        $stadium[$k2][$key] = $v2;
                    }
                } else {
                    $stadium[0] = null;
                }

            }
            $res[0]['stadium_info'] = $stadium[0];
            $res[0]['count_stadium'] = empty($stadium[0]) ? 0 : count($stadium[0]);


            $arr_courses = $this->coachCourse->get_courseId($id);

            foreach ($arr_courses as $key => $val)
            {
                $arr_course[$key] = $this->course->get_course_info($val['course_id']); //课程名称

                if($arr_course)
                {
                    foreach ($arr_course[$key] as $k2 => $v2)
                    {
                        $course[$k2][$key] = $v2;
                    }
                } else {
                    $course[0] = null;
                }

            }
            $res[0]['course_info'] = $course[0];
            $res[0]['count_course'] = empty($course[0]) ? 0 : count($course);



            return $res[0];

        } catch (\Exception $e) {

            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));

        }
    }

    //获取从业经验
    public function get_exper_type()
    {
        return $this->tags->get_exper_type();
    }


}