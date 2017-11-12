<?php
namespace app\api\controller;
use think\Controller;


class Stadiumcategory extends Base{
		
	protected $stadiumCateService;

	function __construct(){

		parent::__construct();
		$this->stadiumCateService = \think\Loader::model('StadiumCategoryService', 'service\admin');
	}

	public function getStadiumcateList(){
        $params = request()->param();

		$stadiumCate = $this->stadiumCateService->getStadiumcateList($params);
		
    	return $stadiumCate;
   

	}

	public function addStadiumcate(){
		$title = input('param.title');

        $data =array(
            'title' => $title,
    
            'create_time'=>date('Y-m-d H:i:s')
            );
        $res = $this->stadiumCateService->addStadiumcate($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
	}

	/**
	 * 更新场馆类型
	 */
	public function editStadiumcate(){
		$cate_id = input('param.id');
        $title = input('param.title');

        $data =array(
            'id' => $cate_id,
            'title' => $title,
           
            'update_time'=>date('Y-m-d H:i:s')
            );

        $res = $this->stadiumCateService->editStadiumcate($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
	}

	/**
	 * 删除场馆类型
	 */
	public function delStadiumCate($stadiumCate_id){
		$res = $this->stadiumCateService->delStadiumCate($stadiumCate_id);
         if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
	}
}


?>