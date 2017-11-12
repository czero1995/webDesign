<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\common\model\Module AS ModuleModel;
use think\Db;
use think\Log;

class Module extends Base
{
    public function _initialize()
    {
        parent::_initialize();
     
        $this->model = new ModuleModel();
    }

    public function index()
    {
        // Holiday::write('测试日志信息，这是警告级别，并且实时写入','error');
        // $list = Db::name("module")->select();
        $where = array('status'=>1);
        $list = $this->model->getList($where);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            try {
                $data = input('post.');
              /*  $result = $this->validate($data,'Module');
                if($result !== true){
                    exception($result);
                }
*/
                $result = $this->model->addModule($data);

                if(!$result){
                    exception("新增菜单失败");
                }

                exit(json_encode(array('status'=>true,'url'=>url('admin/module/index'))));
            } catch (\Exception $e) {
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }
        $list = $this->model->getList();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit($id)
    {
        $data = Db::name("t_module")->where('id', $id)->find();
        if(request()->isPost()){
            try {
                $data = input('post.');
               /* $result = $this->validate($data,'Module');
                if($result !== true){
                    exception($result);
                }
*/
                Db::startTrans();
                $updateLastId = $this->model->editModule($data);
                if(!$updateLastId){
                    exception("修改菜单失败");
                }

                Db::commit();    
                exit(json_encode(array('status'=>true,'url'=>url('admin/module/index'))));
            } catch (Exception $e) {
                Db::rollback();
                exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
            }
        }

        if(empty($data)){
            $this->error('该菜单不存在');
        }
        $list = $this->model->getList();
        $this->assign('list',$list);
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function del($id)
    {
        try {
            $data['status'] = 2;
            $data['update_time'] = date("Y-m-d H:i:s");
            $data['update_user'] = $this->loginUser;

            $updateLastId = Db::name("t_module")->where("id = $id")->update($data);
            if(!$updateLastId){
                exception("删除菜单失败");
            }

            exit(json_encode(array('status'=>true,'url'=>url('admin/module/index'))));
        } catch (Exception $e) {
            exit(json_encode(array('status'=>false,'msg'=>$e->getMessage())));
        }
    }

    public function getChildModule()
    {
        $parent_id = $this->request->param("parent_id");
        if($parent_id){
            $list = Db::name("t_module")->where('parent_id', $parent_id)->column("module_name",'id');
            exit(json_encode(array('status'=>true,'data'=>$list)));
        }else{
            exit(json_encode(array('status'=>false,'msg'=>'数据异常')));
        }
    }
}
