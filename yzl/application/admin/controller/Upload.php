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

    public function uploadImages($prefix = 'image/')
    {
        $upload = \Qiniu::instance();
        $info = $upload->upload($prefix);
        $error = $upload->getError();
        if(!empty($error)){
            $ret['state'] = $error;
        } else {
            if (count($info) < 2) {
                $url[] = config('qiniu.domain').$info[0]['key'];
            } else {
                foreach ($info as $key => $val) {
                    $url[] = config('qiniu.domain').$val[0]['key'];
                }
            }

        }
        $imgs = implode(',', $url);
        $ret = [
            'errno' => 0,
            // data 是一个数组，返回若干图片的线上地址
            'data' => $imgs
        ];

        return json($ret);
    }

}


 ?>