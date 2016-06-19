<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();
    //判断是否登录状态
    if(!$member_id = login_state($link)){
    	skip('index.php', '还未登录，页面跳转中.....');
        exit();
    }

    //判断获取过来的留言cid的合法性
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip('person.php', '留言id参数错误，页面自动跳转中.....');
        exit();
    };
	//查询是否存在cid对应的留言信息
    $sql_sel_cont = "select * from message where id={$_GET['cid']}";
    $result_sel_cont = execute($link, $sql_sel_cont);
    $data_sel_cont = fetch_array($result_sel_cont);
    if (mysqli_num_rows($result_sel_cont) == 0) {
        skip('person.php', '这条留言帖信息不存在，页面自动跳转中.....');
        exit();
    }

    
    //处理提交过来的数据
    if (isset($_POST['submit'])) {
    	//引入验证文件
    	include 'inc/edit.func.php';
    	$clean = array();
    	$clean['title'] = check_title($link, $_POST['title']);
    	$clean['content'] = check_content($link, $_POST['content']);
    	check_code($_POST['unum'], $_SESSION['code']);

    	
		$sql = "update message set title='{$clean['title']}',content='{$clean['content']}' where id={$_GET['cid']}";
		execute($link, $sql);
		if (mysqli_affected_rows($link)) {
			skip('person.php', '编辑留言成功，页面自动跳转中.....');
			exit();
		}else{
			skip("edit.php?cid={$_GET['cid']}", '您未改动编辑留言，页面自动跳转中.....');
			exit();
		}
    	

    }

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>编辑留言 - 留言板</title>
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
					<img src="images/edit.gif">
				</p><br><br>
				<label for="title">标题：</label>
				<input type="text" id="title" name="title" value="<?php echo $data_sel_cont['title']?>" placeholder="不得超过15个字符"><br><br>
				<label for="content">内容：</label>
				<textarea name="content" id="content" placeholder="写下你的留言..."><?php echo $data_sel_cont['content']?></textarea><br><br>
				<label for="umum">验证码：</label><input name="unum" type="text" id="unum" size="10"><img src="inc/vcode.php" alt="验证码" title="点击刷新" id="vcode" ><br><br>
				<input type="submit" name="submit" id="sbutton" value="编辑留言">
			</form>
		</div>
		<?php include "inc/footer.inc.php";?>
	</div>
	
</body>
</html>