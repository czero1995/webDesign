<?php
namespace app\common\service\admin;
use think\Model;
use think\Db;

/**
 * 
 */
class StadiumService extends Model
{
	protected $stadiumModel;
    protected $stadiumCateModel;
    protected $stadiumCoachModel;
    protected $stadiumCourseModel;
   
	function __construct(){

		$this->stadiumModel = \think\Loader::model('Stadium','model');
        $this->stadiumCateModel = \think\Loader::model('StadiumCategory','model');
        $this->stadiumCoachModel = \think\Loader::model('StadiumCoach','model');
        $this->stadiumCourseModel = \think\Loader::model('StadiumCourse','model');
	}

	public function getStadiumList($params){

        return $this->stadiumModel->getStadiumList($params);
    }

	 /**
     * 新增场馆
     */
	public function addStadium($data)
    {
		return $this->stadiumModel->addStadium($data);

    }

     /**
     * 修改场馆
     */
    public function editStadium($data){

		return $this->stadiumModel->editStadiums($data);
    }
    
     public function delStadium($id)
    {
        return $this->stadiumModel->delStadium($id);
    }

    /**
     * 删除场馆
     */
      public function delStadiums($ids)
    {
    	return $this->stadiumModel->delStadiums($ids);
    }
}


?>