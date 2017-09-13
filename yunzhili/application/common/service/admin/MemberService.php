<?php
namespace app\common\service\admin;
use think\Model;

/**
* 
*/
class MemberService extends Model
{
	protected $memberModel;
	public function __construct()
	{
		$this->memberModel = \think\Loader::model('Member','model');
	}

	public function getList(){
		return $this->memberModel->getList();
	}

	public function getDetail($id){
		return $this->memberModel->getDetail($id);
	}

	public function login($account, $password)
	{
		return $this->memberModel->login($account, $password);
	}
	 public function delmember($id)
    {
    	return $this->memberModel->delmember($id);
    }
}

?>