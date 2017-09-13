<?php 
namespace app\index\controller;
use think\Controller;

/**
 * 教练相关模块
 */
class Coach extends Base{

	/**
	 * 教练列表
	 * @return [type] [description]
	 */
	public function index()
	{
		return $this->fetch();
	}

	/**
	 * 教练详情
	 * @return [type] [description]
	 */

    public function details($id){
        return $this->fetch('details',['id'=>$id]);
    }

}



 ?>