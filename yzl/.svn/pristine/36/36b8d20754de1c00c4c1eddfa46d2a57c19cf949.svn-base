<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Tags extends Base{
	
    public function index(){
      
        return $this->fetch();
    }


   public function edit($id)
    {
        $data = Db::name("tags")->where('id', $id)->find();
        if(request()->isPost()){
            try {
                $data = input('post.');
               /* $result = $this->validate($data,'User');
                if($result !== true){
                    exception($result);
                }*/

                $id = $data['id'];
                unset($data['id']);

                $data['update_time'] = date("Y-m-d H:i:s");

                $updateLastId = Db::name("tags")->where('id',$id)->update($data);
                exit(json_encode(array('status'=>true,'url'=>url('admin/banner/index'))));
            } catch (Exception $e) {
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }
        $this->assign('data',$data);
        return $this->fetch();
    }


}