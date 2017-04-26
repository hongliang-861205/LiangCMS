<?php
function show($status, $message, $data = array()) {
	$result = array (
			"status" => $status,
			"message" => $message,
			"data" => $data 
	);
	
	exit ( json_encode ( $result ) );
}

function getMD5Password($password) {
	return md5(C("MD5_PWD").$password);
}

function getMenuType($type) {
	$type = $type == 1 ? "后端栏目" : "前端栏目";
	return $type;
}

function getMenuStatus($status) {
	$str = "";
	switch ($status){
		case 0:
			$str = "关闭";
			break;
		case 1:
			$str = "正常";
			break;
		case -1:
			$str = "删除";
			break;
	}
	return $str;
}

function getMenuUrl($nav) {
    $url = "/".$nav['m']."/".nav['c'].'/'.$nav['f'];
    if(strtolower($nav['f']) == "index") {
        $url = "/".$nav['m']."/".$nav['c'];
    }
    return $url;
}

function getActive($navc) {
    $c = strtolower(CONTROLLER_NAME);

    if(strtolower($navc) == $c) {
        return "class='active'";
    }

    return "";
}