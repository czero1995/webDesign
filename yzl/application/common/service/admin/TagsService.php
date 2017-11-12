<?php
namespace app\common\service\admin;
use think\Model;

/**
 * 
 */
class TagsService extends Model{

	protected $tagsModel;	

	function __construct(){
		$this->tagsModel = \think\Loader::model('Tags','model');
	}

	/**
	 * 技能标签列表
	 */
	public function getTagsList(){
		return $this->tagsModel->getTagsList();
	}

    public function getTagsInfo($id){
        return $this->tagsModel->getTagsInfo($id);
    }
	 /**
     * 新增标签
     */
	public function addTags($data)
    {
       try{

		return $this->tagsModel->addTags($data);
		} catch (\Exception $e) {
           
            $this->errorMsg = $e->getMessage();
        }

    }

     /**
     * 修改标签
     */
    public function editTags($data){

    	try{

		    return $this->tagsModel->editTags($data);
			
		} catch (\Exception $e) {
           
            $this->errorMsg = $e->getMessage();
        }
    	
    }

    /**
     * 删除标签
     */
    public function delTags($id) {

    	return $this->tagsModel->delTags($id);
    }
}
?>