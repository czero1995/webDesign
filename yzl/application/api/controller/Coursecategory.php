<?php
namespace app\api\controller;

class Coursecategory extends Base
{
	protected $courseCateService;

	public function __construct()
    {
        parent::__construct();
        $this->courseCateService = \think\Loader::model('CourseCategoryService', 'service\admin');

    }

    public function getCourseCateList(){
    	$params = array_filter(input('request.'));
        $params['page'] = isset($params['page']) ? $params['page'] : 0;
        $params['page_size'] = $page_size = isset($params['page_size']) ? $params['page_size'] : 10;
        $data = $this->courseCateService->getCourseCateList($params);
        $list = $data['data'];

        $count = $data['count'];
        $show = $this->pageAndSize($count, $page_size); // 分页显示输出
        $data = $this->courseCateService->getCourseCateList();
        $result =array(
            'data' => $data,
            'page' => $show
        );
        if ($result) {
            return $result;
        }
         return result($result, 500, '调用失败');
     
    }

    /**
     * 新增课程类型
     */
    public function addCourseCate(){
        //$data = input('param.');
        $title = input('param.title');
        $data =array(
            'title' => $title,
            'create_time'=>date('Y-m-d H:i:s')
            );

        $res = $this->courseCateService->addCourseCate($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    }

    /**
     * 修改课程类型
     */
    public function editCourseCate(){
        $cate_id = input('param.id');
        $title = input('param.title');
        $data =array(
            'id' => $cate_id,
            'title' => $title,
            'update_time'=>date('Y-m-d H:i:s')
            );

        $res = $this->courseCateService->editCourseCate($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    
    }

    /**
     * 删除课程类型
     */
    public function delCourseCate($id){
        $id = input('param.id');
        $res = $this->courseCateService->delCourseCate($id);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }

    }


}