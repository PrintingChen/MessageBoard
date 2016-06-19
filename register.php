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

    //处理提交过来的数据
    if (isset($_POST['submit'])) {
    	//引入验证文件
    	include 'inc/register.func.php';
    	$clean = array();
    	$clean['name'] = check_user($link, $_POST['user']);
    	$clean['psw'] = check_psw($link, $_POST['psw']);
    	check_code($_POST['nmun'], $_SESSION['code']);

    	//数据入库之前先查询是否已存在
    	$sql_sel = "select * from member where name='{$clean['name']}' and psw='{$clean['psw']}'";
		if (nums($link, $sql_sel)) {
			skip('register.php', '很抱歉，该用户名已被注册，页面自动跳转中.....');
			exit();
		}

    	//将数据插入数据库
    	$sql_ins = "insert into member(name,psw,register_time,last_login_time) values('{$clean['name']}', '{$clean['psw']}', now(), now())";
    	$result = execute($link, $sql_ins);

    	//判断数据是否添加成功
	   if (mysqli_affected_rows($link) == 1) {
	       setcookie('mb[user]', $clean['name']);
	       setcookie('mb[psw]', $clean['psw']);
	       skip('index.php', '恭喜你，注册成功，页面自动跳转中......');
	       exit();
	   }else {
	       skip('register.php', '很抱歉，注册失败，页面自动跳转中......');
	       exit();
	   }
    }

 ?>
 <!doctype html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>用户注册 - 留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" href="style/register.css">
	<link rel="shortcut icon" href="images/favicon.ico">
	<script src="js/register.js"></script>
 </head>
 <body>
 	<div id="main">
 		<?php include 'inc/header.inc.php';?>
		<div id="submit">
			<form action="" method="post">
				<p>
					<img src="images/i3.gif">
					<span class="member-login">用户注册:</span>
				</p><br><br>
				<div class="submit_div">
					<label for="user">用户名：</label>
					<input type="text" id="user" name="user" value="" placeholder="长度不得超过15个字符"> <br><br>

					<label for="psw">密码：</label>
					<input type="password" id="psw" name="psw" value="" placeholder="长度必须是6~15个字符"><br><br>

					<label for="re_psw">确认密码：</label>
					<input type="password" id="re_psw" name="re_psw" value="" placeholder="必须与原密码一致"><br><br>

					<label for="nmun">验证码：</label>
					<input type="text" name="nmun" id="nmun">
					<img src="inc/vcode.php" title="点击刷新" id="vcode">
					<input type="submit" name="submit" id="btn" value="确认注册">
				</div>
			</form>
		</div>
			
 		<?php include 'inc/footer.inc.php';?>
 	</div>
 </body>
 </html>