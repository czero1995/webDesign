<?php
namespace app\api\controller;
use think\Controller;
use think\Db;

class Stadium extends Base{

	protected $stadiumService;

	public function __construct()
    {
        parent::__construct();
        $this->stadiumService = \think\Loader::model('StadiumService', 'service\admin');

    }

    /**
     * 场馆列表
     */
    public function getStadiumList(){
    	$stadium = $this->stadiumService->getStadiumList(request()->param());

    	if ($stadium) {
    		return $stadium;
    	} else {
            return result($stadium, 500, '调用失败');
        }

    }

    /**
     * 新增场馆
     */
    public function addStadium(){
        $data  =input('param.');
    
        $res = $this->stadiumService->addStadium($data);
        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }

    }

    /**
     * 修改场馆
     */
    public function editStadium(){
        $data  =input('param.');

        $res = $this->stadiumService->editStadium($data);
        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }
    
    }

    /**
     * 删除场馆
     */
    public function delStadium(){
        $id = request()->param();
        $res = $this->stadiumService->delStadium($id);
        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }

    }

    /**
     * 场馆详情
     */
    public function detailStadium()
    {
        $id = request()->param('id');
        $stadium = new \app\common\service\wechat\StadiumService();
        $res = $stadium->get_stadium_info($id);

        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }
    }
}

?>