<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Base
{
    public function index()
    {
        $this->redirect('member/index');
    }
}
