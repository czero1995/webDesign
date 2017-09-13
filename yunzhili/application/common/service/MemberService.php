<?php 
namespace app\common\service;
use think\Model;


class MemberService extends Model
{

	protected $memberModel;

	public function __construct()
	{
		$this->memberModel = \think\Loader::model('Member', 'model');
	}

	public function get_list()
	{
		return $this->memberModel->get_list();
	}

	
}