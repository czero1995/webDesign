<?php 
namespace app\common\service\admin;
use think\Model;

class roleService extends Model{

	protected $roleModel;

	public function __construct()
	{
		$this->roleModel = \think\Loader::model('Role', 'model');
	}

	public function getRoleList()
	{
		return $this->roleModel->getlist();
	}

	public function addRole($data){
		return $this->roleModel->addRole($data);
	}

	public function editRole($data){
		try{
			return $this->roleModel->editRole($data);
		
		}catch(\Exception $e){
			$this->errorMsg = $e->getMessage();
		}
	}

	public function delRole($id){
		return $this->roleModel->delRole($id);
	}

}

 ?>