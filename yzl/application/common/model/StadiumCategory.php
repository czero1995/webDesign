<?php
namespace app\common\model;
use think\Model;
use think\Db;

class StadiumCategory extends Model
{
	/**
	 * 获取场馆类型
	 */
	public function getStadiumcateList($params){

        $page = isset($params['pageSize']) ? $params['pageSize'] : 5;
        $offset = isset($params['pageNumber']) ? $params['pageNumber'] : 1;
        $limit = "limit ".($offset-1) * $page.",$page";

        $sql = " select * from stadium_category order by sort desc $limit";
        $list = Db::query($sql);

        return [
            'total' => $this->count(),
            'rows' => $list ? $list : []
        ];
	}

    /**
     * 新增场馆类型
     */
    public function addStadiumCate($data)
    {

        try {

            $type = explode(',',$data['title']);
            foreach ($type as $val)
            {
                $this->insertGetId(['title'=>$val,'create_time'=>date('Y-m-d H:i:s')]);
            }

            return true;

        } catch (\Exception $e) {

            exit(json_encode(array('status' => false, 'msg' => $e->getMessage())));

        }


    }

	/**
	 * 更新场馆类型
	 */
	public function editStadiumcate($data){
		
		return $this->update($data);
	}

	/**
	 * 删除场馆类型
	 */
	public function delStadiumCate($stadiumCate_id){
		$where = array(
			'id' => $stadiumCate_id
			);
		return $this->where($where)->delete();
	}

	/**
     * 删除分类
     */
    public function delStadiumType($ids)
    {
        return $this->where('id','in',$ids['id'])->delete();
	}

    /**
     * 获取分类信息
     */
    public function getStadiumTypeInfo($id)
    {
        return $this->where('id',$id['id'])->find();
    }

    /**
     * 修改分类
     */
    public function editStadiumType($data)
    {
        return $this->where('id',$data['id'])->update(['title'=>$data['title'],'update_time'=>date('Y-m-d H:i:s')]);
    }



}

?>