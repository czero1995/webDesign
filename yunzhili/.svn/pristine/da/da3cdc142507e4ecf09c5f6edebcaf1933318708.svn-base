<?php
namespace app\common\model;

use think\Model;

class TagsConn extends Model
{
    /**
     * 获取标签id
     * @param $id 具体对象id
     * @return tags_id
     */
    public function get_tagsId($id)
    {

        $map = [
          'obj_type'    =>  2,
          'obj_id'      =>  $id
        ];
        return $this->where($map)
            ->field('tags_id')
            ->select();

    }
}