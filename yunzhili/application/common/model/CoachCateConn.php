<?php 
namespace app\common\model;
use think\Model;
use think\Db;
class CoachCateConn extends Model{

	/**
	 * 教练详情
	 */
	public function getCoachDetail($coachid){
		$sql = ' SELECT a.*, '
		    . ' c.title'
			. ' FROM coach a '
			. ' LEFT JOIN coach_cate_conn b ON b.coach_id = a.id '
			. ' LEFT JOIN coach_category c ON b.cate_id = c.id '
			. ' WHERE a.id = '. $coachid;

		return Db::query($sql);
	}

	 /**
     * 获取类型id
     * @param $id
     * @return cate_id
     */
    public function get_coach_cateId($id)
    {
        return $this->where('coach_id',$id)
                    ->field('cate_id')
                    ->select();

    }

}