<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 搴旂敤鍏ュ彛鏂囦欢

// 妫€娴婸HP鐜
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 寮€鍚皟璇曟ā寮?寤鸿寮€鍙戦樁娈靛紑鍚?閮ㄧ讲闃舵娉ㄩ噴鎴栬€呰涓篺alse
define('APP_DEBUG',true);

// 瀹氫箟搴旂敤鐩綍
define('APP_PATH','./Application/');

define('WEB_HOST', "http://www.pinkan.cn/");
define('WX_APPID', "wxf02790fbcadf974a");
define('WX_MCHID', "1382132602");
define('WX_KEY', "214ADK1238123K312FDAS94313232113");
define('WX_APPSECRET', "d5f062346b24ca499e6997fc2f38d4db");

define('WX_JS_API_CALL_URL', '');
define('WX_SSLCERT_PATH', '');
define('WX_SSLKEY_PATH', '');
define('WX_NOTIFY_URL',WEB_HOST.'wap/Notify/WeChatPay');
define('WX_CURL_TIMEOUT', 30);



// 寮曞叆ThinkPHP鍏ュ彛鏂囦欢
require './ThinkPHP/ThinkPHP.php';

// 浜瞊_^ 鍚庨潰涓嶉渶瑕佷换浣曚唬鐮佷簡 灏辨槸濡傛绠€鍗?