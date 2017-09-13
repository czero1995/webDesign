<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Base
{
    public function index()
    {
    	 $data = [
            'sidename'   =>  '首页',
            'active'     =>  '1',
        ];

        $this->assign('active', $data['active']);
        $this->assign('sidename', $data['sidename']);

        return $this->fetch();
    }
}
