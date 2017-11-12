<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
/**
 * 首页模块
 */
class Index extends Base
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        return $this->fetch('stadium/index');
    }


}
