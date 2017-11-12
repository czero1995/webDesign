<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Admin extends Base
{
    protected $coachService;

    public function __construct()
    {
        parent::__construct();

        $this->coachService = \think\Loader::model('CoachService','service\wechat');

    }

    /**
     * 后台首页
     */
    public function index()
    {
        $data = [
            'sidename'   =>  '首页',
            'active'     =>  '1'
        ];
      
        $this->assign('sidename',$data['sidename']);
        $this->assign('active',$data['active']);
        return $this->fetch();
    }

    /**
     * 教练列表
     */
    public function coach()
    {
        //获取教练标签
        $tags = Db::name('tags')->where('type',2)->field('id,name')->select();

        //获取教练类型
        $type = Db::name('coach_category')->field('id,title')->select();

        //获取场馆
        $staduim = Db::name('stadium')->field('id,title')->select();

        //获取课程
        $course = Db::name('course')->field('id,title')->select();

        $data = [
            'sidename'   =>  '教练',
            'active'     =>  '2',
            'coach_type' =>  $type,
            'stadium'    =>  $staduim,
            'course'     =>  $course,
            'tags'       =>  $tags
        ];

        $this->assign('sidename',$data['sidename']);
        $this->assign('active',$data['active']);
        $this->assign('coach_type',$data['coach_type']);
        $this->assign('stadium',$data['stadium']);
        $this->assign('course',$data['course']);
        $this->assign('tags',$data['tags']);
        return $this->fetch();
    }

    /**
     * 教练详情
     */
    public function getCoachInfo()
    {
        $param = request()->param();
        $info = $this->coachService->get_coach_info($param['id']);


        if($param['type'] == 1)
        {
            return view('admin/coachinfo',['info'=>$info,'sidename'=>'教练','active'=>'2',]);

        } else {

            return json($info[0]);

        }

    }
    /**
     * 教练分类
     */
    public function coachType()
    {
        $data = [
            'sidename'   =>  '教练类型',
            'active'     =>  '2',
        ];
        return view('admin/coachtype',$data);
    }

    public function getCoachType()
    {
        $params = request()->param();
        $cate = new \app\common\service\admin\CoachCategoryService();
        $res = $cate->getCoachCateList($params);

        if($res)
        {
            return $res;
        } else {
            return result($res,500,'调用失败');
        }

    }

    /**
     * 添加教练分类
     */
    public function addCoachType()
    {
        $types = request()->param();
        $cate = new \app\common\service\admin\CoachCategoryService();
        $res = $cate->addCoachCate($types);

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
    public function delCoachType()
    {
        $ids = request()->param();
        $cate = new \app\common\service\admin\CoachCategoryService();
        $res = $cate->delCoachType($ids);

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
    public function getCoachTypeInfo()
    {
        $id = request()->param();
        $cate = new \app\common\service\admin\CoachCategoryService();
        $res = $cate->getCoachTypeInfo($id);

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
    public function editCoachType()
    {
        $data = request()->param();
        $cate = new \app\common\service\admin\CoachCategoryService();
        $res = $cate->editCoachType($data);

        if($res)
        {
            return result($res);
        } else {
            return result($res,500,'调用失败');
        }
    }

    public function coachadd(){
         $data = [
            'sidename'   =>  '新增教练',
            'active'     =>  '2',
        ];
        $coachcate = Db::name('coach_category')->field('id,title')->select();
        $tags = Db::name('tags')->field('id,name')->select();
        $course = Db::name('course')->field('id,title')->select();
        $stadium = Db::name('stadium')->field('id,title')->select();
        $this->assign(array(
            'coachcate' => $coachcate,
            'tags' => $tags,
            'course' => $course,
            'stadium' => $stadium,
            ));
        $this->assign('active', $data['active']);
        $this->assign('sidename', $data['sidename']);
        return $this->fetch();
    }
    public function coachedit($id){
         $data = [
            'sidename'   =>  '修改教练',
            'active'     =>  '2',
        ];

        $info = Db::name('coach')->alias('a')
                ->join('coach_cate_conn b','a.id = b.coach_id')
                ->join('coach_category c','b.cate_id = c.id')
                ->where('a.id',$id)
                ->field('a.*,b.cate_id,c.title')
                ->find();
        $info['courseid'] = Db::name('coach_course')->where('coach_id',$id)->column('course_id'); 
        $info['stadiumid'] = Db::name('stadium_coach')->where('coach_id',$id)->column('stadium_id'); 

        $where = [
            'obj_type'=>2,
            'obj_id'  => $id,
        ];
        $info['tagsid'] = Db::name('tags_conn')->where($where)->column('tags_id');

        $coachcate = Db::name('coach_category')->field('id,title')->select();
        $tags = Db::name('tags')->field('id,name')->select();
        $course = Db::name('course')->field('id,title')->select();
        $stadium = Db::name('stadium')->field('id,title')->select();
        $this->assign(array(
            'coachcate' => $coachcate,
            'tags' => $tags,
            'course' => $course,
            'stadium' => $stadium,
            'data' => $info
            ));
        $this->assign('active', $data['active']);
        $this->assign('sidename', $data['sidename']);
        return $this->fetch();
    }
}
