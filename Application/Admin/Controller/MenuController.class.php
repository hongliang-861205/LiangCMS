<?php

namespace Admin\Controller;

use Think\Page;
use Think\Controller;

class MenuController extends CommonController
{
    public function Index()
    {
        $data = array();
        if (isset ($_GET ['type']) && in_array($_GET ['type'], array(0, 1))) {
            $data ['type'] = $_GET ['type'];
            $this->assign("type", $data ['type']);
        } else {
            $this->assign("type", -100);
        }

        $page = $_GET ['p'] ? $_GET ['p'] : 1;
        $pageSize = $_GET ['pageSize'] ? $_GET ['pageSize'] : 3;
        $menuList = D("menu")->getMenus($data, $page, $pageSize);
        $menuCount = D("menu")->getMenusCount($data);

        $res = new Page ($menuCount, $pageSize);
        $pageRes = $res->show();
        $this->assign('pageRes', $pageRes);
        $this->assign('menuList', $menuList);

        $this->display();
    }

    public function add()
    {
        if ($_POST) {
            if (!isset ($_POST ['name']) || !$_POST ['name']) {
                return show(0, "菜单名称不能为空！");
            }
            if (!isset ($_POST ['m']) || !$_POST ['m']) {
                return show(0, "模块名不能为空！");
            }
            if (!isset ($_POST ['c']) || !$_POST ['c']) {
                return show(0, "控制器名不能为空！");
            }
            if (!isset ($_POST ['f']) || !$_POST ['f']) {
                return show(0, "方法名不能为空！");
            }

            if ($_POST['menu_id']) {
                return $this->save($_POST);
            }

            $menuId = D("menu")->insertMenu($_POST);
            if (!$menuId) {
                return show(0, "添加菜单失败！", $menuId);
            } else {
                return show(1, "添加菜单成功！", $menuId);
            }
        } else {
            $this->display();
        }
    }

    public function edit()
    {
        $menuId = $_GET['id'];
        $menu = D("Menu")->getMenuById($menuId);

        $this->assign("menu", $menu);
        $this->display();
    }

    public function save($data)
    {
        $menuId = $_POST['menu_id'];
        unset($_POST['menu_id']);

        try {
            $res = D("menu")->updateMenuById($menuId, $data);
            if ($res == false) {
                return show(0, "更新菜单失败！");
            } else {
                return show(1, "更新菜单成功！");
            }
        } catch (exception $ex) {
            return show(0, $ex->getMessage());
        }

    }

    public function setStatus()
    {
        if ($_POST) {
            $id = $_POST['menu_id'];
            $status = $_POST['status'];

            try {
                $res = D("Menu")->updateMenuStatusById($id, $status);
                if ($res == false) {
                    return show(0, "删除该菜单失败！");
                } else {
                    return show(1, "删除菜单成功！");
                }
            } catch (exception $ex) {
                return show(0, $ex->getMessage());
            }
        }
    }

    public function listOrder() {
        if($_POST) {
            $listOrder = $_POST['listOrder'];
            $errors = array();
            $jump_url = $_SERVER["HTTP_REFERER"];
            if($listOrder && is_array($listOrder)) {
                try{
                    foreach ($listOrder as $menuId => $val) {
                        $res = D("Menu")->updateMenuListOrderById($menuId, $val);
                        if($res === false) {
                            $errors[] = $menuId;
                        }
                    }
                } catch (exception $ex) {
                    return show(0, $ex->getMessage(), array('jump_url' => $jump_url));
                }

                if($errors) {
                    return show(0, "排序失败-".implode(',', $errors), array('jump_url' => $jump_url));
                } else {
                    return show(1, "排序成功！", array('jump_url' => $jump_url));
                }
            }

            return show(0, "排序数据失败！", array('jump_url' => $jump_url));
        }

    }

}