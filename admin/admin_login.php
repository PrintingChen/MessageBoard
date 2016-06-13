<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();
    
    if (isset($_POST['submit'])) {
    	//引入验证文件
    	include 'inc/admin_user.func.php';
    	check_code($_POST['nmun'], $_SESSION['code']);
    	$clean = array();
    	$clean['name'] = $_POST['admin_user'];
    	$clean['psw'] = md5($_POST['admin_psw']);

    	$sql = "select * from admin where name='{$clean['name']}' and psw='{$clean['psw']}'";
    	//echo $sql;exit();
    	execute($link, $sql);
    	if (nums($link, $sql)) {
			$_SESSION['admin']['name'] = $clean['name'];
            $_SESSION['admin']['psw'] = $clean['psw'];
			skip('index.php', '恭喜你，登录成功，页面自动跳转中.....');
			exit();
		}else{
			skip('admin_login.php', '登录失败，用户名或密码错误，页面自动跳转中.....');
			exit();
		}

    }
	

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理登录 - 留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/admin_login.css">
	<link rel="shortcut icon" href="../images/favicon.ico">
	<script src="js/admin_user.js"></script>
</head>
<body>
	<div id="main">
		<?php include "inc/header.inc.php";?>

		<div id="submit">
			<form action="" method="post">
				<p>
					<img src="images/i3.gif">
					<img src="images/login.gif">
				</p><br><br>
				<div class="submit_div">
					<label for="admin_user">管理员帐号：</label>
					<input type="text" id="admin_user" name="admin_user" value=""> <br><br>

					<label for="admin_psw">管理员密码：</label>
					<input type="password" id="admin_psw" name="admin_psw" value=""><br><br>

					<label for="nmun">登录验证码：</label>
					<input type="text" name="nmun" id="nmun">
					<img src="../inc/vcode.php" title="点击刷新" id="vcode">
					<input type="submit" name="submit" id="btn" value="登录">
				</div>
			</form>
		</div>
		
		<?php include "../inc/footer.inc.php";?>
	</div>
</body>
</html>