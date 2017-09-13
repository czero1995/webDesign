<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\Request;

class Coach extends Base{
	protected $coachService;
    protected $tagsService;
    protected $coachCategoryService;
	public function __construct()
    {
        parent::__construct();
        $this->coachService = \think\Loader::model('CoachService', 'service\admin');
        $this->tagsService = \think\Loader::model('TagsService', 'service\admin');
        $this->coachCategoryService = \think\Loader::model('CoachCategoryService','service\admin');
    }
    /**
     * 教练列表
     */
    public function getCoachList(){
        $param = Request::instance()->param();
    	$coachList = $this->coachService->getCoachList($param);
    	if ($coachList) {
    		return $coachList;
    	}
    	 return result($coachList, 500, '调用失败');
    }
    
    /**
     * 获取教练类型
     */
    public function getCoachCateList(){
        $coachCate = $this->coachCategoryService->getCoachCateList();
        if ($coachCate) {
            return result($coachCate, 200, '调用成功');
        }
         return result($coachCate, 500, '调用失败');
    }

    /**
     * 标签列表
     */
    public function getTagsList(){
        $tagsList = $this->tagsService->getTagsList();
        if ($tagsList) {
            return result($tagsList, 200, '调用成功');
        }
         return result($tagsList, 500, '调用失败');
    }

    /**
     * 教练详情
     */
    public function getCoachDetail(){

        $coachid = \request()->param('coachid');
        if (!isset($coachid)) {
            exception('参数缺失');
        }
        $CoachDetail = $this->coachService->getCoachDetail($coachid);
        if ($CoachDetail) {
            return result($CoachDetail, 200, '调用成功');
        }
         return result($CoachDetail, 500, '调用失败');
    }

    /**
     * 新增教练
     */
    public function addCoach(){
        $data = input('param.');
   
        $res = $this->coachService->addCoach($data);

        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }
    }

    /**
     * 修改教练
     */
    public function editCoach(){
        $data = input('param.');
     
        $res = $this->coachService->editCoach($data);

        if ($res) {
            return result($res);
        }else{
            return result($res, 500,'调用失败');
        }
    
    }

    /**
     *变更状态
     */
    public function coachStatus()
    {
        $param = \request()->param();

        $res = $this->coachService->coachStatus($param);
        if ($res) {
            return ['status'=>'success'];
        }else{
            return ['status'=>'error','msg'=>'状态变更失败'];
        }
    }

    /**
     * 删除教练
     */
    public function deleteCoach(){
        $coach_id = input('param.id');
        $res = $this->coachService->deleteCoach($coach_id);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }

    }

    /**
     * 批量删除教练
     */
    public function deleteCoachList()
    {
        $ids = input('param.id');
        $res = $this->coachService->deleteCoachList($ids);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    }


}

?>