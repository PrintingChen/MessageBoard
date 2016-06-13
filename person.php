<?php
	//session_start();
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

    //当前用户信息
    $sql_mem = "select name from member where id={$member_id}";
    $res_mem = execute($link, $sql_mem);
    $data_mem = fetch_array($res_mem);

    //当前用户的留言总数
    $sql_count = "select * from message where mid={$member_id}";
    $counts = nums($link, $sql_count);
    $pageSize = 5;
    $pageCount = ceil($counts/$pageSize);
    //分页
    $page = page($counts, $pageSize);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $data_mem['name']?>个人中心 - 留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/person.css">
	<link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
	<div id="main">
		<?php include "inc/header.inc.php";?>
		<div id="list">
			<div class="person-left">
				<ul class="msg-list">
				<?php
				$sql = "select * from message where mid={$member_id} order by id desc {$page['limit']}";
				$res = execute($link, $sql);
				while($data = fetch_array($res)){
				?>
					<li>
						<a href="show.php?cid=<?php echo $data['id']?>" class="msg-title"><?php echo $data['title']?></a>
						<p class="msg-list-deta">
							<span>留言时间：<?php echo $data['content_time']?></span>
							<a href="edit.php?cid=<?php echo $data['id']?>" id="person-msg-edit">编辑</a> | 
							<a href="delete_person.php?cid=<?php echo $data['id']?>" id="person-msg-del" onclick="return confirm('确定要删除吗？');">删除</a>
						</p>
					</li>
				<?php }?>
				</ul>
				<div class="pages">
					留言总数：共 <?php echo $counts?> 条 <?php echo $page['html']?>　第[<?php echo $_GET['page']?>/<?php echo $pageCount?>]页
				</div>
			</div>
			<div class="person-right">
				<p class="head-photo"><img src="images/head.gif" alt="头像" title="头像" height="100"></p>
				<ul class="person-info">
					<li>昵称：<?php echo $data_mem['name']?></li>
					<li>留言总数：<?php echo $counts?></li>
					<li>操作：<a class="mdf-psw" href="modify_psw.php">修改密码</a></li>
				</ul>
			</div>
		</div>
		<?php include "inc/footer.inc.php";?>
	</div>
</body>
</html>