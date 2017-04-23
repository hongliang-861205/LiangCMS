<?php

namespace Admin\Model;

use Think\Model;

class MenuModel extends Model {
	private $_db;
	public function __construct() {
		parent::__construct ();
		$this->_db = M ( "Menu" );
	}
	public function insertMenu($data) {
		if (! isset ( $data ) || ! is_array ( $data )) {
			return 0;
		}
		return $this->_db->add ( $data );
	}
	public function getMenus($data, $page, $pagesize = 10) {
		$data['status'] = array('neq', -1);
		$offset = ($page - 1) * $pagesize;
		$list = $this->_db->where($data)->order(array('menu_id'=>'desc'))->limit($offset, $pagesize)->select();
		return $list;
	}
	public function getMenusCount($data = array()) {
		$data['status'] = array('neq', -1);
		return $this->_db->where($data)->count();
	}
}