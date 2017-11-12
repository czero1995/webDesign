<?php 
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;

/**
 * 课程相关模块
 */
class Course extends Base
{

	/**
	 * 课程列表
	 * @return [type] [description]
	 */
	public function index()
	{
        return $this->fetch('index',['openid'=>request()->session('openid')]);
	}


	/**
	 * 课程详情
	 * @return [type] [description]
	 */
	public function details($id)
	{
        return $this->fetch('details',['id'=>$id]);
	}

	
}



?>