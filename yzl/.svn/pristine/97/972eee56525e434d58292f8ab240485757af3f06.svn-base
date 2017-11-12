<?php
namespace app\common\model;
use think\Model;
use think\Db;

class Module extends Base
{
    //自定义初始化
    protected function initialize()
    {
        parent::initialize();
    }

    public function getLevelModule($id=0, $level=1)
    {
        $where = array(
            'parent_id'=>$id,
            'parent_id'=>$id,
            );

        $list = Db::name("t_module")->where($where)->select();
        return $list;
    }

    /**
     * 全部的菜单
     */
    public function getList($where=null)
    {
        $where = $where ? $where : '';
        global $module, $module2;
        $module = Db::name("t_module")->order('parent_id,sort_order', 'ASC')->where($where)->select();
        $module = convert_arr_key($module, 'id');

        foreach ($module AS $key => $value)
        {
            if($value['level'] == 1)
                $this->get_module_tree($value['id']);
        }
        /*
        foreach ($module2 AS $key => $value)
        {
                $strpad_count = $value['level']*10;
                echo str_pad('',$strpad_count,"-",STR_PAD_LEFT);
                echo $value['name'];
                echo "<br/>";
        }*/
        return $module2;
    }

    /**
     * 获取指定id下的 所有分类
     * @global type $module 所有商品分类
     * @param type $id 当前显示的 菜单id
     * @return 返回数组 Description
     */
    public function get_module_tree($id)
    {
        global $module, $module2;
        $module2[$id] = $module[$id];
        foreach ($module AS $key => $value){
             if($value['parent_id'] == $id)
             {
                $this->get_module_tree($value['id']);
                $module2[$id]['have_son'] = 1; //还有下级
             }
        }
    }

    public function addModule($data)
    {
        $data = $this->getSaveData($data);
        $path = $data['path'];
        $insertLastId = Db::name("t_module")->insertGetId($data);

        if($insertLastId){
            $path = $path.','.$insertLastId;
            $level = substr_count($path, ',');
            Db::name("t_module")->where(array('id'=>$insertLastId))->update(array('path'=>$path, 'level'=>$level));
        }

        return $insertLastId;
    }

    public function editModule($data)
    {
        $id = $data['id'];
        $data = $this->getSaveData($data);
        $newParentId = $data['parent_id'];
        $newPath = $data['path'];
        $oldData = Db::name("t_module")->where("id = $id")->find();
        $oldParentId = $oldData['parent_id'];
        $oldPath = $oldData['path'];

        // 更改模块信息
        $result = Db::name("t_module")->where("id = $id")->update($data);

        // 对比更改父级元素后权限设置
        if($newParentId != $oldParentId){
            Db::name("t_module")->where("id = $id")->update($data);

            $curModule = Db::name("roleModule")->where("module_id = $id")->column("role_id");
            $parentModule = Db::name("roleModule")->where("module_id = $newParentId")->column("role_id");
            $diffModule = array_diff($curModule, $parentModule);
            if(!empty($diffModule)){
                // 删除多余的权限模块信息
                Db::name("roleModule")->where("role_id", 'in', $diffModule)->where("module_id", $id)->delete();
            }

            // 替换子级菜单path和level
            $pathSql = "UPDATE t_module SET path = REPLACE(path, '$oldPath', '$newPath') WHERE FIND_IN_SET($id,path)";
            $levelSql = "UPDATE t_module AS a, (
                    select length(path)-length(replace(path,',','')) AS lengths, id from t_module 
                    WHERE FIND_IN_SET($id,path)
                    ) AS b
                    SET a.level = b.lengths WHERE a.id=b.id";
            Db::execute($pathSql);
            Db::execute($levelSql);
        }

        return $result;
    }

    // 更换父级菜单，则逐级更改子级菜单的路径
    protected function updateAllChildren($data,$oldPath,$newPath){
        //批量修改
        foreach($data as $k=>$v){
            $result = false;
            $childrenWhere = $this->wdb->quoteInto('id = ?', $v['id']);
            $childrenData['path'] = str_replace($oldPath,$newPath,$v['path']);
            $childrenData['level'] = substr_count($childrenData['path'], ',');
            $childrenData['update_user'] = $this->loginUser;
            $childrenData['update_time'] = date('Y-m-d H:i:s');
            $result = $this->model->update($this->wdb, $childrenData, $childrenWhere);
            if($result){
                //查询当前分类是否有子分类
                $data = $this->commonType->getList($this->db, $this->table->c_product_catalog, '', 'order_id', ' parent_id = '.$v['id'], true);
                if($data){
                    $this->updateAllChildren($data,$oldPath,$newPath);
                }
            }else{
                return $result;
            }
        }
        return $result;
    }

    public function getSaveData($data)
    {
        $parent_id = $data['parent_id'];
        $pathAndSort = $this->getPathAndSort($parent_id);

        $data['path'] = $pathAndSort['path'];
        $data['parent_id'] = $parent_id;
        $data['sort_order'] = $pathAndSort['sort_order'];

        if(isset($data['id'])){
            $data['update_time'] = date("Y-m-d H:i:s");
            $data['update_user'] = $this->loginUser;
            $path = $pathAndSort['path'] . "," . $data['id'];
            $data['path'] = $path;
            $level = substr_count($path, ',');
            $data['level'] = $level;
        }else{
            $data['create_time'] = $data['update_time'] = date("Y-m-d H:i:s");
            $data['create_user'] = $data['update_user'] = $this->loginUser;
        }

        return $data;
    }

    public function getPathAndSort($parent_id)
    {
        $sort_order = Db::name("t_module")->where("parent_id",$parent_id)->max("sort_order");
        $sort_order ++;
        $path = Db::name("t_module")->where("id",$parent_id)->value("path");
        $path= $path ? $path : 0;

        return array("path"=>$path, "sort_order"=>$sort_order);
    }
}
