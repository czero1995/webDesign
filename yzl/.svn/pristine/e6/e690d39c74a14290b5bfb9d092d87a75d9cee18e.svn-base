<?php
namespace app\common\service\admin;
use think\Model;

/**
 * 
 */
class CourseService extends Model
{
	protected $CourseModel;
	protected $CourseCateModel;
	
	function __construct()
	{
		$this->CourseModel = \think\Loader::model('Course','model');
		$this->CourseCateModel = \think\Loader::model('CourseCategory','model');
	}
	/**
	 * 课程列表
	 */
	public function getCourseList(){
		return $this->CourseModel->getCourseList();
	}

	/**
	 * 课程类型列表
	 */
	public function getCourseCateList()
	{
		return $this->CourseCateModel->getCourseCateList();
	}

	 /**
     * 新增课程
     */
	public function addCourse($data)
    {
		return $this->CourseModel->addCourse($data);
    }

     /**
     * 修改课程
     */
    public function editCourse($data){

		return $this->CourseModel->editCourse($data);
    	
    }

    /**
     * 删除课程
     */
    public function delCourse($id)
    {
    	return $this->CourseModel->delCourse($id);
    }

    public function get_course_info($id){
        return $this->CourseModel->get_list($id);
    }
}


?>