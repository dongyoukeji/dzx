<?php
return array(
	//数据库缓存
	'DB_SQL_BUILD_CACHE' => true,
	'DATA_CACHE_TIME'=>60,
	'DB_SQL_BUILD_LENGTH' => 20, // SQL缓存的队列长度

	//加载标签库打开
	'TAGLIB_LOAD'               	=> true,
	'APP_AUTOLOAD_PATH'         	=>'@.TagLib',
	'TAGLIB_BUILD_IN' 			=> 'Cx,TagLibCustom',

	//资源列表
	'TMPL_PARSE_STRING'=>array(
		'__JS__'=> __ROOT__.'/Public/'.MODULE_NAME.'/js',
		 '__PLUG__'=> __ROOT__.'/Public/Plug',
		'__CSS__'=>__ROOT__.'/Public/'.MODULE_NAME.'/css',
		'__IMAGES__'=> __ROOT__.'/Public/'.MODULE_NAME.'/images',
		'__FILES__'=> __ROOT__.'/Uploads/files'
	),
);