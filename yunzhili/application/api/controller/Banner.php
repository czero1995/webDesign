<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
class Banner extends Base{

	protected $bannerService;

	public function __construct()
    {
        parent::__construct();
        $this->bannerService = \think\Loader::model('BannerService', 'service\admin');

    }
	public function getBannerList(){
        $params = array_filter(input('request.'));
        $params['page'] = isset($params['page']) ? $params['page'] : 0;
        $params['page_size'] = $page_size = isset($params['page_size']) ? $params['page_size'] : 10;

        $data = $this->bannerService->getBannerList($params);
        $list = $data['data'];

        $count = $data['count'];
        $show = $this->pageAndSize($count, $page_size); // 分页显示输出
 
	 	$data = $this->bannerService->getBannerList();

        $result =array(
                'data' => $data,
                'page' => $show
            );

	 	if ($result) {
	 		return $result;
	 	}else{
	 		return result($data, 500,'调用失败');
	 	}
	 	
	}


	public function addBanner(){
        $data  =input('param.');
    
		$res = $this->bannerService->addBanner($data);

		if ($res) {
			return result($res, 200,'调用成功');
		}else{
			return result($res, 500,'调用失败');
		}
	
	}

	public function editBanner(){
		  
        $data  =input('param.');
       
		$res = $this->bannerService->editBanner($data);

		if ($res) {
			return result($res);
		}else{
			return result($res, 500,'调用失败');
		}
	
	}

	public function deleteBanner(){
		$id = input('param.id');
		$res = $this->bannerService->deleteBanner($id);
		if ($res) {
			return result($res, 200,'调用成功');
		}else{
			return result($res, 500,'调用失败');
		}

	}
}


?>