<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    if (isset($_POST['submit'])) {
    	$clean = array();
    	$clean['opsw'] = md5($_POST['opsw']);
    	$clean['npsw'] = md5($_POST['npsw']);
    	//验证旧密码是否正确
    	$sql = "select psw from admin where name='{$_SESSION['admin']['name']}'";
    	$res = execute($link, $sql);
    	$data = fetch_array($res);
    	if ($clean['opsw'] != $data['psw']) {
    		echo "<script>alert('原密码错误');location.href='modify_adm_psw.php';</script>";
        	exit();
    	}
    	//修改密码
    	$sql_psw = "update admin set psw='{$clean['npsw']}' where name='{$_SESSION['admin']['name']}'";
    	execute($link, $sql_psw);
    	if (mysqli_affected_rows($link)) {
    		session_unset(); //释放当前会话注册的所有会话变量
			session_destroy(); //销毁当前会话中的全部数据    
			setcookie(session_name(), '', time()-3600, '/'); //销毁保存在客户端的卡号
    		echo "<script>alert('密码修改成功');location.href='index.php';</script>";
        	exit();
    	}else{
    		echo "<script>alert('修改失败，新密码不能和旧密码一致');location.href='modify_adm_psw.php';</script>";
        	exit();
    	}
    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>密码修改 - 管理中心</title>
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/add_manage.css">
	<script src="js/add_manage.js"></script>
	<script src="../js/modify_psw.js"></script>
</head>
<body>
	<?php include "inc/top.php";?>
	<div class="container clearfix">
		<?php include "inc/slide.php";?>
		<div class="main-wrap">
			<div class="crumb-wrap">
				<div class="crumb-list">
					<i><img src="images/position.png" alt=""></i>
					<a href="" color="#white">首页</a>
					<span class="crumb-step">&gt;</span>
					<span class="crumb-name">修改密码</span>
				</div>
			</div>
			<div class="table">
				<form method="post" class="myform">
					<table class="insert-tab">
						<tr>
							<td width="15%">旧密码：</td>
							<td width="30%"><input type="password" name="opsw"></td>
							<td>数字、字母或者下划线组合，长度6~15个字符</td>
						</tr>
						<tr>
							<td width="15%">新密码：</td>
							<td width="30%"><input type="password" name="npsw"></td>
							<td>数字、字母或者下划线组合，长度6~15个字符</td>
						</tr>
						<tr>
							<td width="15%">确认密码：</td>
							<td width="30%"><input type="password" name="renpsw"></td>
							<td>两次密码必须一致</td>
						</tr>
						<tr>
							<td width="15%"><input class="man-btn" type="submit" name="submit" value="确认修改"></td>
							<td width="30%"></td>
							<td></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>