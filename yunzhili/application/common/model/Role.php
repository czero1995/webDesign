<?php 
namespace app\common\model;
use think\Model;
use think\Db;

class Role extends Model{

	public function getlist(){
        $list = Db::name("role")->where('status', 1)->select();
        return $list;
    }

    public function get_list($id){
    	return $this->where($id)->find();
    }

    public function addRole($data){
    	return $this->save($data);
	}

	public function editRole($data){
		
		return $this->update($data);
	
	}
	public function delRole($id){
		$where = [
			'id' => $id
		];
		return $this->where($where)->delete();
	}

}
 ?>