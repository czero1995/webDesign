<?php 
namespace app\api\controller;
use think\Controller;
use app\common\model\Module AS ModuleModel;
use think\Db;
use think\Page;
use think\Request;

class Base extends Controller{
	public $model;
    public $userId;
	public $loginUser;
    public $errorMsg;
    public $curModule;
    public $curController;
    public $curAction;
    public $curModuleId;
    
	public function _initialize()
	{
       /* $this->checkLogin();*/
       /* $this->getCurRequest();
        $this->getUserPrivileges();*/

        //配置跨域
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Token,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since");
        header('Access-Control-Allow-Methods: GET, POST, PUT');
	}
	
	/**
     * 检查是否登录
     */
    public function checkLogin()
    {
    	$sessionId = cookie('yunzhili_account_id');
    	$sessionAccount = cookie('yunzhili_account_name');
        if(!empty($sessionId) || !empty($sessionAccount)){
        	$arr = array('id'=>$sessionId, 'account'=>$sessionAccount);
    		$isExist = Db::name("Account")->where($arr)->find();
            if(empty($isExist)){
                $this->error('您登录失败!',url('admin/login/index'));
            }
            $this->loginUser = $isExist['account'];
            $this->userId = $isExist['id'];
            cookie('yunzhili_account_id', $isExist['id'], 3600);
            cookie('yunzhili_account_name', $isExist['account'], 3600);
            session('yunzhili_account_id', $isExist['id']);
            session('yunzhili_account_name', $isExist['account']);

            /*$roleId = Db::name("userRole")->where(array('user_id'=>$isExist['id']))->value('role_id');
            if($roleId){

            }
            $roleName = Db::name("role")->where(array('id'=>$roleId))->value('role');

            $this->assign('curUser', $this->loginUser);
            $this->assign('loginUserCreateTime', $isExist['create_time']);
            $this->assign('roleName', $roleName);*/
        }else{
            /*$this->error('您尚未登录系统!',url('admin/login/index'));*/
             $this->redirect('admin/login/index');
        }
    }

         /**
     * 设置分页
     * @param int $total_num 总数量
     * @param int $page_size 每页数量
     * @param int $mode 分页显示风格
     */
    public function pageAndSize($total_num, $page_size = 30, $action='', $mode=1)
    {
        $filter = array();
        $filter['record_count'] = $total_num;
        $filter['page_size'] = $page_size ;

        $filter['page'] = (empty($_REQUEST['page']) || intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

        $filter['page_count'] = (!empty($filter['record_count']) && $filter['record_count'] > 0) ? ceil($filter['record_count'] / $filter['page_size']) : 1;
        if ($filter['page'] > $filter['page_count'])
        {
            $filter['page'] = $filter['page_count'];
        }

        $pagestr = '';
        if($action!=''){
            $data= array(
                    'total'=>$filter['record_count'],
                    'perpage'=>$filter['page_size'],
                    'ajax'=>$action
                    );
        }else{
            $data= array(
                    'total'=>$filter['record_count'],
                    'perpage'=>$filter['page_size']
            );
        }

        if( $filter['record_count'] > 0 )
        {
            import('Page.Page', EXTEND_PATH, '.php');
            $page = new \Page($data);
            $pagestr = $page->show($mode);
        }

        return $pagestr;
    }



}


 ?>