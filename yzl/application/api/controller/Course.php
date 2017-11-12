<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use think\Db;

class Course extends Base
{
    protected $courseService;
    protected $courseCateService;
    protected $lack = [];

    public function __construct()
    {
        parent::__construct();
        $this->courseService = \think\Loader::model('CourseService', 'service\admin');
        $this->courseCateService = \think\Loader::model('CourseCategoryService', 'service\admin');
    }

    /**
     * 获取课程列表
     */

    public function getCourseList()
    {

        $params = array_filter(input('request.'));
        $params['page'] = isset($params['page']) ? $params['page'] : 0;
        $params['page_size'] = $page_size = isset($params['page_size']) ? $params['page_size'] : 10;
        $data = $this->courseService->getCourseList($params);
        $list = $data['data'];

        $count = $data['count'];
        $show = $this->pageAndSize($count, $page_size); // 分页显示输出
        $data = $this->courseService->getCourseList();
        $result = [
            'data' => $data,
            'page' => $show
        ];
        if ($result) {
            return $result;
        }
        return result($result, 500, '调用失败');
    }

    /**
     * 获取课程信息
     */
    public function get_course_info($id)
    {

        $course_info = $this->courseService->get_course_info($id);
        if ($course_info) {
            return $course_info;
        } else {
            return result([], '500', '调用失败');
        }
    }


    /**
     * 获取课程类型
     */
    public function getCourseCateList()
    {
        $courseCate = $this->courseService->getCourseCateList();
        if ($courseCate) {

            return result($courseCate, 200, '调用成功');
        } else {
            return result($courseCate, 500, '调用失败');
        }
    }

    /**
     * 新增课程
     */
    public function addCourse()
    {
        //$data = input('param.');
        $post = input('param.post');
        $spost = input('param.spost');
        $title = input('param.title');
        $cate_id = input('param.cate_id');
        $sub_title = input('param.sub_title');
        $intro = input('param.intro');
        $price = input('param.price');
        $sort = input('param.sort');
        $is_recommend = input('param.is_recommend');

        if (empty($post)) {
            $this->lack[] = 'post';
        }
        if (empty($spost)) {
            $this->lack[] = 'spost';
        }
        if (empty($cate_id)) {
            $this->lack[] = 'cate_id';
        }
        if (empty($sub_title)) {
            $this->lack[] = 'sub_title';
        }
        if (empty($intro)) {
            $this->lack[] = 'intro';
        }
        if (empty($price)) {
            $this->lack[] = 'price';
        }
        if (empty($sort)) {
            $this->lack[] = 'sort';
        }
        if (empty($is_recommend)) {
            $this->lack[] = 'is_recommend';
        }
        if (empty($title)) {
            $this->lack[] = 'title';
        }
        if (sizeof($this->lack) > 0) {
            return result(false, 4007, '信息不完整');
        } else {
            $data = [
                'post'         => $post,
                'spost'        => $spost,
                'cate_id'      => $cate_id,
                'title'        => $title,
                'sub_title'    => $sub_title,
                'intro'        => $intro,
                'price'        => $price,
                'sort'         => $sort,
                'is_recommend' => $is_recommend,
                'create_time'  => date('Y-m-d H:i:s')
            ];
            $res = $this->courseService->addCourse($data);
            if ($res) {
                return result($res);
            } else {
                return result($res, 500, '调用失败');
            }
        }

    }

    /**
     * 修改课程
     */
    public function editCourse()
    {
        $data = input('param.');

        $res = $this->courseService->editCourse($data);
        if ($res) {
            return result($res);
        } else {
            return result($res, 500, '调用失败');
        }

    }

    /**
     * 删除课程
     */
    public function delCourse()
    {
        $course_id = input('param.id');

        $res = $this->courseService->delCourse($course_id);
        if ($res) {
            return result($res);
        } else {
            return result($res, 500, '调用失败');
        }

    }

}

?>