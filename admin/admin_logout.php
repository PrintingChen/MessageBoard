<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    //清除SESSION
	session_unset(); //释放当前会话注册的所有会话变量
	session_destroy(); //销毁当前会话中的全部数据    
	setcookie(session_name(), '', time()-3600, '/'); //销毁保存在客户端的卡号

	if (!isset($_SESSION['admin']['name']) || !isset($_SESSION['admin']['psw'])) {
		echo "<script>alert('退出成功');location.href = 'admin_login.php';</script>";
		exit();
	}else{
		echo "<script>alert('退出失败');location.href = 'index.php';</script>";
		exit();
	}

 ?>