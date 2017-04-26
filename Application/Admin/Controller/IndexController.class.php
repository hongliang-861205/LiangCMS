<?php
namespace Admin\Controller;


class IndexController extends CommonController
{
    public function Index()
    {
        $menus = D("Menu")->getAdminMenus();

        $this->assign("menus", $menus);
        $this->display();
    }
}