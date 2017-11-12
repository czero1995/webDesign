<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\common\model\Module AS ModuleModel;
use think\Db;
use think\Log;

class Role extends Base
{
  /*  public function index()
    {
          $data = [
            'sidename'   =>  '角色管理',
            'active'     =>  '8',
        ];
        $this->assign('sidename', $data['sidename']);
        $this->assign('active', $data['active']);
        return $this->fetch();
    }*/

    // public function edit()
    // {
    //     $id = request()->param();
    //     $role = new \app\common\model\Role();
    //     $res = $role->get_list($id);

    //     if($res)
    //     {
    //         return result($res);
    //     } else {
    //         return result($res,500,'调用失败');
    //     }
    // }
    public function index(){
 
        $list = Db::name("role")->where('status', 1)->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit($id)
    {
        $data = Db::name("role")->where('id', $id)->find();
        if(request()->isPost()){
            try {
                $data = input('post.');
//                //$result = $this->validate($data,'Role');
//                if($result !== true){
//                    exception($result);
//                }

                $id = $data['id'];
                unset($data['id']);

                $data['update_time'] = date("Y-m-d H:i:s");
                $data['update_user'] = $this->loginUser;

                $updateLastId = Db::name("role")->where("id = $id")->update($data);
                if(!$updateLastId){
                    exception("修改角色失败");
                }

                exit(json_encode(array('status'=>true,'url'=>url('admin/role/index'))));
            } catch (Exception $e) {
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }

        if(empty($data)){
            $this->error('该角色不存在');
        }
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function del($id)
    {
        try {
            $data['status'] = 2;
            $data['update_time'] = date("Y-m-d H:i:s");
            $data['update_user'] = $this->loginUser;

            $updateLastId = Db::name("role")->where("id = $id")->update($data);
            if(!$updateLastId){
                exception("删除角色失败");
            }

            exit(json_encode(array('status'=>true,'url'=>url('admin/role/index'))));
        } catch (Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }

    public function setAuth()
    {
       
        $role_id = request()->param('role_id');
        if(request()->isPost()){
            try {
                $data = input('post.');
                Db::startTrans();
                $modules = $data['module_id'];
                Db::name("roleModule")->where('role_id', $role_id)->delete();
                foreach ($modules as $value) {
                    $data = array();
                    $data['role_id'] = $role_id;
                    $data['module_id'] = $value;
                    $data['create_time'] = date("Y-m-d H:i:s");
                    $data['create_user'] = $this->loginUser;

                    $insertLastId = Db::name("roleModule")->insert($data);
                    if(!$insertLastId){
                        exception("删除角色失败");
                    }
                }

                Db::commit();    
                exit(json_encode(array('status'=>true,'url'=>url('admin/role/index'))));
            } catch (Exception $e) {
                Db::rollback();
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }
        $moduleModel = new ModuleModel();
        $list = $moduleModel->getList();
        $module_ids = Db::name('roleModule')->where('role_id', $role_id)->column('module_id');
        $this->assign('list',$list);
        $this->assign('role_id', $role_id);
        $this->assign('module_ids', $module_ids);
        return $this->fetch();
    }
 

}
