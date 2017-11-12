<?php 
namespace app\common\model;
use think\Model;
use think\Db;

class Banner extends Base{

	/**
	 * banner列表
	 */
	public function getBannerList()
	{
        $whereArr = array();
        $wherestr = ' 1 ';
        $offset = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $page = isset($_REQUEST['pageSize']) ? $_REQUEST['pageSize'] : 6;
        $limit = "limit ".($offset-1) * $page.",$page";
        $sql = "SELECT a.* FROM banner a where $wherestr ORDER BY a.type=1 ASC $limit";
        $countSql = "SELECT count(*) as count FROM banner a where $wherestr ";
        $data = Db::query($sql,$whereArr);
        $count = Db::query($countSql,$whereArr);
        $result = array('data'=>$data, 'count'=>$count[0]['count']);

        return $result;
	    
	}
    
    public function get_list($id){
        $res = $this->where('id',$id)->find();
        return $res;
    }

	/**
	 * 新增banner
	 */
	public function addBanner($data){
      return $this->save($data);
      
    }

    /**
     * 修改banner图
     */
  public function editBanner($data){


    	return $this->update($data);
    }

    /**
     * 删除banner图
     */
  public function deleteBanner($id){

      $where = array(
        'id' => $id
        );
      return $this->where($where)->delete();

    	
    }

	/**
     * 获取分类banner
     * @param type
     * @return array
     */
    public function get_banner_list($type)
    {
        return $this->where('type',$type)->select();
	}
}


 ?>