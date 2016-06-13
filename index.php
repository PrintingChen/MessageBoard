<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';

    $link = connect();
    //判断是否登录状态
    $member_id = login_state($link);

    //留言总数
    $sql_count = "select * from message";
    $counts = nums($link, $sql_count);
    $pageSize = 5;
    $pageCount = ceil($counts/$pageSize);
    //分页
    $page = page($counts, $pageSize);
	
    //处理提交的数据
    if (isset($_POST['submit'])) {
    	//引入验证文件
    	include 'inc/write.func.php';
    	$clean = array();
    	$clean['title'] = check_title($link, $_POST['title']);


		if (is_file("sensitive.txt")) {
			//读取文件
			$str =  file_get_contents("sensitive.txt");
			//将字符串分割成数组
			$arr_words = explode("\r\n", $str);
			//获取留言内容
			$content = $_POST['content'];
			for ($i=0; $i < count($arr_words); $i++) { 
				if (preg_match("/".trim($arr_words[$i])."/", $content)) {
					skip('index.php', '不得包含敏感词，页面跳转中.....');
					exit();
				}
			}
		}
    	$clean['content'] = check_content($link, $_POST['content']);
    	check_code($_POST['unum'], $_SESSION['code']);

    	if ($member_id) {
    		$sql = "insert into message(mid,title,content,content_time) values({$member_id}, '{$clean['title']}', '{$clean['content']}', now())";
    		execute($link, $sql);
    		if (mysqli_affected_rows($link)) {
    			skip('index.php', '发布留言成功，页面自动跳转中.....');
				exit();
    		}else{
    			skip('index.php', '发布留言失败，页面自动跳转中.....');
				exit();
    		}
    	}else{
    		skip('login.php', '您还未登录，不能发布留言，页面自动跳转中.....');
			exit();
    	}

    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/index.css">
	<link rel="shortcut icon" href="images/favicon.ico">
	<script src="js/index.js"></script>
</head>
<body>
	<div id="main">
		<?php include "inc/header.inc.php";?>
		<div id="list">
			<div id="list-main">
			<?php
				$sql = "select id,mid,content,title,content_time from message order by id desc {$page['limit']}";
				$result = execute($link, $sql);
				while ($data = fetch_array($result)) {
					$data['title'] = htmlspecialchars($data['title']);
					$data['content'] = nl2br($data['content']);
					//用户信息
				    $sql_mem = "select * from member where id={$data['mid']}";
				    $result_mem = execute($link, $sql_mem);
				    $data_mem = fetch_array($result_mem);
			?>
				<h2>
					<span class="left-area">
						<img src="images/icon_write.gif">
						标题：<a href="show.php?cid=<?php echo $data['id']?>"><?php echo $data['title']?></a>
						<font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#f40;font-weight:bold;"><?php echo $data_mem['name']?></span> 于<?php echo $data['content_time']?> 发表留言：</font>
						<img src="images/new.gif">
					</span>
					<span class="mid-area"></span>
					<span class="right-area"><a href="reply.php?cid=<?php echo $data['id']?>&mid=<?php echo $data_mem['id']?>">回复</a></span>
				</h2>
				<div class="content">
					<?php echo $data['content']?>
				</div>
			<?php }?>

			</div>
		</div>
		
		<div id="pages" align="center">
			留言总数：共 <?php echo $counts?> 条 <?php echo $page['html']?>　第[<?php echo $_GET['page']?>/<?php echo $pageCount?>]页
		</div>

		<div id="submit">
			<form action="" method="post">
				<p>
					<img src="images/i1.gif">
					<img src="images/add.gif">
				</p><br><br>
				<label for="user">标题：</label>
				<input type="text" id="title" name="title" value="" placeholder="不得超过15个字符"><br><br>
				<label for="content">内容：</label>
				<textarea name="content" id="content" placeholder="留言内容长度不得超过255个字符..."></textarea><br><br>
				<label for="umum">验证码：</label><input name="unum" type="text" id="unum" size="10"><img src="inc/vcode.php" alt="验证码" title="点击刷新" id="vcode"><br><br>
				<input type="submit" name="submit" id="sbutton" value="发布留言">
			</form>
		</div>

		<?php include "inc/footer.inc.php";?>
	</div>
</body>
</html>