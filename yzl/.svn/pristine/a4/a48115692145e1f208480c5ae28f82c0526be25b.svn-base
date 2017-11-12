<?php 
namespace app\common\model;
use think\Model;
use think\Db;
class Account extends Base
{
    //自定义初始化
    protected function initialize()
    {
        parent::initialize();
    }

	public function getAccountList()
	{
		$list = $this->where('status', 1)->select();
        $roles = Db::name("role")->where('status', 1)->column('role', 'id');
        foreach ($list as $key=>$value) {
            $user_id = $value['id'];
            $role_names = Db::query("select b.role from user_role a inner join role b on a.role_id = b.id where a.user_id = $user_id");
            $role_names = array_column($role_names, "role");
            $role_names = empty($role_names) ? '' : implode(', ', $role_names);
            $list[$key]['role'] = $role_names;
        }

       return array('list' => $list,'roles'=>$roles);
	
	}
    public function get_list($id){
        $res = $this->where('id',$id)->find();
        return $res;
    }
	
	public function login($account, $password)
    {
        $where = array(
            'account' => $account,
            'password' => $password
            );

        return $this->where($where)->find();
    }

    public function addAccount($data){
       
         
       return $this->save($data);
    	
    }

    public function editAccount($data){
 		try{
            $id = $data['id'];
            $role_id = $data['role_id'] ; 
            unset($data['role_id']);
            $data['update_time'] = $data['last_login'] = date("Y-m-d H:i:s");
            $updateId = $this->where('id',$id)->update($data);

            if (!empty($updateId)) {
                Db::name('user_role')->where('user_id',$id)->delete();
                Db::name('user_role')->insert(
                    array(
                        'user_id' => $id,
                        'role_id' => $role_id,
                        'create_time' => date('Y-m-d H:i:s')
                    ));
            }
            return $data;
         }catch(\Exception $e){
            Db::rollback();
            $this->errorMsg = $e->getMessage();
            return false; 
        }
    	
    }

    public function del($id){
        return $this->where('id',$id)->delete();
    }
}





