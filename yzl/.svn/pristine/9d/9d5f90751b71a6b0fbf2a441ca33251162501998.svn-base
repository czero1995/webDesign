<?php
namespace app\api\controller;
use think\Controller;


class Member extends Base
{
	protected $memberService;
	function __construct(){
		parent::__construct();
		$this->memberService = \think\Loader::model('MemberService','service\admin');
	}

	public function getMemberList()
    {
        $memberList = $this->memberService->getList();
      
        if ($memberList) {
            return $memberList;
        }
         return result($memberList, 500, '调用失败');
    }

    public function getDetail(){
        $id = input('param.id');
        $data = $this->memberService->getDetail($id);
        if ($data) {
            return result($data, 200, '调用成功');
        }
         return result($data, 500, '调用失败');
    } 
    public function delmember(){
        $id = input('param.id');
  
        $res = $this->memberService->delmember($id);
        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }

    }
}

?>