<?php
namespace app\common\service\admin;
use think\Model;


class StadiumCategoryService extends Model{
	
	protected $stadiumCateModel;
	
	public function __construct()
	{
		$this->stadiumCateModel = \think\Loader::model('StadiumCategory','model');
	}
	public function getStadiumcateList($params){
		return $this->stadiumCateModel->getStadiumcateList($params);
	}

	public function editStadiumcate($data){
		

		return $this->stadiumCateModel->editStadiumcate($data);
		
	}

	public function delStadiumCate($stadiumCate_id){
		
		return $this->stadiumCateModel->delStadiumCate($stadiumCate_id);
		
	}

	/**
     * 场馆分类
     */
    public function getStadiumTypeList($params)
    {
        return $this->stadiumCateModel->getStadiumTypeList($params);
	}

	/**
     * 新增分类
     */
    public function addStadiumCate($data)
    {
        return $this->stadiumCateModel->addStadiumCate($data);
	}

    /**
     * 删除分类
     * @param $ids
     * @return int
     */
    public function delStadiumType($ids)
    {

        return $this->stadiumCateModel->delStadiumType($ids);
    }

    /**
     * 获取分类信息
     */
    public function getStadiumTypeInfo($id)
    {
        return $this->stadiumCateModel->getStadiumTypeInfo($id);
    }

    public function editStadiumType($id)
    {
        return $this->stadiumCateModel->editStadiumType($id);
    }

}

?>