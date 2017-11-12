<?php
namespace app\common\model;
use think\Model;
use think\Db;

class Stadium extends Base
{
    //自定义初始化
    protected function initialize()
    {
        parent::initialize();
    }

    public $lbsKey = '4JOBZ-RCJRD-22T4R-PZ3XT-S3MW7-BPFV5';
    public $lbsApi = 'http://apis.map.qq.com/ws/geocoder/v1/';
    /**
     * 获取场馆列表
     */
    public function getStadiumList($params){


        $page = isset($params['pageSize']) ? $params['pageSize'] : 10;
        $offset = isset($params['pageNumber']) ? $params['pageNumber'] : 1;
        $limit = "limit ".($offset-1) * $page.",$page";

        $sql = ' SELECT a.id,a.title,a.post,a.province_name,a.city_name,a.address,a.district_name,a.tel,a.sort,a.status,group_concat(c.title) as catename';
        $sql .= ' FROM stadium a LEFT JOIN stadium_cate_conn b ON b.stadium_id = a.id ';
        $sql .= ' LEFT JOIN stadium_category c ON b.cate_id=c.id ';
        $sql .= " WHERE a.id = b.stadium_id group by a.id order by a.id desc $limit";

        $list = Db::query($sql);

        $sql1 = ' SELECT a.id,a.title,a.post,a.province_name,a.city_name,a.address,a.district_name,a.tel,a.sort,a.status,group_concat(c.title) as catename';
        $sql1 .= ' FROM stadium a LEFT JOIN stadium_cate_conn b ON b.stadium_id = a.id ';
        $sql1 .= ' LEFT JOIN stadium_category c ON b.cate_id=c.id ';
        $sql1 .= " WHERE a.id = b.stadium_id group by a.id";

        $list1 = Db::query($sql1);

        return array(
            'total' => count($list1),
            'rows' => $list ? $list : []
        );
    }

    public function addStadium($data)
    {
        try {

            $province = explode('-', $data['province']);
            $city = explode('-', $data['city']);
            $district = explode('-', $data['district']);

            $address = $data['address'];
            $lbsKey = $this->lbsKey;
            $lbsApi = $this->lbsApi;

            $url = $lbsApi.'?address='.$province[1].$city[1].$district[1].trim($address).$data['title'].'&key='.$lbsKey;


            $res = httpRequest($url,'get');
            $res = json_decode($res,true);

            $data['lng'] = $res["result"]['location']['lng'];
            $data['lat'] = $res["result"]['location']['lat'];

            $datas = [
                'title'         =>  $data['title'],
                'intro'         =>  $data['intro'],
                'post'          =>  $data['post'],
                'imgs'          =>  $data['imgs'],
                'province_code' =>  $province[0],
                'city_code'     =>  $city[0],
                'district_code' =>  $district[0],
                'province_name' =>  $province[1],
                'city_name'     =>  $city[1],
                'district_name' =>  $district[1],
                'address'       =>  $data['address'],
                'status'        =>  $data['status'],
                'sort'          =>  $data['sort'],
                'tel'           =>  $data['tel'],
                'wechat'        =>  $data['wechat'],
                'booking_url'   =>  $data['booking_url'],
                'latitude'      =>  $data['lat'],
                'longitude'     =>  $data['lng'],
                'is_recommend'  =>  $data['is_recommend'],
                'create_time'   =>  date('Y-m-d H:i:s'),

            ];

            $id = $this->insertGetId($datas);

            if($id)
            {
                //场馆类型
                Db::name('stadium_cate_conn')->insert(['stadium_id'=>$id,'cate_id'=>$data['cate_id'],'create_time'=>date('Y-m-d H:i:s')]);

                //添加关联课程
                if($data['courseid'])
                {
                    foreach ($data['courseid'] as $key => $val)
                    {
                        Db::name('stadium_course')->insert(['course_id'=>$val,'stadium_id'=>$id,'create_time'=>date('Y-m-d H:i:s')]);
                    }
                }
            }
            return $data;

        } catch (\Exception $e) {
            $this->errorMsg = $e->getMessage();
            //p($msg); die;
            return false;
        }
    }

 

    public function editStadiums($data)
    {
        try{
     //   var_dump($data);die;
            $province = explode('-', $data['province']);
            $city = explode('-', $data['city']);
            $district = explode('-', $data['district']);

            $address = $data['address'];
            $lbsKey = $this->lbsKey;
            $lbsApi = $this->lbsApi;

            $url = $lbsApi.'?address='.$province[1].$city[1].$district[1].trim($address).$data['title'].'&key='.$lbsKey;

            $res = httpRequest($url,'get');

            $res = json_decode($res,true);

            $data['lng'] = $res["result"]['location']['lng'];
            $data['lat'] = $res["result"]['location']['lat'];
            
            $province = explode('-', $data['province']);
            $city = explode('-', $data['city']);
            $district = explode('-', $data['district']);

            $datas = [
                'title'         =>  $data['title'],
                'intro'         =>  $data['intro'],
                'post'          =>  $data['post'],
                'imgs'          =>  $data['imgs'],
                'province_code' =>  $province[0],
                'city_code'     =>  $city[0],
                'district_code' =>  $district[0],
                'province_name' =>  $province[1],
                'city_name'     =>  $city[1],
                'district_name' =>  $district[1],
                'address'       =>  $data['address'],
                'status'        =>  $data['status'],
                'sort'          =>  $data['sort'],
                'tel'           =>  $data['tel'],
                'wechat'        =>  $data['wechat'],
                'booking_url'   =>  $data['booking_url'],
                'latitude'      =>  $data['lat'],
                'longitude'     =>  $data['lng'],
                'is_recommend'  =>  $data['is_recommend'],
                'create_time'   =>  date('Y-m-d H:i:s'),

            ];
            $res = $this->where('id',$data['id'])->update($datas);

            if($res > 0)
            {
                //更新类型
                $cate = [
                    'cate_id'   =>  $data['cate_id'],
                    'create_time'   =>  date('Y-m-d H:i:s')
                ];

                Db::name('stadium_cate_conn')->where('stadium_id',$data['id'])->update($cate);

                //更新关联课程
                if($data['courseid'])
                {
                    //删除原先关联
                    Db::name('stadium_course')->where('stadium_id',$data['id'])->delete();
                    foreach ($data['courseid'] as $key => $val)
                    {
                        Db::name('stadium_course')->insert(['course_id'=>$val,'stadium_id'=>$data['id'],'create_time'=>date('Y-m-d H:i:s')]);
                    }
                }
            }

            return $res;

        } catch (\Exception $e) {
            return false;
        }
    }
    /**
     * 删除场馆
     */
    public function delStadium($id)
    {

        return $this->where($id)->delete();
    }
    /**
     * 批量删除场馆
     * @param string $ids
     */
    public function delStadiums($ids)
    {
//        echo '<pre>';
//        print_r($ids['id']);
//        die;

        $num = $this->where('id','in',$ids['id'])->delete();

        if($num > 0)
        {

            //删除教练类型
            Db::name('stadium_cate_conn')->where('stadium_id','in',$ids['id'])->delete();

            //删除关联课程
            Db::name('stadium_course')->where('stadium_id','in',$ids['id'])->delete();

            return true;

        } else {
            return false;
        }

    }


    public function getAddress($data){
        $province = explode('-', $data['province']);
        $city = explode('-', $data['city']);
        $district = explode('-', $data['district']);

        $data['province_code'] = $province[0];
        $data['city_code'] = $province[0];
        $data['district_code'] = $province[0];

        $data['province_name'] = $province[1];
        $data['city_name'] = $province[1];
        $data['district_name'] = $province[1];

        unset($data['province']);
        unset($data['city']);
        unset($data['district']);

        return $data;
    }

    /**
     * 获取场馆名称
     * @param $stadium_id
     * @return $title 场馆名称
     */
    public function get_stadium_name($stadium_id)
    {
        return $this->where('id',$stadium_id)
            ->field('id,title,district_name,address,tel,latitude,longitude')
            ->select();
    }

    /**
     * 获取推荐场馆列表
     * @param
     * @return array
     */
    public function get_stadium_recommend($params)
    {
        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;

        $res = $this->where('status', 1)->field('id,title,address,post,booking_url,imgs')->order('is_recommend asc, sort desc')->limit(($offset-1) * $page,$page)->select();
        return ['data'=>$res, 'page'=>$offset];
    }

    /**
     * 获取人气场馆列表
     * @param
     * @return array
     */
    public function get_stadium_sort($params)
    {
        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;
        //$limit = "limit ".($offset-1) * $page.",$page";

        //$res = $this->field('id,title,address,post')->order('sort desc')->limit(($offset-1) * $page,$page)->select();
        $res = $this->where('status', 1)->field('id,title,address,post,booking_url,imgs')->order('sort desc, id desc')->limit(($offset-1) * $page,$page)->select();
        return ['data'=>$res, 'page'=>$offset];
    }

    /**
     * 获取筛选场馆列表
     * @param $arr
     * @return array
     */
    public function get_stadium_screen($params)
    {
        $param = $params['where'] ? $params['where'] : null;

        $wherestr1 = '';
        //按类型查
        if($param['type'])
        {
            //获取复合条件的场馆ID
            $stadiumIds = Db::name('stadium_cate_conn')->distinct(true)->field('stadium_id')->where('cate_id','in',implode(',',$param['type']))->column('stadium_id');

            if($stadiumIds)
            {
                $wherestr1 .= 'id in (' . implode(',', $stadiumIds) . ') ' ;
            }

        }

        $wherestr2 = '';
        //按区域查
        if($param['area'])
        {
            $wherestr2 .= 'district_code in (' . implode(',', $param['area']) . ') ' ;
        }

        $page = isset($params['page_size']) ? $params['page_size'] : 5;
        $offset = isset($params['page']) ? $params['page'] : 1;
        //$limit = " limit ".($offset-1) * $page.",$page";


//        $sql = " select id, title, address, post from stadium
//                 where ($wherestr1) and ($wherestr2)
//                 order by sort desc
//                 $limit ";
//        $res = Db::query($sql);


        $res = $this->where('status', 1)
                    ->field('id,title,address,post,booking_url,imgs')
                    ->where($wherestr1)
                    ->where($wherestr2)
                    ->order('sort desc, id desc')
                    ->limit(($offset-1) * $page,$page)
                    ->select();
        return ['data'=>$res, 'page'=>$offset];
    }

    /**
     * 获取场馆详情
     * @param $id 场馆id
     * @return array
     */
    public function get_stadium_info($id)
    {
        //return $this->field('id,title,post,intro,address,tel,wechat')->where('id',$id)->find();
//        $res = $this->alias('a')
//                    ->join('stadium_cate_conn b','a.id = b.stadium_id')
//                    ->join('stadium_category c','b.stadium_id = c.id')
//                    ->where('a.id',$id)
//                    ->field('a.id, a.title')
//                    ->find();

        $res = $this->where('id',$id)->find();

        if($res)
        {
            $res['province'] = $res['province_code'].'-'.$res['province_name'];
            $res['city'] = $res['city_code'].'-'.$res['city_name'];
            $res['area'] = $res['district_code'].'-'.$res['district_name'];

            $res['type_id'] = Db::name('stadium_cate_conn')->alias('a')->join('stadium_category b','a.cate_id = b.id')->where('a.stadium_id',$id)->value('b.id');

        }

     /*  echo '<pre>';
       var_dump($res);
       die;*/

        return $res;
    }

    /**
     * 根据场馆id获取场馆的信息
     */
    public function getStadiumInfo($id){
        $res['cate_id'] = Db::name('stadium')->alias('a')->join('stadium_cate_conn b ON b.stadium_id = a.id')->where('a.stadium_id',$id)->value('b.cate_id'); 
        var_dump($res['cate_id'] );
    }



    public function get_stadium_one($id)
    {
        return $this->field('id,title,tel,district_name,address,wechat,latitude,longitude')->where('id',$id)->find();
    }

    /**
     * 获取区域
     */
    public function get_area_type()
    {
        return $this->field('district_code,district_name')->group('district_code')->order('sort desc')->select();
    }

}
?>
