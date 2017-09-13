<?php
namespace app\admin\controller;
use app\common\model\Member AS MemberModel;
use app\common\service\WechatService;
use think\Controller;
use think\Db;

class Member extends Base{
	
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new MemberModel();
    }
    /**
     * banner列表
     */
    public function index(){
        $params = array_filter(input('request.'));
        $params['page'] = isset($params['page']) ? $params['page'] : 0;
        $params['page_size'] = $page_size = isset($params['page_size']) ? $params['page_size'] : 10;

        $data = $this->model->getList($params);
        $list = $data['data'];

        $count = $data['count'];
        $show = $this->pageAndSize($count, $page_size); // 分页显示输出
        $this->assign('page', $show);  // 赋值分页输出
        $this->assign('params',$params);
        $this->assign('list',$list);
        $memberSex = config('membersex');
        $this->assign('memberSex',$memberSex);
        return $this->fetch();
    }
    public function detail(){
        
        $id = request()->param('id');

        $this->assign('id', $id);
        return $this->fetch();
    }


}