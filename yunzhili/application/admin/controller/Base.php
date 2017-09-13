<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Module AS ModuleModel;
use think\Db;
use think\Page;
use think\Request;

class Base extends Controller
{
    public $model;
    public $userId;
    public $roleId;
    public $loginUser;
    public $errorMsg;
    public $curModule;
    public $curController;
    public $curAction;
    public $curModuleId;
    public $memberId;

    public function _initialize()
    {
        $this->checkLogin();
        $this->getCurRequest();
        $this->getUserPrivileges();

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
        $sessionId = cookie('account_id');
        $sessionAccount = cookie('account_name');
        if(!empty($sessionId) || !empty($sessionAccount)){
            $arr = array('id'=>$sessionId, 'account'=>$sessionAccount);
            $isExist = Db::name("account")->where($arr)->find();
            if(empty($isExist)){
                $this->error('您登录失败!',url('admin/login/index'));
            }
            $this->loginUser = $isExist['account'];
            $this->userId = $isExist['id'];
            cookie('account_id', $isExist['id'], 3600);
            cookie('account_name', $isExist['account'], 3600);
            session('account_id', $isExist['id']);
            session('account_name', $isExist['account']);
            
            $roleId = Db::name("userRole")->where(array('user_id'=>$isExist['id']))->value('role_id');

            if($roleId){
                $this->roleId = $roleId;
                $roleName = Db::name("role")->where(array('id'=>$roleId))->value('role');

                $this->assign('curUser', $this->loginUser);
                $this->assign('loginUserCreateTime', $isExist['create_time']);
                $this->assign('roleName', $roleName);
            }

        }else{
            /*$this->error('您尚未登录系统!',url('admin/login/index'));*/
             $this->redirect('admin/login/index');
        }
    }

    /**
     * 获取用户的模块权限
     */
     public function getUserPrivileges()
    {
        $privilegesModules = $moduleNames = array();
        $roles = Db::name("userRole")->where('user_id', $this->userId)->column('role_id');
        if($roles){
            $module_ids = Db::name("roleModule")->where("role_id", 'in', $roles)->column('module_id');
          
            if($module_ids){
                // 检查用户是否有当前请求链接的权限
                if(!in_array($this->curModuleId, $module_ids)){
                    
                    if(request()->isAjax()){
                        exit(json_encode(array('status'=>false,'msg'=>'您尚未开通该访问权限，请找管理员!')));
                    }
                    
                    $this->error('您尚未开通该访问权限，请找管理员!');
                }
                $where = array(
                        'id'=>array('in', $module_ids), 
                        'if_display'=>'1',
                    ); 
                $privilegesModules = Db::name("t_module")->field('id,module_name,module,controller,action,parent_id')->where($where)->order('parent_id,sort_order', 'ASC')->select();

                $moduleNames = array_column($privilegesModules, 'module_name', 'id');

                $privilegesModules = $this->setSidebarMenu($privilegesModules);
            }
            $this->assign('privilegesModules',$privilegesModules);
            $this->assign('moduleNames',$moduleNames);
        }else{
            if(request()->isAjax()){
                 
                exit(json_encode(array('status'=>false,'msg'=>'您尚未开通该访问权限，请找管理员!')));
            }
                  
            $this->error('您尚未分配角色，请找管理员!');
        }
    }

    /**
     * 设置左侧菜单数据格式
     * @param array $data 用户权限的模块
     */
    public function setSidebarMenu($data)
    {
        $new = array();
        foreach($data as $val){
            if($val['parent_id'] != 0){
                $new[$val['parent_id']][] = $val;
            }
        }
        return $new;
    }


    /**
     * 获取当前请求的公用信息
     */
    public function getCurRequest()
    {
        $request = Request::instance();
        $this->curModule = $request->module();
        $this->curController = $request->controller();
        $this->curAction = $request->action();
        $where = array(
                'module'=>$this->curModule,
                'controller'=>$this->curController,
                'action'=>$this->curAction
            );
        $curModule = Db::name("t_module")->where($where)->find();
        $parent_id = $curModule['parent_id'];
        $this->curModuleId = $curModule['id'];
        $path = array_filter(explode(',', $curModule['path']));
        $module_names = Db::name("t_module")->where("id", 'in', $path)->column('module_name');

        $this->assign('module_names', $module_names);
        $this->assign('module_nums', count($module_names)-1);
        $this->assign('module_parent_id', $parent_id);
        $this->assign('curModule', $this->curModule);
        $this->assign('curController', $this->curController);
        $this->assign('curAction', $this->curAction);
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