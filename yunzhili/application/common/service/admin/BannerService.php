<?php
namespace app\common\service\admin;
use think\Model;

/**
* 
*/
class BannerService extends Model
{
	protected $bannerModel;
	public function __construct()
	{
		$this->bannerModel = \think\Loader::model('Banner','model');
	}

	/**
	 * banner列表
	 */
	public function getBannerList(){
		return $this->bannerModel->getBannerList();
	}

	/**
	 * 新增banner图
	 */
	public function addBanner($data){
		

		return  $this->bannerModel->addBanner($data);

	}

	/**
	 * 修改Banner图
	 */
	public function editBanner($data){
		try{

		return $this->bannerModel->editBanner($data);

			
		} catch (\Exception $e) {
           
            $this->errorMsg = $e->getMessage();
        }
		
	}


	/**
	 * 删除Banner图
	 */
	public function deleteBanner($id)
	{
		return $this->bannerModel->deleteBanner($id);
	}

	/**
     * 获取分类banner
     * @param type
     * @return array
     */
    public function get_banner_list($type)
    {
        return $this->bannerModel->get_banner_list($type);
	}
}

?>