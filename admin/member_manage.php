<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';
    //数据库连接
    $link = connect();
    //用户总数
    $sql_count = "select * from member";
    $counts = nums($link, $sql_count);
    $pageSize = 5;
    $pageCount = ceil($counts/$pageSize);
    //分页
    $page = page($counts, $pageSize);
    //批量删除
    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	foreach ($id as $key => $value) {
    		$sql_del = "delete from member where id={$value}";
    		execute($link, $sql_del);
    	}
    	if (mysqli_affected_rows($link)) {
			echo "<script>alert('删除成功');</script>";
		}else {
			echo "<script>alert('删除失败');</script>";
		}
    }
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理中心</title>
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/add_manage.css">
	<link rel="stylesheet" href="style/member_manage.css">
	<script src="js/jquery-1.12.2.min.js"></script>
	<script src="js/member_manage.js"></script>
	<script src="js/comm.js"></script>
</head>
<body>
	<?php include "inc/top.php";?>
	<div class="container clearfix">
		<?php include "inc/slide.php";?>
		<div class="main-wrap">
			<div class="crumb-wrap">
				<div class="crumb-list">
					<i><img src="images/position.png" alt=""></i>
					<a href="index.php" color="#white">首页</a>
					<span class="crumb-step">&gt;</span>
					<span class="crumb-name">用户管理</span>
				</div>
			</div>
			<div class="table">
				<div class="del">
					<span class="sel-all comm">全选</span>
				</div>
				<form method="post" class="myform">
					<input type="submit" name="submit" class="del-all" value="批量删除" onclick="return confirm('确定要删除吗？');">
					<table class="insert-tab">
						<tr class="bg-color">
							<td>选中</td>
							<td>ID</td>
							<td>用户名</td>
							<td>注册时间</td>
							<td>上次登录时间</td>
							<td>操作</td>
						</tr>
						<?php
						$sql_member = "select * from member order by id desc {$page['limit']}";
						$res_mem = execute($link, $sql_member);
						while ($data_mem = fetch_array($res_mem)) {

						?>
						<tr>
							<td><input type="checkbox" value="<?php echo $data_mem['id']?>" name="id[]"></td>
							<td><?php echo $data_mem['id']?></td>
							<td><?php echo $data_mem['name']?></td>
							<td><?php echo $data_mem['register_time']?></td>
							<td><?php echo $data_mem['last_login_time']?></td>
							<td><a class="reset-mem-psw" href="reset_mem_psw.php?mid=<?php echo $data_mem['id']?>">重置密码</a>&nbsp;&nbsp;<a class="del_mem" href="delete_member.php?mid=<?php echo $data_mem['id']?>">删除</a></td>
						</tr>
						<?php }?>
						
					</table>
				</form>
			</div>
			<div id="pages">
				用户总数：共 <?php echo $counts?> 条 <?php echo $page['html']?>　第[<?php echo $_GET['page']?>/<?php echo $pageCount?>]页
			</div>
		</div>
	</div>
</body>
</html>