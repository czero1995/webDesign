<?php
namespace app\api\controller;
use think\Controller;

class CoachCategory extends Base{
	protected $coachCategoryService;

	public function __construct()
    {
        parent::__construct();
        $this->coachCategoryService = \think\Loader::model('CoachCategoryService', 'service\admin');

    }

    public function getCoachCateList(){
        $params = request()->param();
    	$coachCate = $this->coachCategoryService->getCoachCateList($params);
    	
    		return $coachCate;
    
    }

    
    /**
     * 新增教练类型
     */
    public function addCoachCate(){
        $title = input('param.title');
        $sort = input('param.sort');

        $data =array(
            'title' => $title,
            'sort' => $sort,
            'create_time'=>date('Y-m-d H:i:s')
            );
      
        $res = $this->coachCategoryService->addCoachCate($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    }

    /**
     * 修改教练类型
     */
    public function editCoachCate(){
        $cate_id = input('param.id');
        $title = input('param.title');
        $data =array(
            'id' => $cate_id,
            'title' => $title,
            'update_time'=>date('Y-m-d H:i:s')
            );

        $res = $this->coachCategoryService->editCoachCate($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    
    }

    /**
     * 删除教练类型
     */
    public function del($id){

        $res = $this->coachCategoryService->del($id);

        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }

    }

    
}

?>