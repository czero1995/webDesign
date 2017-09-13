<?php
namespace app\common\model;

use think\Model;

class StadiumCourse extends Model
{
    /**
     * 获取课程id
     * @param  $id
     * @return arr
     */
    public function get_course_id($id)
    {
        return $this->where('stadium_id',$id)
                    ->field('course_id')
                    ->select();
    }

    /**
     * 获取场馆id
     * @param  $id
     * @return arr
     */
    public function get_stadium_id($id)
    {
        return $this->where('course_id',$id)
                    ->field('stadium_id')
                    ->select();
    }
}