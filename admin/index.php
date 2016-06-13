<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    //查询总管理员数量
    $sql_adm = "select * from admin";
    $res_adm = execute($link, $sql_adm);
    $data_adm = fetch_array($res_adm);
    $count_adm = mysqli_num_rows($res_adm);
    
    //查询总用户数量
    $sql_mem = "select * from member";
    $count_mem = nums($link, $sql_mem);

    //查询总留言数量
    $sql_msg = "select * from message";
    $count_msg = nums($link, $sql_msg);

    //查询总回复留言数量
    $sql_rep= "select * from reply";
    $count_rep = nums($link, $sql_rep);

   

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理中心</title>
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/index.css">
	<script src="js/common.js"></script>
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
					<span class="crumb-name">系统信息</span>
				</div>
			</div>
			<div class="sys-idx">
				欢迎您，<?php echo $_SESSION['admin']['name']?>
				<ul class="list-info">
					<li>添加时间：<?php echo $data_adm['insert_time']?></li>
					<li>管理员总数：<?php echo $count_adm ?></li>
					<li>用户总数：<?php echo $count_mem ?></li>
					<li>留言总数：<?php echo $count_msg ?></li>
					<li>留言回复总数：<?php echo $count_rep ?></li>
					<li>服务器操作系统：<?php echo PHP_OS?> </li>
					<li>服务器软件：<?php echo $_SERVER['SERVER_SOFTWARE']?> </li>
					<li>MySQL 版本：<?php echo  mysqli_get_server_info($link)?></li>
					<li>PHP 版本：<?php echo phpversion()?></li>
					<li>最大上传文件：<?php echo ini_get('upload_max_filesize')?></li>
					<li>内存限制：<?php echo ini_get('memory_limit')?></li>
					<li><a target="_blank" href="phpinfo.php" style="color:#06c;">PHP 配置信息</a></li>
					<li>系统名称：留言板</li>
				    <li>系统开发者：chyt</li>
				    <li>网站域名：暂无</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>