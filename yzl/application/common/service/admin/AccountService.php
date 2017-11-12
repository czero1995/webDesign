<?php 
namespace app\common\service\admin;
use think\Model;

class AccountService extends Model{

	protected $accountModel;

	public function __construct()
	{
		$this->accountModel = \think\Loader::model('Account', 'model');
	}

	public function getAccountList()
	{
		return $this->accountModel->getAccountList();
	}

	/**
	 * 用户登录
	 */
	public function login($account, $password)
    {
        try{

			return $this->accountModel->login($account, $password);
			
		} catch (\Exception $e) {
           
            $this->errorMsg = $e->getMessage();
        }
    }

 

	public function addAccount($data){
		return $this->accountModel->addAccount($data);
	}

	public function editAccount($data){
	
		return $this->accountModel->editAccount($data);
	}

	public function del($id){
		return $this->accountModel->del($id);
	}

}

 ?>