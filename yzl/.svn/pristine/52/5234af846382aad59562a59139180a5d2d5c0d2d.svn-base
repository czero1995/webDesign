<?php
namespace app\common\service\admin;
use think\Model;

/**
* 
*/
class  CourseCategoryService extends Model{
	protected $courseCateModel;
	public function __construct()
	{
		$this->courseCateModel = \think\Loader::model('CourseCategory','model');
	}
	/**
	 * 课程类型列表
	 */
	public function getCourseCateList(){
		return $this->courseCateModel->getCourseCateList();
	}

	/**
	 * 新增课程类型
	 */
	public function addCourseCate($data){

		    return $this->courseCateModel->addCourseCate($data);
	
	}

	/**
	 * 修改课程类型
	 */
	public function editCourseCate($data){

		try{

			return $this->courseCateModel->editCourseCate($data);
		} catch(\Exception $e) {
           
            $this->errorMsg = $e->getMessage();
        }
		
	}

    /**
     * 获取分类信息
     */
    public function getCourseTypeInfo($id)
    {

        return $this->courseCateModel->getCourseTypeInfo($id);
    }

	/**
	 * 删除课程类型
	 */
	public function delCourseCate($id){
		return $this->courseCateModel->delCourseCate($id);
	}
}

?>