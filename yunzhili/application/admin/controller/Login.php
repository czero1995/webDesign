<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Login extends Controller
{

    public function index()
    {
        return $this->fetch();
    }

    public function logout()
    {
        cookie(null, 'integral_');
        session(null, 'integral_');
       // $this->error('您尚未登录系统!',url('admin/login/index'));
        $this->redirect('admin/login/index');
    }

    public function verify()
    {
        if(request()->isPost()){
            $inputData = input('post.');
            $accountName = $inputData['username'];
            $password = $inputData['password'];
            if(!empty($accountName) && !empty($password)){
                $arr = array('account'=>$accountName, 'password'=>$password, 'status'=>1);
                $isExist = Db::name('account')->where($arr)->find();
                if($isExist){
                    cookie('account_id', $isExist['id'], 3600);
                    cookie('account_name', $isExist['account'], 3600);
                    session('account_id', $isExist['id']);
                    session('account_name', $isExist['account']);

                    Db::name("account")->where(array('id'=>$isExist['id']))->update(array('last_login'=>date("Y-m-d H:i:s"),'last_ip'=>getIP()));

                    exit(json_encode(array('status'=>1,'url'=>url('admin/index/index'))));
                }else{
                    exit(json_encode(array('status'=>0,'msg'=>'账号密码不正确')));
                }
            }else{
                exit(json_encode(array('status'=>0,'msg'=>'请填写账号密码')));
            }
        }
    }
    
}