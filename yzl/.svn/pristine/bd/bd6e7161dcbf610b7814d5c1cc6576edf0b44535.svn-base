<?php
namespace app\common\service\admin;
use think\Model;

/**
* 
*/
class CoachCategoryService extends Model
{
	protected $coachCategoryModel;
	public function __construct()
	{
		$this->coachCategoryModel = \think\Loader::model('CoachCategory','model');
	}

	public function getCoachCateList($params){

		return $this->coachCategoryModel->getCoachCateList($params);

	}

	/**
	 * 新增教练类型
	 */
	public function addCoachCate($data)
    {

        return $this->coachCategoryModel->addCoachCate($data);

	}

	/**
	 * 修改教练类型
	 */
	public function editCoachCate($data)
    {

        return $this->coachCategoryModel->editCoachCate($data);
		
	}

	/**
	 * 删除教练类型
	 */
	public function del($id)
	{
	
		return $this->coachCategoryModel->del($id);
	}

	public function delCoachType($ids)
    {
        return $this->coachCategoryModel->delCoachType($ids);
    }

    /**
     * 获取分类信息
     * @param $id
     * @return mixed
     */
    public function getCoachTypeInfo($id)
    {

        return $this->coachCategoryModel->getCoachTypeInfo($id);
    }

    /**
     * 修改分类
     */
    public function editCoachType($data)
    {
        return $this->coachCategoryModel->editCoachType($data);
    }

}

?>