<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Coursetype extends Base{
	
   	/**
   	 * 课程类型列表
   	 */
   	public function index(){
   		 
        return $this->fetch();
   	} 

    public function get_list(){
      $res = Db::name('course_category')->select();
      return $res;
    }

    public function add(){
        $params = request()->param();
        $cate = new \app\common\service\admin\CourseCategoryService();
        $res = $cate->addCourseCate($params);
        var_dump($res);die;
        return $res;
    }

    public function editCate()
    {
        $id = request()->param('id');
        $course = new \app\common\model\CourseCategory();
        $res = $course->get_list($id);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    /**
     * 获取分类信息
     */
    public function edit()
    {
        $id = request()->param();
        $cate = new \app\common\service\admin\CourseCategoryService();
        $res = $cate->getCourseTypeInfo($id);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }
}