<?php
namespace app\common\model;
use think\Model;
use think\Db;

class Tags extends Model{

	public function getTagsList(){
        $whereArr = array();
        $wherestr = ' 1 ';
        $offset = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $page = isset($_REQUEST['pageSize']) ? $_REQUEST['pageSize'] : 6;
        $limit = "limit ".($offset-1) * $page.",$page";
        $sql = "SELECT a.* FROM tags a where $wherestr ORDER BY a.status=2 DESC $limit";
        $countSql = "SELECT count(*) as count FROM tags a where $wherestr ";
        $data = Db::query($sql,$whereArr);
        $count = Db::query($countSql,$whereArr);
        $result = array('data'=>$data, 'count'=>$count[0]['count']);

        return $result;
    
	}

    public function getTagsInfo($id){
       return $this->where('id',$id['id'])->find();
    }
	/**
     * 新技能标签
     */
	public function addTags($data)
    {
       return $this->insertGetId($data);

    }

    /**
     * 修改场馆
     */
    public function editTags($data){

    	return $this->update($data);
    }

    /**
     * 删除场馆
     */
      public function delTags($id){

        $where=array(
            'id' => $id
            );
    	return $this->where($where)->delete();
    }


      /**
     * 获取标签名称
     * @param $tags_id
     * @return $name 标签名称
     */
    public function get_tags_name($tags_id)
    {
        return $this->where('id',$tags_id)
                    ->field('id,name')
                    ->select();
    }

    /**
     * 获取从业经验
     */
    public function get_exper_type()
    {
        return $this->where('type',2)->field('id,name')->order('sort desc')->select();
    }
}


?>

