<?php 
namespace app\common\service;
use think\Model;

class AccountService extends Model
{

	protected $accountModel;

	public function __construct()
	{
		$this->accountModel = \think\Loader::model('Account', 'model');
	}

	public function get_list()
	{
		return $this->accountModel->get_list();
	}
}