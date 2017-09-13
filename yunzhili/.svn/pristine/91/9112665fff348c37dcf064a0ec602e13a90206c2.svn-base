<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Course extends Base{
	
    /**
     * 课程列表
     */
    public function index(){
        //获取课程类型
        $type = Db::name('courseCategory')->field('id,title')->select();
        $data = [
            'course_type' =>  $type ? $type : []
        ];
    
        $this->assign('course_type', $data['course_type']);
        return $this->fetch();
    }

    /**
     * 课程详情
     */
    public function detail(){
      
        return $this->fetch();
    }

   	/**
   	 * 课程类型列表
   	 */
   	public function cate(){
   		
        return $this->fetch();
   	} 

    public function get_list(){
      $res = Db::name('course_category')->select();
      return $res;
    }

    public function addcate(){
        $params = request()->param();
        $cate = new \app\common\service\admin\CourseCategoryService();
        $res = $cate->addCourseCate($params);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }
    public function add(){
        //获取课程类型
      $type = Db::name('courseCategory')->field('id,title')->select();
      $data = [
          
            'course_type' =>  $type ? $type : []
        ];
       
        $this->assign('course_type',$data['course_type']);
        return $this->fetch();
    }


    public function edit($id){
    
      //获取课程类型
      $type = Db::name('courseCategory')->field('id,title')->select();
      $data = [
        
            'course_type' =>  $type ? $type : []
        ];
        
      $list = Db::name('Course')->where('id',$id)->find();
      $this->assign('data',$list);
  
      $this->assign('course_type',$data['course_type']);
      return $this->fetch();
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
}