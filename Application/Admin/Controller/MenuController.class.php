<?php

namespace Admin\Controller;

use Think\Controller;

class MenuController extends CommonController
{
    public function Index()
    {
        $data = array();
        if (isset ($_GET ['type']) && in_array($_GET ['type'], array(
                0,
                1
            ))
        ) {
            $data ['type'] = $_GET ['type'];
            $this->assign("type", $data ['type']);
        } else {
            $this->assign("type", -100);
        }

        $page = $_GET ['p'] ? $_GET ['p'] : 1;
        $pagesize = $_GET ['pageSize'] ? $_GET ['pageSize'] : 3;
        $menuList = D("menu")->getMenus($data, $page, $pagesize);
        $menuCount = D("menu")->getMenusCount($data);

        $res = new \Think\Page ($menuCount, $pagesize);
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
        $menu = D("menu")->getMenuById($menuId);
        $this->assign("menu", $menu);
        $this->display();
    }

    public function save($data) {
        $menuId = $_POST['menu_id'];
        unset($_POST['menu_id']);

        try{
            $res = D("menu")->updateMenuById($menuId, $data);
            if($res == false) {
                show(0, "更新菜单失败！");
            } else {
                show(1, "更新菜单成功！");
            }
        } catch (exception $ex) {
            return show(0, $ex->getMessage());
        }

    }
}