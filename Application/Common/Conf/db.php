<?php
return array(
	//数据库配置信�?
	'DB_TYPE'   => 'mysql',               // 数据库类�?
	'DB_HOST'   => 'localhost',          // 服务器地址
	'DB_NAME'   => 'dzx',             // 数据库名
	'DB_USER'   => 'root',               // 用户�?
	'DB_PWD'    => '123456',                    // 密码
	'DB_PORT'   => 3306,                  // 端口
	'DB_PREFIX' => 'think_',            // 数据库表前缀
	'DB_CHARSET'=> 'utf8',              // 字符�?
	//'DB_DEBUG'  =>  ture,               // 调试模式
	// 关闭字段缓存 调试模式下面由于考虑到数据结构可能会经常变动，所以默认是关闭字段缓存的�?
	'DB_FIELDS_CACHE'=>false
);