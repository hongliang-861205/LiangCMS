<?php

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
	public function Index() {
		return $this->display ();
	}
	public function Login() {
		$username = $_POST ['username'];
		$password = $_POST ['password'];
		
		return D ( "Admin" )->login ( $username, $password );
	}
}