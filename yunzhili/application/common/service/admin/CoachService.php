<?php
namespace app\common\service\admin;
use think\Model;

/**
* 
*/
class CoachService extends Model
{
	protected $coachModel;
	protected $coachCategoryModel;
	protected $coachCateConnModel;
	protected $coachcourseModel;

	public function __construct()
	{
		$this->coachModel = \think\Loader::model('Coach','model');
		$this->coachCateConnModel = \think\Loader::model('CoachCateConn','model');
		$this->coachcourseModel = \think\Loader::model('CoachCourse','model');
	}

	/**
	 * 教练列表
	 */
	public function getCoachList($param){
		return $this->coachModel->getCoachList($param);
	}

	/**
	 * 教练详情
	 */
	public function getCoachDetail($coachid){
		return $this->coachCateConnModel->getCoachDetail($coachid);
	}

	/**
	 * 新增教练
	 */
	public function addCoach($data){
		return $this->coachModel->addCoach($data);
			
	}

	/**
     * 更新教练
     */
    public function editCoach($data){

        return $this->coachModel->editCoach($data);

    }

    /**
     * 更新教练状态
     */
    public function coachStatus($param){

        return $this->coachModel->coachStatus($param);

    }

	/**
	 * 删除教练
	 */
	public function deleteCoach($coach_id)
	{
	
		return $this->coachModel->deleteCoach($coach_id);
	}

	/**
     * 批量删除
     */
    public function deleteCoachList($ids)
    {

        return $this->coachModel->deleteCoachList($ids);
    }
	
}

?>