<?php 
namespace app\admin\controller;
use think\Controller;

class Upload extends Controller{
public function _initialize()
	{
        /*$this->checkLogin();
        $this->getCurRequest();
        $this->getUserPrivileges();*/

        //配置跨域
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Token,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since");
        header('Access-Control-Allow-Methods: GET, POST, PUT');
	}
	

	public function uploadImage($prefix = 'image/', $cate = 1)
	{
		$upload = \Qiniu::instance();
		$info = $upload->upload($prefix);
		$error = $upload->getError();
		if(!empty($error)){
			$ret['state'] = $error;
		}else{
			$ret = [
                'state'    => 'SUCCESS',
                'url'      => config('qiniu.domain').$info[0]['key'],
                'title'    => $info[0]['name'],
                'original' => $info[0]['name'],
                'type'     => $info[0]['type'],
                'size'     => $info[0]['size'],
            ];
		}
		return json($ret);
	}


}


 ?>