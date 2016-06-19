<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();

    //判断当前是否为登录状态
    if (login_state($link)){
        skip('index.php', '已处于登录状态无法进行此操作，页面跳转中.....');
        exit();
    }

    if (isset($_POST['submit'])) {
    	//引入验证文件
    	include 'inc/login.func.php';

    	check_code($_POST['nmun'], $_SESSION['code']);
    	$clean = array();
    	$clean['name'] = $_POST['user'];
    	$clean['psw'] = md5($_POST['psw']);

    	//验证数据库是否存在这条数据
    	$sql_sel = "select * from member where name='{$clean['name']}' and psw='{$clean['psw']}'";
		if (nums($link, $sql_sel)) {
			//保存用户登陆信息
			setcookie('mb[user]', $clean['name']);
	        setcookie('mb[psw]', $clean['psw']);
	        //更新用户登陆的时间
	        $time = Date('Y-m-d H:i:s', time());
	        $sql_time = "update member set last_login_time='{$time}' where name='{$clean['name']}' and psw='{$clean['psw']}'";
			execute($link, $sql_time);
			
			skip('index.php', '恭喜你，登录成功，页面自动跳转中.....');
			exit();
		}else{
			skip('login.php', '登录失败，用户名或密码错误，页面自动跳转中.....');
			exit();
		}

    }


 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>用户登录 - 留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" href="style/register.css">
	<script src="js/login.js"></script>
	<link rel="shortcut icon" href="images/favicon.ico">
 </head>
 <body>
 	<div id="main">
 		<?php include 'inc/header.inc.php';?>
		<div id="submit">
			<form action="" method="post">
				<p>
					<img src="images/i3.gif">
					<span class="member-login">用户登录:</span>
				</p><br><br>
				<div class="submit_div">
					<label for="user">用户登录名：</label>
					<input type="text" id="user" name="user" value=""> <br><br>
					<label for="psw">登录密码：</label>
					<input type="password" id="psw" name="psw" value=""><br><br>
					<label for="nmun">登录验证码：</label>
					<input type="text" name="nmun" id="nmun">
					<img src="inc/vcode.php" title="点击刷新" id="vcode">
					<input type="submit" name="submit" id="btn" value="登录">
				</div>
			</form>
		</div>
 		<?php include 'inc/footer.inc.php';?>
 	</div>
 </body>
 </html>