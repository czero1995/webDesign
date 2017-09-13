<?php
namespace app\admin\controller;
use app\common\model\Account AS AccountModel;
use think\Db;

class Account extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new AccountModel();
    }

    public function index()
    {
        $list = Db::name("account")->where('status', 1)->select();
        $roles = Db::name("role")->where('status', 1)->column('role', 'id');
        foreach ($list as $key=>$value) {
            $user_id = $value['id'];
            $role_names = Db::query("select b.role from user_role a inner join role b on a.role_id = b.id where a.user_id = $user_id");
            $role_names = array_column($role_names, "role");
            $role_names = empty($role_names) ? '' : implode(', ', $role_names);
            $list[$key]['role'] = $role_names;
        }
        $this->assign('list',$list);
        $this->assign('roles',$roles);
     
        return $this->fetch();

    }

   public function add()
    {
        if(request()->isPost()){
            try {
                $data = input('post.');
               /* $result = $this->validate($data,'Account');
                if($result !== true){
                    exception($result);
                }*/
                $data['create_time'] = $data['update_time'] = $data['last_login'] = date("Y-m-d H:i:s");
                $data['create_user'] = $data['update_user'] = $this->loginUser;

                $insertLastId = Db::name("account")->insert($data);
                if(!$insertLastId){
                    exception("新增账户失败");
                }

                exit(json_encode(array('status'=>true,'url'=>url('admin/account/index'))));
            } catch (\Exception $e) {
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }
        return $this->fetch();
    }


    
     public function edit($id)
    {
        $data = Db::name("account")->where('id', $id)->find();
        if(request()->isPost()){
            try {
                $data = input('post.');

                $id = $data['id'];
                unset($data['id']);

                $data['update_time'] = date("Y-m-d H:i:s");
                $data['update_user'] = $this->loginUser;

                $updateLastId = Db::name("account")->where("id = $id")->update($data);
                if(!$updateLastId){
                    exception("修改角色失败");
                }

                exit(json_encode(array('status'=>true,'url'=>url('admin/account/index'))));
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


    public function editAccount()
    {
        $id = request()->param('id');
        $account = new \app\common\model\Account();
        $res = $account->get_list($id);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    public function setRole()
    {
        if(request()->isPost()){
            try {
                $data = input('post.');
                Db::startTrans();
                $user_id = $data['user_id'];
                $roles = $data['role_id'];
                Db::name("userRole")->where('user_id', $user_id)->delete();

                foreach ($roles as $value) {
                    $data = array();
                    $data['role_id'] = $value;
                    $data['user_id'] = $user_id;
                    $data['create_time'] = date("Y-m-d H:i:s");
                    $data['create_user'] = $this->loginUser;

                    $insertLastId = Db::name("userRole")->insert($data);
                    if(!$insertLastId){
                        exception("删除角色失败");
                    }
                }

                Db::commit();    
                exit(json_encode(array('status'=>true,'url'=>url('admin/account/index'))));
            } catch (Exception $e) {
                Db::rollback();
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }else{

        }
    }

    public function del($id){
        try {
            $data['status'] = 0;
            $data['update_time'] = date("Y-m-d H:i:s");
            $data['update_user'] = $this->loginUser;

            $updateLastId = Db::name("account")->where('id',$id)->update($data);
            if(!$updateLastId){
                exception("删除角色失败");
            }

            exit(json_encode(array('status'=>true,'url'=>url('admin/account/index'))));
        } catch (Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }

  
}
