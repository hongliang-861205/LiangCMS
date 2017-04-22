<?php

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
	public function Index() {
		if (session("adminUser")) {
			$this->redirect("/admin");
		}
		return $this->display ();
	}
	public function Login() {
		$username = $_POST ['username'];
		$password = $_POST ['password'];
		
		return D ( "Admin" )->login ( $username, $password );
	}
	public function Logout() {
		session("adminUser", null);
		$this->redirect("/admin/login");

	}
}