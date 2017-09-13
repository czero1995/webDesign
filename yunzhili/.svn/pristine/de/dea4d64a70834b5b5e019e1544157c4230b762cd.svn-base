<?php 
namespace app\api\controller\admin;

use think\Controller;

class Upload extends Controller
{


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

    public function uploadImageOne($prefix = 'image/')
    {
        $file_path = $_REQUEST['path'];
        $upload = \Qiniu::instance();
        $info = $upload->uploadOne($file_path, $prefix);
        $error = $upload->getError();
        if(!empty($error)){
            $ret['state'] = $error;
        }else{
            $ret = [
                'state'    => 'SUCCESS',
                'url'      => config('qiniu.domain').$info['key']
            ];
        }
        return json($ret);
    }

    public function uploadImageWechat()
    {
        $serverid = $_REQUEST['serverid'];
        $serverids = explode(',', $serverid);

        $imgnames = array();
        foreach ($serverids as $key => $value) {
            $content = $this->weObj->getMedia($value);
            $rand = time() . rand(1000,9999);
            $new_file = ROOT_PATH . 'public' . DS . 'upload' . DS . 'weixin' . DS . $rand . '.jpg' ;
            if (file_put_contents($new_file, $content)){
                $res = $this->uploadImageWechatOne($new_file);
                $imgnames[] = $res['url'];
            }

        }
        echo json_encode(array('status'=>"SUCCESS",'url'=> $imgnames));
        exit();
    }

    public function uploadImageWechatOne($file_path, $prefix = 'image/', $cate = 1)
    {
        $upload = \Qiniu::instance();
        $info = $upload->uploadOne($file_path, $prefix);
        $error = $upload->getError();
        if(!empty($error)){
            $ret['state'] = $error;
        }else{
            $ret = [
                'state'    => 'SUCCESS',
                'url'      => config('qiniu.domain').$info['key']
            ];
        }
        return $ret;
    }
}


?>