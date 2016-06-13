<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    if (isset($_POST['submit'])) {
    	$clean = array();
    	$clean['name'] = $_POST['name'];
    	$clean['psw'] = md5($_POST['psw']);
    	
    	//查询是否已存在此管理员
    	$sql_re = "select * from admin where name='{$clean['name']}'";
    	//$res_re = execute($link, $sql_re);
    	if (nums($link, $sql_re)) {
			echo "<script>alert('该用户名已被注册');history.go(-1);</script>";
			exit();
		}
		//将数据插入数据库
    	$sql_ins = "insert into admin(name,psw,insert_time) values('{$clean['name']}', '{$clean['psw']}', now())";
    	$result = execute($link, $sql_ins);
    	//判断数据是否添加成功
	   if (mysqli_affected_rows($link) == 1) {
	       //setcookie('mb[name_adm]', $clean['name']);
	       //setcookie('mb[psw_adm]', $clean['psw']);
			echo "<script>alert('恭喜你，注册成功');location.href = 'manage.php?a=1';</script>";
			exit();
	   }else {
			echo "<script>alert('注册成功失败');history.go(-1);</script>";
			exit();
	   }
    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理中心</title>
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/add_manage.css">
	<script src="js/add_manage.js"></script>
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
					<span class="crumb-name">添加管理员</span>
				</div>
			</div>
			<div class="table">
				<form method="post" class="myform">
					<table class="insert-tab">
						<tr>
							<td width="15%">用户名：</td>
							<td width="30%"><input type="text" name="name"></td>
							<td>不得包含任何标点符号，长度不能超过15个字符</td>
						</tr>
						<tr>
							<td width="15%">密码：</td>
							<td width="30%"><input type="password" name="psw"></td>
							<td>数字、字母或者下划线组合，长度6~15个字符</td>
						</tr>
						<tr>
							<td width="15%">确认密码：</td>
							<td width="30%"><input type="password" name="re_psw"></td>
							<td>两次密码必须一致</td>
						</tr>
						<tr>
							<td width="15%"><input class="man-btn" type="submit" name="submit" value="确认添加"></td>
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