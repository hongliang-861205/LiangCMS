<?php

namespace Admin\Model;

use Think\Model;
use Org\Util\String;

class AdminModel extends Model {
	private $_db;
	public function __construct() {
		$this->_db = M ( "Admin" );
	}
	/**
	 * 根据用户名查询管理员用户信息
	 * @param Strng $username 用户名
	 * @return Array 查到的用户信息
	 */
	private function getAdminByUsername($username) {
		$condition ["username"] = $username;
		$data = $this->_db->where ( $condition )->find ();
		return $data;
	}
	/**
	 * 登陆后台的逻辑
	 * @param String $username 用户名
	 * @param String $password 密码
	 * @return json 返回JSON格式的登陆结果数据
	 */
	public function login($username, $password) {
		if (! trim ( $username )) {
			return show ( 0, "用户名不能为空" );
		}
		if (! trim ( $password )) {
			return show ( 0, "密码不能为空" );
		}
		
		$data = $this->getAdminByUsername ( $username );
		
		if (! $data) {
			return show ( 0, "该用户不存在！" );
		} else {
			if ($data ["password"] != getMD5Password ( $password )) {
				return show ( 0, "密码错误！" );
			} else {
				session ( "adminUser", $data );
				return show ( 1, "登陆成功！" );
			}
		}
	}
}