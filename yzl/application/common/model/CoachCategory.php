<?php 
namespace app\common\model;
use think\Model;
use think\Db;

class CoachCategory extends Model{
    /**
     * 获取类型名称
     * @param $cate_id
     * @return $title 类型名称
     */
    public function get_coach_title($cate_id)
    {

        return $this->where('id',$cate_id)
                    ->field('title')
                    ->select();

    }


	/**
	 * 教练类型
	 */
	public function getCoachCateList($params)
	{
        $page = isset($params['pageSize']) ? $params['pageSize'] : 5;
        $offset = isset($params['pageNumber']) ? $params['pageNumber'] : 1;
        $limit = "limit ".($offset-1) * $page.",$page";

        $sql = " select * from coach_category order by sort desc $limit";
        $list = Db::query($sql);

        return [
            'total' => $this->count(),
            'rows' => $list ? $list : []
        ];
		//return $this->select();
	}

	 /**
     * 新增教练类型
     */
	public function addCoachCate($data)
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
     * 修改教练类型
     */
    public function editCoachCate($data){
    
    	return $this->update($data);
    }

    /**
     * 删除教练类型
     */
      public function del($id){

       
    	return $this->where('id',$id)->delete();
    }

    public function delCoachType($ids)
    {

        return $this->where('id','in',$ids['id'])->delete();
    }

    /**
     * 获取分类信息
     */
    public function getCoachTypeInfo($id)
    {
        return $this->where('id',$id['id'])->find();
    }

    /**
     * 修改分类
     */
    public function editCoachType($data)
    {
        return $this->where('id',$data['id'])->update(['title'=>$data['title'],'update_time'=>date('Y-m-d H:i:s')]);
    }
   
}

