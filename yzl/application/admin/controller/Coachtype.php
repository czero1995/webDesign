<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Coachtype extends Base
{
    protected $coachService;

    public function __construct()
    {
        parent::__construct();

        $this->coachService = \think\Loader::model('CoachService','service\wechat');

    }

  
    /**
     * 教练分类
     */
    public function  index()
    {
    
        return $this->fetch();
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
    public function add()
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
    public function del()
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
    public function edit()
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

    
}
