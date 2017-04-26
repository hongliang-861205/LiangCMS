<?php

namespace Admin\Model;

use Think\Model;

class MenuModel extends Model
{
    private $_db;

    public function __construct()
    {
        parent::__construct();
        $this->_db = M("Menu");
    }

    public function insertMenu($data)
    {
        if (!isset ($data) || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    public function getMenus($data, $page, $pagesize = 10)
    {
        $data['status'] = array('neq', -1);
        $offset = ($page - 1) * $pagesize;
        $list = $this->_db->where($data)->order(array('listorder' => 'desc'))->limit($offset, $pagesize)->select();
        return $list;
    }

    public function getMenusCount($data = array())
    {
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }

    public function getMenuById($id)
    {
        if (!$id || !is_numeric($id)) {
            return array();
        }
        $where["menu_id"] = $id;
        return $this->_db->where($where)->find();
    }

    public function updateMenuById($id, $data)
    {
        if (!$id || !is_numeric($id)) {
            throw_exception("菜单ID不合法！");
        }
        if (!$data || !is_array($data)) {
            throw_exception("菜单对象数据不合法");
        }
        $where["menu_id"] = array('eq', $id);
        return $this->_db->where($where)->save($data);
    }

    public function updateMenuStatusById($id, $status)
    {
        if (!$id || !is_numeric($id)) {
            throw_exception("菜单编号不合法！");
        }
        if (!$id || !in_array($status, array(-1, 1))) {
            throw_exception("菜单状态不合法！");
        }

        $data['status'] = $status;
        $where['menu_id'] = $id;

        return $this->_db->where($where)->save($data);
    }

    public function updateMenuListOrderById($id, $listOrder) {
        if(!$id || !is_numeric($id)) {
            throw_exception("菜单编号不合法！");
        }

        $where['menu_id'] = $id;
        $data['listorder'] = $listOrder;

        return $this->_db->where($where)->save($data);
    }

    public function getAdminMenus(){
        $where = array(
            'type' => 1,
            'status' => 1
        );

        return $this->_db->where($where)->order(array("listorder" => "asc", "menu_id" => "asc"))->select();
    }
}