<?php
	//session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();

    //判断是否登录状态
    $member_id = login_state($link);

    //判断获取过来的留言id的合法性
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip('index.php', '留言id参数错误，页面自动跳转中.....');
        exit();
    };

    /*//判断获取过来的回复留言者mid的合法性
    if (!isset($_GET['mid']) || !is_numeric($_GET['mid'])){
        skip('index.php', 'id参数错误，页面自动跳转中.....');
        exit();
    };
*/
	//查询是否存在cid对应的留言信息
    $sql_sel_cont = "select * from message where id={$_GET['cid']}";
    $result_sel_cont = execute($link, $sql_sel_cont);
    $data_sel_cont = fetch_array($result_sel_cont);
    if (mysqli_num_rows($result_sel_cont) == 0) {
        skip('index.php', '这条留言帖信息不存在，页面自动跳转中.....');
        exit();
    }

    /*//查询是否存在mid对应的留言信息
    $sql_sel_memeber = "select * from member where id={$_GET['mid']}";
    $result_sel_memeber = execute($link, $sql_sel_memeber);
    $data_sel_memeber = fetch_array($result_sel_memeber);
    if (mysqli_num_rows($result_sel_memeber) == 0) {
        skip('index.php', '这条留言帖信息不存在，页面自动跳转中.....');
        exit();
    }*/

    //分页
	$sql_count = "select * from reply where content_id={$_GET['cid']}";
	$result_count = execute($link, $sql_count);
	$counts = mysqli_num_rows($result_count);
	$page_size = 2;
	$pageCount = ceil($counts/$page_size);
    $page = page($counts, $page_size);
	

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言详情 - 留言板</title>
	<link rel="stylesheet" type="text/css" href="style/common.css">
	<link rel="stylesheet" type="text/css" href="style/show.css">
	<link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
	<div id="main">
		<?php include "inc/header.inc.php";?>
		<div class="main-wrapper">
			<div class="show-content">
				<div class="show-top">
					<p class="show-content-top">
						<span class="show-content-title">标题：<?php echo $data_sel_cont['title']?></span>
						<span class="show-content-time on">发布于：<?php echo $data_sel_cont['content_time']?></span>
						<span class="reply-btn"><a href="reply.php?cid=<?php echo $_GET['cid']?>&mid=<?php echo $member_id?>">回复</a></span>
						<i class="landlord">楼主</i>
					</p>
					<p class="content-area"><?php echo $data_sel_cont['content']?></p>
				</div>
				<?php 
					$sql_reply = "select * from reply where content_id={$_GET['cid']} {$page['limit']}";
					$result_reply = execute($link, $sql_reply);
					while ($data_reply = fetch_array($result_reply)){
						//查询对应的回复者信息
						$sql_mem = "select name from member where id={$data_reply['member_id']}";
						$result_mem = execute($link, $sql_mem);
						$data_mem = fetch_array($result_mem);
				?>
				<div class="show-top">
					<p class="show-content-top">
						<span class="show-content-title">回复者：<span style="color:#f40;"><?php echo $data_mem['name']?></span></span>
						<span class="show-content-time reference-reply">回复时间：<?php echo $data_reply['reply_time']?></span>
						<span class="reference"><a href="quote.php?cid=<?php echo $_GET['cid']?>&qid=<?php echo $data_reply['id']?>&mid=<?php echo $data_reply['member_id']?>">引用</a></span>
					</p>
					<?php if($data_reply['quote_id']){
							$sql_sel = "select r.content_reply,m.name from reply r,member m where r.id={$data_reply['quote_id']} and m.id=r.member_id";
							$result = execute($link, $sql_sel);
							$data = fetch_array($result);
					?>
					<div class="reference-reply-content">
						<p class="reference-reply-content-title">引用 <span style="color:#f40;"><?php echo $data['name']?></span> 回复的：</p>
						<p class="reply-content"><?php echo $data['content_reply']?></p>
					</div>
					<?php }?>
					<p class="content-area">
						<?php echo $data_reply['content_reply']?>
					</p>
				</div>
				<?php }?>
			</div>
		</div>
		<div id="pages" class="page-show" align="center">
			回复总数：共 <?php echo $counts?> 条 <?php echo $page['html']?>　第[<?php echo $_GET['page']?>/<?php echo $pageCount?>]页
		</div>
		<?php include "inc/footer.inc.php";?>
	</div>
</body>
</html>