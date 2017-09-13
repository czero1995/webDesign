<?php
namespace app\common\model;
use think\Db;
use think\Model;

class Course extends Model
{
    /**
     * 获取课程详情
     */
    public function get_course_info($id)
    {
        if($id)
        {
            $map = array('a.id'=>$id);
        }
        return $this->alias('a')
            ->where($map)
            ->field('a.id, a.title, a.sub_title, a.price, a.intro, a.post, b.title as tags')
            ->join('course_category b','a.cate_id = b.id','LEFT')
            ->select();

    }

    public function  get_list($id){
        $res = $this->where('id',$id)->find();
        return $res;
    }
    /**
     * 获取推荐课程列表
     * @return arr
     */
    public function get_course_list($params)
    {
        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;

        $res = $this->alias('a')
            ->field('a.id, a.title, a.sub_title, a.price, a.post, b.title as tags')
            ->join('course_category b','a.cate_id = b.id','LEFT')
            ->order('a.is_recommend asc, a.id desc') //按推荐排序 再按id排序
            ->limit(($offset-1) * $page,$page)
            ->select();
        return ['data'=>$res, 'page'=>$offset];
    }

    /**
     * 获取人气课程列表
     * @return arr
     */
    public function get_course_sort($params)
    {
        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;

        $res = $this->alias('a')
            ->field('a.id, a.title, a.sub_title, a.price, a.post, b.title as tags')
            ->join('course_category b','a.cate_id = b.id','LEFT')
            ->order('a.sort desc, a.id') //按人气排序 再按id排序
            ->limit(($offset-1) * $page,$page)
            ->select();
        return ['data'=>$res, 'page'=>$offset];
    }

    /**
     * 获取筛选课程列表
     * @return arr
     */
    public function get_course_screen($params)
    {

        $param = $params['where'] ? $params['where'] : null;


        $map = '';
        $str = '';

        if($params['where'])
        {
            //按类型查
            if($param['type'])
            {
                $map .= 'a.cate_id = ' . $param['type'];
            }

            //按地区查
            if($param['area'])
            {
                //获取场馆ID
                $stadium_ids = Db::name('stadium')->where('district_code','in',implode(',',$param['area']))->column('id');

                //获取课程ID
                $course = Db::name('stadium_course')->distinct(true)->field('course_id')->where('stadium_id','in',implode(',',$stadium_ids))->column('course_id');


                $str .= 'a.id in (' . implode(',', $course) . ') ' ;

            }
        }


        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;

        $res = $this->alias('a')
                    ->where($map)
                    ->where($str)
                    ->field('a.id, a.title, a.sub_title, a.price, a.post, b.title as tags')
                    ->join('course_category b','a.cate_id = b.id','LEFT')
                    ->order('a.sort desc, a.id') //按人气排序 再按id排序
                    ->limit(($offset-1) * $page,$page)
                    ->select();
        return ['data'=>$res, 'page'=>$offset];
    }

    /**
     * 获取课程列表
     */
    public function getCourseList(){
        $whereArr = array();
        $wherestr = ' 1 ';
        $offset = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $page = isset($_REQUEST['pageSize']) ? $_REQUEST['pageSize'] : 10;
        $limit = "limit ".($offset-1) * $page.",$page";
        $sql = "SELECT a.* FROM course a where $wherestr ORDER BY a.id DESC $limit";
        $countSql = "SELECT count(*) as count FROM course a where $wherestr ";
        $data = Db::query($sql,$whereArr);
        $count = Db::query($countSql,$whereArr);
        $result = array('data'=>$data, 'count'=>$count[0]['count']);

        return $result;
    }

    /**
     * 添加课程
     */
    public function addCourse($data){
        return $this->save($data);
    }
    /**
     * 修改课程
     */
    public function editCourse($data){
        Db::startTrans();
        try{
            $id = $data['id'];
            unset($data['id']);
            $data['update_time'] = date('Y-m-d H:i:s');
            $updateLastId = $this->where('id',$id)->update($data);

            if (!$updateLastId) {
                $this->errorMsg = '修改失败';
            }

            Db::commit();
            return $updateLastId;

        }catch(\Exception $e){
            Db::rollback();
            $this->errorMsg = $e->getMessage();
            return false;
        }

    }

    /**
     * 删除课程
     */
    public function delCourse($id)
    {
        $where = array(
            'id' => $id
        );
        return $this->where($where)->delete();
    }


}
