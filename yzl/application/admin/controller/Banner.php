<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Banner extends Base{
	
    /**
     * banner列表
     */
    public function index(){
        return $this->fetch();
    }

    public function add(){
     
        return $this->fetch();
    }

    public function edit($id){
       
        $id = request()->param('id');
        $list = Db::name('banner')->where('id',$id)->find();
        $bannerType = config('banner_type');
        $this->assign('type',$bannerType);
        $this->assign('data',$list);
        return $this->fetch();
    }

   

    public function editBanner()
    {
        $id = request()->param('id');
        $banner = new \app\common\model\Banner();
        $res = $banner->get_list($id);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }
 

}