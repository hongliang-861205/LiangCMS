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