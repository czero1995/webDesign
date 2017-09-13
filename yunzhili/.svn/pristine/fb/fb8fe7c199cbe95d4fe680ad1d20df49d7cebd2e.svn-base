<?php 
namespace app\common\model;
use think\Model;
use think\Session;
use think\Db;

class Member extends Model
{

	/**
	 * 会员列表
	 */
	public function getList()
    {
        $whereArr = array();
        $wherestr = ' 1 ';
        $offset = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        $page = isset($_REQUEST['pageSize']) ? $_REQUEST['pageSize'] : 10;
        $limit = "limit ".($offset-1) * $page.",$page";
        $sql = "SELECT a.* FROM member a where $wherestr ORDER BY a.id ASC $limit";
        $countSql = "SELECT count(*) as count FROM member a where $wherestr ";
        $data = Db::query($sql,$whereArr);

        foreach ($data as $key => $val)
        {
            $data[$key]['nickname'] = base64_decode($val['nickname']);
        }

        $count = Db::query($countSql,$whereArr);
        $result = array('data'=>$data, 'count'=>$count[0]['count']);
        return $result;
    }


	/**
	 * 会员详情
	 */
	public function getDetail($id){
		$where = [
			'id' => $id,
		];
		$info = $this->where($where)->find();
		$info['nickname'] = base64_decode($info['nickname']);
        return $info;
	}

	/**
     * 根据 openid 获取会员详情
     */
    public function get_user_info($openid)
    {
        return $this->field('id,nickname,mobile,realname,headimg,sex,birthday,tshirt,member_num,remind')->where('openid',$openid)->find();
    }

    public function delmember($id){

        $where=array(
            'id' => $id
            );
    	return $this->where($where)->delete();
    }

    /**
     *会员注册
     */
    public function register($data)
    {
        //获取会员号 起始号码100000

        $member_num = $this->max('member_num');
        if($member_num)
        {
            $member_num = $member_num + 1;
        } else
        {
            $member_num = 100000;
        }
        $dd = [
            'mobile'     =>   $data['mobile'],
            'member_num' =>   $member_num//给定会员号
        ];

        $num = $this->where('openid',$data['openid'])->update($dd);

        if($num)
        {
            return $member_num;
        } else {
            return false;
        }
    }
    /**
     * 完善个人信息
     */
    public function perfectInfo($params)
    {
        $data = [
            'mobile'   => $params['mobile'],
            'realname' => $params['realname'],
            'sex'      => $params['sex'],
            'birthday' => $params['birthday'],
            'tshirt'   => $params['tshirt'],
            'update_time' =>  date('Y-m-d H:i:s')
        ];

        if(empty($params['sex']))
        {
            unset($data['sex']);
        }

        if(empty($params['realname']))
        {
            unset($data['realname']);
        }

        if(empty($params['birthday']))
        {
            unset($data['birthday']);
        }

        if(empty($params['tshirt']))
        {
            unset($data['tshirt']);
        }

        $openid = Session::get('openid');

        return $this->where('openid', $openid)->update($data);

    }

    public function remind()
    {
        $openid = Session::get('openid');

        return $this->where('openid',$openid)->update(['remind'=>2]);
    }
    /**
     * 修改手机号码
     */
//    public function editMobile($mobile)
//    {
//        return $this->where('openid',session('userinfo.openid'))->update(['mobile'=>$mobile]);
//    }
//
//    /**
//     * 修改姓名
//     */
//    public function editRealname($realname)
//    {
//        return $this->where('openid',session('userinfo.openid'))->update(['realname'=>$realname]);
//    }

    /**
     * 修改其他信息
     */
//    public function editOthers($params)
//    {
//        $data = [
//            'mobile'   => $params['mobile'],
//            'realname' => $params['realname'],
//            'sex'      => $params['sex'],
//            'birthday' => $params['birthday'],
//            'tshirt'   => $params['tshirt'],
//            'updata_time' =>  data('Y-m-d H:i:s')
//        ];
//        return $this->where('openid',session('userinfo.openid'))->update($data);
//    }
}

