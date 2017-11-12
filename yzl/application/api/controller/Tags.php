<?php
namespace app\api\controller;
use think\Controller;

/**
* 
*/
class Tags extends Base{
	protected $tagsService;
	function __construct()
	{
		parent::__construct();
		$this->tagsService = \Think\Loader::model('TagsService', 'service\admin');
	}

	/**
	 * 获取技能标签
	 */
	public function getTagsList(){
        $params = array_filter(input('request.'));
        $params['page'] = isset($params['page']) ? $params['page'] : 0;
        $params['page_size'] = $page_size = isset($params['page_size']) ? $params['page_size'] : 10;
        $data = $this->tagsService->getTagsList($params);
        $list = $data['data'];

        $count = $data['count'];
        $show = $this->pageAndSize($count, $page_size); // 分页显示输出
        $data = $this->tagsService->getTagsList();
        $result =array(
            'data' => $data,
            'page' => $show
        );
        if ($result) {
            return $result;
        }
         return result($result, 500, '调用失败');
    }

    public function get_list(){
        $id = request()->param();
        return $this->tagsService->get_list($id);
    }
     /**
     * 新增技能标签
     */
    public function addTags(){
        $type = input('param.type');
        $name = input('param.name');
        $status = input('param.status');
        $data = array(
            'type' => $type,
            'name' => $name,
            'status' => $status,
            'create_time' => date('Y-m-d H:i:s'),
            );

        $res = $this->tagsService->addTags($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    }

    /**
     * 修改技能标签
     */
    public function editTags(){
        $tags_id = input('param.id');
        $type = input('param.type');
        $name = input('param.name');
        $status = input('param.status');
        $data = array(
            'id' => $tags_id,
            'type' => $type,
            'name' => $name,
            'status' => $status,
            'update_time' => date('Y-m-d H:i:s'),
            );

        $res = $this->tagsService->editTags($data);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }
    
    }

    /**
     * 删除技能标签
     */
    public function delTags($id){
        $res = $this->tagsService->delTags($id);
        if ($res) {
            return result($res, 200,'调用成功');
        }else{
            return result($res, 500,'调用失败');
        }

    }

}

?>