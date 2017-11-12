<?php 
namespace app\common\model;
use think\Model;
use think\Db;

class CourseCategory extends Model
{
    /**
     * 课程类型
     */
    public function getCourseCateList()
    {
        $whereArr = array();
        $wherestr = ' 1 ';
        $offset = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $page = isset($_REQUEST['pageSize']) ? $_REQUEST['pageSize'] : 10;
        $limit = "limit ".($offset-1) * $page.",$page";
        $sql = "SELECT a.* FROM course_category a where $wherestr ORDER BY sort DESC $limit";
        $countSql = "SELECT count(*) as count FROM course_category a where $wherestr ";
        $data = Db::query($sql,$whereArr);
        $count = Db::query($countSql,$whereArr);
        $result = array('data'=>$data, 'count'=>$count[0]['count']);

        return $result;
       // return $this->select();

    }

    public function get_list($id){
        $res = $this->where('id',$id)->find();
        return $res;
    }
     /**
     * 新增课程类型
     */
    public function addCourseCate($data)
    {
        try {
           
            $insertId = $this->insertGetId(['title'=>$data['title'],'create_time'=>date('Y-m-d H:i:s')]);

            return $insertId;

        } catch (\Exception $e) {

            exit(json_encode(array('status' => false, 'msg' => $e->getMessage())));

        }
    }

     /**
     * 修改课程类型
     */
    public function editCourseCate($data){
    
        return $this->update($data);
    }

    /**
     * 删除课程类型
     */
      public function delCourseCate($id){
        return $this->where('id',$id)->delete();
    }
    /**
     * 获取分类信息
     */
    public function getCourseTypeInfo($id)
    {
        return $this->where('id',$id['id'])->find();
    }

	/**
     * 获取分类
     */
    public function get_course_type()
    {
        return $this->field('id, title')->select();
	}
}
