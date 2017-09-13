<?php
namespace app\api\controller;
use think\Controller;


class Login extends Controller
{
	
	public function index(){
		return $this->fetch();
	}

	/**
	 * 登出操作
	 */
	public function  logout()
    {

	}


	
}
?>