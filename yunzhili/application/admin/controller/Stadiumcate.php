<?php
namespace  app\admin\controller;

use think\Controller;
use think\Db;

/**
* 
*/
class Stadiumcate extends Base
{
	
	public function index(){
	    return $this->fetch();
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
    public function add()
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
    public function del()
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
    public function edit()
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

}

?>