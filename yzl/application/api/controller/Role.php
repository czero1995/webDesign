<?php
namespace app\api\controller;
use think\Controller;

class Role extends Base{
	
	protected $RoleService;

    public function __construct()
    {
        parent::__construct();
        $this->RoleService = \think\Loader::model('RoleService', 'service\admin');

    }


	public function getRoleList(){

        $RoleList = $this->RoleService->getRoleList();

        if ($RoleList) {

            return result($RoleList);
        }
            return result($RoleList, 500, '调用失败');
    }


    public function addRole(){
        
        $role = input('param.role');
        $description = input('param.description');
        $data = [
            'role'  =>  $role,
            'description'   =>  $description,
            'status'    =>  1,
            'create_user'  =>  'admin'
        ];

        $result = $this->RoleService->addRole($data);
        if ($result) {

            return result($result);
        }
            return result($result, 500, '调用失败');

    } 
    
    public function editRole(){
        $data = input('param.');
     
        $data['update_time'] = date("Y-m-d H:i:s");
        $result = $this->RoleService->editRole($data);
 
        if ($result) {

            return result($result, 200, ' 调用成功');
        }
            return result($result, 500, '调用失败');
    }

    public function delRole(){
        $id = input('param.id');
        $res = $this->RoleService->delRole($id);
        if ($res) {
            return result($res);
        }else{
            return result($result, 500, '调用失败');
        }
    }
}

?>