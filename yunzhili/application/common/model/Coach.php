<?php
namespace app\common\model;
use think\Model;
use think\Db;
class Coach extends Base
{
    //自定义初始化
    protected function initialize()
    {
        parent::initialize();
    }

    public function getCoachList($param)
    {

        $list = $this->order($param['sortName'],$param['sortOrder'])
            ->limit(($param['pageSize'] * ($param['pageNumber'] - 1)),$param['pageSize'])
            ->select();

        return array(
            'total' => $this->count(),
            'rows' => $list ? $list : []
        );

    }

    /**
     * 新增教练
     */
    public function addCoach($data)
    {

        try{

            $datas = [
                'name'      =>      $data['name'],
                'sex'      =>      $data['sex'],
                'intro'     =>      $data['intro'],
                'title'     =>      $data['title'],
                'headimg'   =>      $data['headimg'],
                'status'    =>      1,
                'create_time' =>    date('Y-m-d H:i:s')
            ];

            $insertLastId = $this->insertGetId($datas);

            //添加教练类型
            if($insertLastId)
            {
                $cate = [
                    'coach_id'  =>  $insertLastId,
                    'cate_id'   =>  $data['cate_id'],
                    'create_time' =>    date('Y-m-d H:i:s')
                ];
                Db::name('coach_cate_conn')->insert($cate);
            }
            //添加关联场馆
            if($data['stadiumid'])
            {
                foreach ($data['stadiumid'] as $key => $val)
                {
                    Db::name('stadium_coach')->insert(['stadium_id'=>$val,'coach_id'=>$insertLastId,'create_time'=>date('Y-m-d H:i:s')]);
                }
            }
            //添加关联课程
            if($data['courseid'])
            {
                foreach ($data['courseid'] as $key => $val)
                {
                    Db::name('coach_course')->insert(['course_id'=>$val,'coach_id'=>$insertLastId,'create_time'=>date('Y-m-d H:i:s')]);
                }
            }
            //添加标签
            if($data['tagsid'])
            {
                foreach ($data['tagsid'] as $key => $val)
                {
                    Db::name('tags_conn')->insert(['tags_id'=>$val,'obj_type'=>2,'obj_id'=>$insertLastId,'create_time'=>date('Y-m-d H:i:s')]);
                }
            }

            return $insertLastId;

        }catch(\Exception $e){
            Db::rollback();
            $this->errorMsg = $e->getMessage();
            return false;
        }

    }

    /**
     * 修改教练
     */
    public function editCoach($data)
    {
        // 启动事务
      //  Db::startTrans();
        try{
            $datas = [
                'name'      =>      $data['name'],
                'sex'      =>      $data['sex'],
                'intro'     =>      $data['intro'],
                'title'     =>      $data['title'],
                'status'    =>      1,
                'update_time' =>    date('Y-m-d H:i:s')
            ];

            if(isset($data['headimg']))
            {
                $datas['headimg']   =   $data['headimg'];
            }

            $result = $this->where('id',$data['id'])->update($datas);

            if($result > 0)
            {
                //更新教练类型
                $cate = [
                    'cate_id'   =>  $data['cate_id'],
                    'create_time'  =>  date('Y-m-d H:i:s')
                ];
                Db::name('coach_cate_conn')->where('coach_id',$data['id'])->update($cate);
            }
            //添加关联场馆
            if($data['stadiumid'])
            {
                //删除原先关联
                Db::name('stadium_coach')->where('coach_id',$data['id'])->delete();
                foreach ($data['stadiumid'] as $key => $val)
                {
                    Db::name('stadium_coach')->insert(['stadium_id'=>$val,'coach_id'=>$data['id'],'create_time'=>date('Y-m-d H:i:s')]);
                }
            }
            //添加关联课程
            if($data['courseid'])
            {
                //删除原先关联
                Db::name('coach_course')->where('coach_id',$data['id'])->delete();
                foreach ($data['courseid'] as $key => $val)
                {
                    Db::name('coach_course')->insert(['course_id'=>$val,'coach_id'=>$data['id'],'create_time'=>date('Y-m-d H:i:s')]);
                }
            }
            //添加标签
            if($data['tagsid'])
            {
                //删除原先关联
                Db::name('tags_conn')->where(['obj_id'=>$data['id'],'obj_type'=>2])->delete();
                foreach ($data['tagsid'] as $key => $val)
                {
                    Db::name('tags_conn')->insert(['tags_id'=>$val,'obj_type'=>2,'obj_id'=>$data['id'],'create_time'=>date('Y-m-d H:i:s')]);
                }
            }

            return $result;

        }catch(\Exception $e){
            Db::rollback();
            $this->errorMsg = $e->getMessage();
            return false;
        }
    }

    /**
     *变更状态
     *@param int $id
     */
    public function coachStatus($param)
    {
        if($param['type'] == 1)
        {
            return $this->where('id',$param['id'])->update(['status'=>$param['status']]);
        } else {
            return $this->where('id',$param['id'])->update(['is_recommend'=>$param['is_recommend']]);
        }

    }

    /**
     * 删除教练
     */
    public function deleteCoach($coach_id)
    {
        $where = array(
            'id' => $coach_id
        );

        $headimg = $this->where($where)->value('headimg');

        $num = $this->where($where)->delete();

        if($num > 0)
        {
            //删除教练类型
            Db::name('coach_cate_conn')->where('coach_id',$coach_id)->delete();

            //删除教练标签
            Db::name('tags_conn')->where(['obj_id'=>$coach_id,'obj_type'=>2])->delete();

            //删除关联场馆
            Db::name('stadium_coach')->where('coach_id',$coach_id)->delete();

            //删除关联课程
            Db::name('coach_course')->where('coach_id',$coach_id)->delete();

            return true;
        } else {
            return false;
        }
    }

    /**
     * 批量删除教练
     * @param string $ids
     */
    public function deleteCoachList($ids)
    {

        $arr_headimg = $this->where('id','in',explode(',',$ids))->column('headimg');

        $num = $this->where('id','in',explode(',',$ids))->delete();

        if($num > 0)
        {
            /*foreach ($arr_headimg as $key => $val)
            {
                $path[$key] = ROOT_PATH.'/public'.$val;
                unlink($path[$key]); //删除头像
            }*/

            //删除教练类型
            Db::name('coach_cate_conn')->where('coach_id','in',explode(',',$ids))->delete();

            //删除教练标签
            Db::name('tags_conn')->where('obj_id','in',explode(',',$ids))->where('obj_type',2)->delete();

            //删除关联场馆
            Db::name('stadium_coach')->where('coach_id','in',explode(',',$ids))->delete();

            //删除关联课程
            Db::name('coach_course')->where('coach_id','in',explode(',',$ids))->delete();

            return true;
        } else {
            return false;
        }

    }


    /**
     * 获取推荐教练列表
     * @param is_recommend
     * @return json
     */
    public function get_coach_recommend($params)
    {
        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;

        $map = [
            'is_recommend' => 1
        ];

        //教练列表
        $coach_list =  $this->where($map)
            ->order('id', 'desc')
            ->limit(($offset-1) * $page,$page)
            ->select();

        return ['data'=>$coach_list, 'page'=>$offset];

    }

    /**
     * 获取人气教练列表
     * @param sort
     * @return json
     */
    public function get_coach_sort($params)
    {
        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;
        $limit = "limit ".($offset-1) * $page.",$page";

        //教练列表
//        return $this->order('sort', 'desc')
//                    ->field('id,name,headimg,intro')
//                    ->select();
        $sql = " select id, name, headimg, intro from coach order by sort desc $limit";
        $res = Db::query($sql);
        return ['data'=>$res, 'page'=>$offset];

    }

    /**
     * 获取筛选教练列表
     * @param where
     * @return array
     */
    public function get_coach_screen($where)
    {
        $param = isset($where['where']) ? $where['where'] : null ;

        try {

            $wherestr1 = ' 1 ';
            //按类型查
            if (isset($param['type'])) {

                //获取复合条件的教练ID
                $coachIds = Db::name('coach_cate_conn')->distinct(true)->field('coach_id')->where('cate_id', 'in', implode(',', $param['type']))->column('coach_id');

                if ($coachIds) {
                    $wherestr1 .= ' and a.id in (' . implode(',', $coachIds) . ') ';
                }

            }

            $wherestr2 = ' 1 ';
            //按区域查
            if (isset($param['district_code'])) {

                //获取复合条件的场馆ID
                $district_codes = Db::name('stadium')->where('district_code', 'in', implode(',', $param['district_code']))->column('id');

                //获取教练ID
                $coachIds2 = Db::name('stadium_coach')->distinct(true)->field('coach_id')->where('stadium_id', 'in', implode(',', $district_codes))->column('coach_id');

                if ($coachIds2) {
                    $wherestr2 .= ' and a.id in (' . implode(',', $coachIds2) . ') ';
                }
            }

            $wherestr3 = ' 1 ';
            //按标签查
            if (isset($param['exper'])) {

                //获取复合条件的教练ID
                $coachIds3 = Db::name('tags_conn')->distinct(true)->field('obj_id')->where('obj_type', 2)->where('tags_id', 'in', implode(',', $param['exper']))->column('obj_id');

                if ($coachIds3) {
                    $wherestr3 .= ' and a.id in (' . implode(',', $coachIds3) . ') ';
                }
            }

            $page = isset($where['page_size']) ? $where['page_size'] : 5;
            $offset = isset($where['page']) ? $where['page'] : 1;
            $limit = "limit ".($offset-1) * $page.",$page";

            $sql = " select a.id, a.name, a.headimg, a.intro
                     from coach a
                     where ($wherestr1) and ($wherestr2) and ($wherestr3)
                     group by a.id
                     order by a.sort $limit";

            $res = Db::query($sql);

//            foreach ($result as $key => $val) {
//                $stadiumIds = Db::name('stadium_coach')->distinct(true)->field('stadium_id')->where('coach_id', $val['id'])->column('stadium_id');
//
//                foreach ($stadiumIds as $key2 => $val2) {
//                    $arr_area[$key2] = Db::name('stadium')->alias('a')
//                        ->join('stadium_coach b', 'a.id = b.stadium_id', 'LEFT')
//                        ->where('a.id', $val2)
//                        ->field('a.id,a.title,a.sort,b.is_default')
//                        ->group('a.id')
//                        ->select();
//
//                }
//
//                $result[$key]['stadium'] = $arr_area; //关联场馆
//            }

            return ['data'=>$res, 'page'=>$offset];

        } catch (\Exception $e) {

            exit(json_encode(array('status' => false, 'msg' => $e->getMessage())));

        }

    }

    /**
     * 获取教练信息
     */
    public function get_coach_info($id)
    {

        //$sql = 'SELECT * FROM coach WHERE id =' . $id;

        //$res = Db::query($sql);

        $res = $this->where('id',$id)->select();

        return $res;
        //die
    }

}
