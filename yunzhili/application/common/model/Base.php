<?php
namespace app\common\model;
use think\Model;
use think\Db;

class Base extends Model
{
    public $table;
    public $errorMsg;
	public $loginUser;

    //自定义初始化
    protected function initialize()
    {
        parent::initialize();
        $this->loginUser = cookie('account_name');
    }

    /**
     * 转换区域信息 省市区
     * author: lion
     */
    protected function getRegion($data)
    {
        $province = explode('-', $data['province']);
        $city = explode('-', $data['city']);
        $district = explode('-', $data['district']);

        // 区域编码
        $data['province_code'] = $province[0];
        $data['city_code'] = $city[0];
        $data['district_code'] = $district[0];

        // 区域名称
        $data['province_name'] = $province[1];
        $data['city_name'] = $city[1];
        $data['district_name'] = $district[1];

        unset($data['province']);
        unset($data['city']);
        unset($data['district']);

        // 区域ID
        $where = array(
                'province_code'=>$province[0],
                'city_code'=>$city[0],
                'district_code'=>$district[0],
            );

        $data['region_id'] = Db::name("region")->where($where)->value('id');

        return $data;
    }
}
