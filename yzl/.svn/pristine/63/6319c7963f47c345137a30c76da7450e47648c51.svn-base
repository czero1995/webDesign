<?php
namespace app\api\controller;
use think\Controller;
use think\Request;

//use app\common\model\Users;

class Index extends Controller
{
    protected $accountService;
    protected $memberService;
    

    public function __construct()
    {
        parent::__construct();
        //$this->userService = new Users();
        $this->accountService = \think\Loader::model('AccountService', 'service');
        $this->memberService = \think\Loader::model('MemberService', 'service');
        $this->tagsService = \think\Loader::model('TagsService', 'service\admin');
    }


    public function index()
    {
        echo 'hello,api!';
    }

    public function get_member_list()
    {
        $member_list = $this->memberService->get_list();
        if ($member_list) {
            return result($member_list, 200, '调用成功');
        }
         return result($member_list, 500, '调用失败');
    }

    public function getTagsList()
    {
        $tags = $this->tagsService->getTagsList();
        if ($tags) {
            return result($tags, 200, '调用成功');
        }
         return result($tags, 500, '调用失败');
    }

    public function getDetail(){
        $id = input('param.id');
        $data = $this->memberService->getDetail($id);
        if ($data) {
            return result($data, 200, '调用成功');
        }
         return result($data, 500, '调用失败');
    } 
 
}
