<?php 
namespace app\index\controller;
use think\Controller;

/**
 * 场馆相关模块
 */
class Stadium extends Base{

	/**
	 * 场馆首页
	 * @return [type] [description]
	 */
	public function index()
	{
		return $this->fetch();
	}


    public function details($id){
        return $this->fetch('details',['id'=>$id]);
    }
}

 ?>