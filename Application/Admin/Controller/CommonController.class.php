<?php

namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller {
	public function __construct() {
		parent::__construct ();
		$this->init();
	}
	/**
	 * 初始化
	 */
	private function init() {
		$islogin = $this->isLogin ();
		if (! $islogin) {
			$this->redirect ( "/admin/login" );
		}
	}
	/**
	 * 判断用户是否已经登录后台
	 * @return boolean 登录结果
	 */
	public function isLogin() {
		$user = $this->getAdminUser ();
		if ($user && is_array ( $user ) && $user ["username"]) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 获取登录用户信息
	 * @return array 登录用户信息
	 */
	public function getAdminUser() {
		return session ( "adminUser" );
	}
}