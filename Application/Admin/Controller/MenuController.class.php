<?php

namespace Admin\Controller;

use Think\Controller;

class MenuController extends CommonController {
	public function Index() {
		$data = array();
		$page = $_GET['p'] ? $_GET['p'] : 1;
		$pagesize = $_GET['pageSize'] ? $_GET['pageSize'] : 3;
		$menuList = D("menu")->getMenus($data, $page, $pagesize);
		$menuCount = D("menu")->getMenusCount($data);
		
		$res = new \Think\Page($menuCount, $pagesize);
		$pageRes = $res->show();
		$this->assign('pageRes', $pageRes);
		$this->assign('menuList', $menuList);
		
		$this->display ();
	}
	public function add() {
		if ($_POST) {
			if (!isset($_POST['name']) || !$_POST['name']) {
				return show(0, "菜单名称不能为空！");
			}
			if(!isset($_POST['m']) || !$_POST['m']) {
				return show(0, "模块名不能为空！");
			}
			if(!isset($_POST['c']) || !$_POST['c']) {
				return show(0, "控制器名不能为空！");
			}
			if(!isset($_POST['f']) || !$_POST['f']) {
				return show(0, "方法名不能为空！");
			}
			$menuId = D("menu")->insertMenu($_POST);
			if (!$menuId) {
				return show(0, "添加菜单失败！", $menuId);
			} else {
				return show(1, "添加菜单成功！", $menuId);
			}
		} else {
			$this->display ();
		}
	}
}