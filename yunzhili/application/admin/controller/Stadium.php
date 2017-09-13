<?php
namespace  app\admin\controller;

use think\Controller;
use think\Db;

class Stadium extends Base
{
    protected $stadiumService;

    public function __construct()
    {
        parent::__construct();

        $this->stadiumService = \think\Loader::model('stadiumService','service\wechat');

    }
    /**
     * 场馆列表
     */
    public function index()
    {

        return $this->fetch();
    }

    /**
     *新增场馆 view
     */
    public function add()
    {
        //获取场馆类型
        $type = Db::name('stadium_category')->field('id,title')->select();

        //获取课程
        $course = Db::name('course')->field('id,title')->select();

        $data = [
            'stadium_type' =>  $type,
            'course'     => $course
        ];
        $this->assign('stadium_type', $data['stadium_type']);
        $this->assign('course', $data['course']);
        return $this->fetch();
    }

    /**
     * @return view
     */
    public function detail()
    {
        $id = request()->param('id');

        $this->assign('id', $id);
        return $this->fetch('detail');
    }

    /**
     * @return view
     */
    public function edit($id)
    {
        //获取场馆类型
        $type = Db::name('stadium_category')->field('id,title')->select();

        //获取课程
        $course = Db::name('course')->field('id,title')->select();

        $info = Db::name('stadium')->alias('a')
                    ->join('stadium_cate_conn b','a.id = b.stadium_id')
                    ->join('stadium_category c','b.cate_id = c.id')
                    ->where('a.id',$id)
                    ->field('a.*,b.cate_id,c.title as name')
                    ->find();
        $info['courseid'] = Db::name('stadium_course')->where('stadium_id',$id)->column('course_id'); 


        $this->assign('stadium_type',$type);
     
        $this->assign('data',$info);
        $this->assign('course', $course);
        return $this->fetch();
    }

    /**
     *
     */
    public function editStadium()
    {
        $id = request()->param('id');
        //$stadium = new \app\common\service\wechat\StadiumService();
        $res = $this->stadiumService->get_stadium_info($id);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    /**
     * 场馆类型页面
     */
    public function stadiumType()
    {
   
        return $this->fetch('stadium/type');
    }

    /**
     * @return array
     */
    public function getStadiumTypeList()
    {
        $params = request()->param();
        $cate = new \app\common\service\admin\StadiumCategoryService();
        $res = $cate->getStadiumTypeList($params);

        if($res)
        {
            return $res;
        } else {
            return result($res,500,'调用失败');
        }

    }

    /**
     * 新增分类
     * @return array
     */
    public function addStadiumCate()
    {
        $params = request()->param();
        $cate = new \app\common\service\admin\StadiumCategoryService();
        $res = $cate->addStadiumCate($params);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    /**
     * 删除分类
     */
    public function delStadiumType()
    {
        $ids = request()->param();
        $cate = new \app\common\service\admin\StadiumCategoryService();
        $res = $cate->delStadiumType($ids);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    /**
     * 获取分类信息
     */
    public function getStadiumTypeInfo()
    {
        $id = request()->param();
        $cate = new \app\common\service\admin\StadiumCategoryService();
        $res = $cate->getStadiumTypeInfo($id);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    /**
     * 修改分类信息
     */
    public function editStadiumType()
    {
        $data = request()->param();
        $cate = new \app\common\service\admin\StadiumCategoryService();
        $res = $cate->editStadiumType($data);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }


    /**
     * 场馆详情
     */
    public function getStadiumInfo()
    {
        $param = request()->param();
        $info = $this->coachService->get_stadium_info($param['id']);
        if($param['type'] == 1)
        {
            return view('stadium/detail',['info'=>$info,'sidename'=>'场馆','active'=>'3',]);

        } else {

            return json($info[0]);

        }

    }

}