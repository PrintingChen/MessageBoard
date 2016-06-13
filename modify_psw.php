<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();

    //判断当前是否为登录状态
    if (!$member_id = login_state($link)){
        skip("person.php", '您还未登录无法进行修改密码，页面跳转中.....');
        exit();
    }

    if (isset($_POST['submit'])) {
    	$clean = array();
    	$clean['opsw'] = md5($_POST['opsw']);
    	$clean['npsw'] = md5($_POST['npsw']);

    	//验证旧密码是否正确
    	$sql = "select psw from member where id={$member_id}";
    	$res = execute($link, $sql);
    	$data = fetch_array($res);
    	if ($clean['opsw'] != $data['psw']) {
    		skip('person.php', '原密码错误，页面跳转中.....');
        	exit();
    	}
    	//修改密码
    	$sql_psw = "update member set psw='{$clean['npsw']}' where id={$member_id}";
    	execute($link, $sql_psw);
    	if (mysqli_affected_rows($link)) {
    		setcookie('mb[user]', "", time()-36000);
			setcookie('mb[psw]', "", time()-36000);
    		skip('login.php', '密码修改成功，页面跳转中.....');
        	exit();
    	}else{
    		skip('modify_psw.php', '新密码不能与原密码一致，页面跳转中.....');
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
	<link rel="shortcut icon" href="images/favicon.ico">
	<script src="js/modify_psw.js"></script>
 </head>
 <body>
 	<div id="main">
 		<?php include 'inc/header.inc.php';?>
		<div id="submit">
			<form action="" method="post">
				<p>
					<img src="images/i3.gif">
					<img src="images/login.gif">
				</p><br><br>
				<div class="submit_div">
					<label for="opsw">原密码：</label>
					<input type="password" id="user" name="opsw" value=""> <br><br>
					<label for="npsw">新密码：</label>
					<input type="password" id="psw" name="npsw" value="" placeholder="长度必须是6~15个字符"><br><br>
					<label for="renpsw">确认密码：</label>
					<input type="password" name="renpsw" id="nmun" placeholder="必须与新密码一致"><br><br>
					<input type="submit" name="submit" id="btn" class="mdf-btn" value="确认修改">
				</div>
			</form>
		</div>
 		<?php include 'inc/footer.inc.php';?>
 	</div>
 </body>
 </html>