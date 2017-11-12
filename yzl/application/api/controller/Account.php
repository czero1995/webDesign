<?php
namespace app\api\controller;
use think\Controller;

class Account extends Base{
	
	protected $accountService;

    public function __construct()
    {
        parent::__construct();
        $this->accountService = \think\Loader::model('AccountService', 'service\admin');

    }


	public function getAccountList(){

        $accountList = $this->accountService->getAccountList();

        if ($accountList) {

            return result($accountList);
        }
            return result($accountList, 500, '调用失败');
    }

    /**
     * 用户登录 
     */
    public function login(){

		$account = input('param.account');

		$password = input('param.password');

        $res = $this->accountService->login($account,$password);
        if ($res) {
            return result($res, 200, '登录成功');
        }
            return result($res, 500, '登录失败');
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        $this->accountService->logout(getMebid());
        return result( '退出成功');
    }


    public function add(){
        
        $data = input('param.');
        var_dump($data);
        $result = $this->accountService->addAccount($data);
        if ($result) {

            return result($result);
        }
            return result($result, 500, '调用失败');

    } 
    
    public function editAccount(){
        $data = input('param.');

        $result = $this->accountService->editAccount($data);
 
        if ($result) {

            return result($result);
        }
            return result($result, 500, '调用失败');
    }

    public function del(){
        $id = input('param.id');
        $res = $this->accountService->del($id);
        if ($res) {
            return result($res);
        }else{
            return result($result, 500, '调用失败');
        }
    }
}

?>