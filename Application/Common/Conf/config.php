<?php
return array(
		//'配置项'=>'配置值'
		/* URL设置 */
		'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
		// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

		/* 数据库设置 */
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  '127.0.0.1', // 服务器地址
		'DB_NAME'               =>  'liangcmsdb',          // 数据库名
		'DB_USER'               =>  'root',      // 用户名
		'DB_PWD'                =>  'KevinHONG@)07',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  'cms_',    // 数据库表前缀
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
		
		'MD5_PWD'				=>	'liang_cms',

);