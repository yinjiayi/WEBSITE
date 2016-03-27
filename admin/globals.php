<?php
/**
 * 后台全局项加载
 * @copyright (c) Emlog All Rights Reserved
 */

require_once '../init.php';

define('TEMPLATE_PATH', EMLOG_ROOT.'/admin/scale/');//后台当前模板路径
define('OFFICIAL_SERVICE_HOST', 'http://www.emlog.net/');//官方服务域名

$sta_cache = $CACHE->readCache('sta');
$user_cache = $CACHE->readCache('user');
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';

//登录验证
if ($action == 'login') {
	$username = isset($_POST['user']) ? addslashes(trim($_POST['user'])) : '';
	$password = isset($_POST['pw']) ? addslashes(trim($_POST['pw'])) : '';
	$ispersis = isset($_POST['ispersis']) ? intval($_POST['ispersis']) : false;
	$img_code = Option::get('login_code') == 'y' && isset($_POST['imgcode']) ? addslashes(trim(strtoupper($_POST['imgcode']))) : '';

    $loginAuthRet = LoginAuth::checkUser($username, $password, $img_code);
    
	if ($loginAuthRet === true) {
		LoginAuth::setAuthCookie($username, $ispersis);
		emDirect("./");
	} else{
		LoginAuth::loginPage($loginAuthRet);
	}
}
//退出
if ($action == 'logout') {
	setcookie(AUTH_COOKIE_NAME, ' ', time() - 31536000, '/');
	emDirect("../");
}

if (ISLOGIN === false) {
	LoginAuth::loginPage();
}

$request_uri = strtolower(substr(basename($_SERVER['SCRIPT_NAME']), 0, -4));
if (ROLE == ROLE_WRITER && !in_array($request_uri, array('write_log','admin_log','attachment','blogger','comment','index','save_log'))) {
	emMsg('权限不足！','./');
}
function paginations($count, $perlogs, $page, $url, $anchor = '') {
	$pnums = @ceil($count / $perlogs);
	$re = '';
	$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|", "", $url);
	for ($i = $page - 5; $i <= $page + 5 && $i <= $pnums; $i++) {
		if ($i > 0) {
			if ($i == $page) {
				$re .= " <li class=\"active\"><a>$i</a><li> ";
			} elseif ($i == 1) {
				$re .= " <li><a href=\"$urlHome$anchor\">$i</a></li> ";
			} else {
				$re .= " <li><a href=\"$url$i$anchor\">$i</a></li> ";
			}
		}
	}
	if ($page > 6)
		$re = "<li><a href=\"{$urlHome}$anchor\" title=\"首页\"><i class=\"fa fa-chevron-left\"></i></a>$re</li>";
	if ($page + 5 < $pnums)
		$re .= "<li><a href=\"$url$pnums$anchor\" title=\"尾页\"><i class=\"fa fa-chevron-right\"></i></a><li>";
	if ($pnums <= 1)
		$re = '';
	return $re;
}

function okORno($o) {
	return $o?'<font color="green"><i class="fa fa-check"></i></font>':'<font color="red"><i class="fa fa-times"></i></font>';
}