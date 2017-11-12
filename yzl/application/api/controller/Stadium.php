<?php

namespace app\api\controller;

use think\Controller;
use think\Db;

class Stadium extends Base
{

    protected $stadiumService;
    protected $lack = [];

    public function __construct()
    {
        parent::__construct();
        $this->stadiumService = \think\Loader::model('StadiumService', 'service\admin');

    }

    /**
     * 场馆列表
     */
    public function getStadiumList()
    {
        $stadium = $this->stadiumService->getStadiumList(request()->param());

        if ($stadium) {
            return $stadium;
        } else {
            return result($stadium, 500, '调用失败');
        }

    }

    /**
     * 新增场馆
     */
    public function addStadium()
    {

        $title = input('param.title');
        $intro = input('param.intro');
        $post = input('param.post');
        $imgs = input('param.imgs');
        $province = input('param.province');
        $city = input('param.city');
        $district = input('param.district');
        $tel = input('param.tel');
        $sort = input('param.sort');
        $wechat = input('param.wechat');
        $status = input('param.status');
        $cate_id = input('param.cate_id');
        $address = input('param.address');
        $booking_url = input('param.booking_url');
        $is_recommend = input('param.is_recommend');
        $courseid = input('param.courseid/a');

        if (empty($title)) {
            $this->lack[] = 'title';
        }

        if (empty($intro)) {
            $this->lack[] = 'intro';
        }

        if (empty($wechat)) {
            $this->lack[] = 'wechat';
        }

        if (empty($booking_url)) {
            $this->lack[] = 'booking_url';
        }

        if (empty($post)) {
            $this->lack[] = 'post';
        }

        if (empty($imgs)) {
            $this->lack[] = 'imgs';
        }

        if (empty($province)) {
            $this->lack[] = 'province';
        }

        if (empty($city)) {
            $this->lack[] = 'city';
        }

        if (empty($district)) {
            $this->lack[] = 'district';
        }

        if (empty($address)) {
            $this->lack[] = 'address';
        }

        if (empty($status)) {
            $this->lack[] = 'status';
        }

        if (empty($sort)) {
            $this->lack[] = 'sort';
        }

        if (empty($tel)) {
            $this->lack[] = 'tel';
        }

        if (empty($cate_id)) {
            $this->lack[] = 'cate_id';
        }

        if (empty($courseid)) {
            $this->lack[] = 'courseid';
        }

        if (sizeof($this->lack) > 0) {
            return result(false, 4007, '信息不完整');
        } else {
            $datas = [
                'title'        => $title,
                'intro'        => $intro,
                'post'         => $post,
                'imgs'         => $imgs,
                'province'     => $province,
                'city'         => $city,
                'district'     => $district,
                'address'      => $address,
                'tel'          => $tel,
                'sort'         => $sort,
                'status'       => $status,
                'wechat'       => $wechat,
                'booking_url'  => $booking_url,
                'is_recommend' => $is_recommend,
                'cate_id'      => $cate_id,
                'courseid'     => $courseid

            ];
            $result = $this->stadiumService->addStadium($datas);

            if ($result) {
                return result($result);
            } else {
                return result($result, 500, '调用失败');
            }
        }
        //
//        $res = $this->stadiumService->addStadium($data);
//        if ($res) {
//            return result($res);
//        }else{
//            return result($res, 500,'调用失败');
//        }

    }

    /**
     * 修改场馆
     */
    public function editStadium()
    {
        $data = input('param.');

        $res = $this->stadiumService->editStadium($data);
        if ($res) {
            return result($res);
        } else {
            return result($res, 500, '调用失败');
        }

    }

    /**
     * 删除场馆
     */
    public function delStadium()
    {
        $id = request()->param();
        $res = $this->stadiumService->delStadium($id);
        if ($res) {
            return result($res);
        } else {
            return result($res, 500, '调用失败');
        }

    }

    /**
     * 场馆详情
     */
    public function detailStadium()
    {
        $id = request()->param('id');
        $stadium = new \app\common\service\wechat\StadiumService();
        $res = $stadium->get_stadium_info($id);

        if ($res) {
            return result($res);
        } else {
            return result($res, 500, '调用失败');
        }
    }
}

?>