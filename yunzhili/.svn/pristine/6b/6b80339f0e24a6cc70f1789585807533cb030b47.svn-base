<?php
namespace app\common\model;

use think\Model;

class StadiumCoach extends Model
{
    /**
     * 获取场馆id
     * @param $id 具体对象id
     * @return stadium_id is_default
     */
    public function get_stadium_id($id)
    {

        $map = [
            'coach_id'   =>  $id
        ];
        return $this->where($map)
                    ->field('stadium_id')
                    ->order('is_default','ace')
                    ->select();

    }

    /**
     * 获取场馆id
     * @param $id 具体对象id
     * @return stadium_id is_default
     */
    public function get_coach_id($id)
    {

        return $this->where('stadium_id',$id)
                    ->field('coach_id')
                    ->select();

    }
}