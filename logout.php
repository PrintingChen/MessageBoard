<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';

    //删除cookie
	if (isset($_COOKIE['mb']['user']) || isset($_COOKIE['mb']['psw'])) {
		setcookie('mb[user]', "", time()-36000);
		setcookie('mb[psw]', "", time()-36000);
	}

	if (isset($_COOKIE['mb']['user']) || isset($_COOKIE['mb']['user'])) {
		skip('index.php', '退出成功，页面跳转中.....');
		exit();
	}else{
		skip('index.php', '退出失败，页面跳转中.....');
		exit();
	}

 ?>