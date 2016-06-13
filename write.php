<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();
    //判断登录状态
    $member_id = login_state($link);

    //处理提交过来的数据
    if (isset($_POST['submit'])) {
    	//引入验证文件
    	include 'inc/write.func.php';
    	$clean = array();
    	if (is_file("./filterwords.txt")) {
    		echo "1232";
    	}
    	$clean['title'] = check_title($link, $_POST['title']);
    	$clean['content'] = check_content($link, $_POST['content']);
    	check_code($_POST['unum'], $_SESSION['code']);

    	if ($member_id) {
    		$sql = "insert into message(mid,title,content,content_time) values({$member_id}, '{$clean['title']}', '{$clean['content']}', now())";
    		execute($link, $sql);
    		if (mysqli_affected_rows($link)) {
    			skip('index.php', '发布留言成功，页面自动跳转中.....');
				exit();
    		}else{
    			skip('write.php', '发布留言失败，页面自动跳转中.....');
				exit();
    		}
    	}else{
    		skip('login.php', '您还未登录，不能发布留言，页面自动跳转中.....');
			exit();
    	}

    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>签写留言 - 留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/write.css">
	<link rel="shortcut icon" href="images/favicon.ico">
	<script src="js/index.js"></script>

</head>
<body>
	<div id="main">
		<?php include "inc/header.inc.php";?>
		<div id="submit">
			<form action="" method="post">
				<p>
					<img src="images/i1.gif">
					<img src="images/add.gif">
				</p><br><br>
				<label for="title">标题：</label>
				<input type="text" id="title" name="title" value="" placeholder="不得超过15个字符"><br><br>
				<label for="content">内容：</label>
				<textarea name="content" id="content" placeholder="写下你的留言..."></textarea><br><br>
				<label for="umum">验证码：</label><input name="unum" type="text" id="unum" size="10"><img src="inc/vcode.php" alt="验证码" title="点击刷新" id="vcode" ><br><br>
				<input type="submit" name="submit" id="sbutton" value="发布留言">
			</form>
		</div>
		<?php include "inc/footer.inc.php";?>
	</div>
	
</body>
</html>