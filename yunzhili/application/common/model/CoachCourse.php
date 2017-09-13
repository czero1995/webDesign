<?php
namespace app\common\model;

use think\Model;

class CoachCourse extends Model
{ 
    /**
     * 获取教练课程
     */
    public function getCoachCourse(){
    $sql = 'SELECT b.id,b.name,group_concat(c.title) FROM coach_course a JOIN coach b ON a.coach_id=b.id JOIN course c ON a.course_id=c.id GROUP BY b.id';
    }
    /**
     * 获取课程id
     * @param $id 教练id
     * @return course_id
     */
    public function get_courseId($id)
    {

        return $this->where('coach_id',$id)
                    ->field('course_id')
                    ->select();

    }

    /**
     * 获取教练id
     * @param $id 课程id
     * @return coach_id
     */
    public function get_coach_id($id)
    {
        return $this->where('course_id',$id)
                    ->field('coach_id')
                    ->select();
    }
}