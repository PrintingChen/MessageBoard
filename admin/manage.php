<?php
	session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();
    //echo basename($_SERVER['SCRIPT_NAME']);exit();

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理中心</title>
	<link rel="stylesheet" href="style/main.css">
	<link rel="stylesheet" href="style/add_manage.css">
	<link rel="stylesheet" href="style/member_manage.css">
	<script src="js/manage.js"></script>
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
					<span class="crumb-name">管理员操作</span>
				</div>
			</div>
			<div class="table">
				<div class="del">
					<span class="sel-all comm"><a href="" onclick="checkAll()">全选</a></span>
					<span class="del-all comm"><a href="">批量删除</a></span>
				</div>
				<form action="" class="myform">
					<table class="insert-tab">
						<tr class="bg-color">
							<td width="10%">选中</td>
							<td width="10%">ID</td>
							<td width="15%">用户名</td>
							<td width="20%">添加时间</td>
							<td width="20%">操作</td>
						</tr>
						<?php
						$sql_adm = "select * from admin order by id desc";
						$res_adm = execute($link, $sql_adm);
						if(mysqli_num_rows($res_adm)){
							while ($data_adm = fetch_array($res_adm)) {
						?>
						<tr>
							<td><input class="cbx" type="checkbox" name="cbx" value="adm[]"></td>
							<td><?php echo $data_adm['id']?></td>
							<td><?php echo $data_adm['name']?></td>
							<td><?php echo $data_adm['insert_time']?></td>
							<td><a class="reset-adm-psw" style="padding-right:5px;" href="reset_adm_psw.php?aid=<?php echo $data_adm['id']?>">重置密码</a><a class="del_adm" href="delete_manage.php?aid=<?php echo $data_adm['id']?>">删除</a></td>
						</tr>
						<?php }
							}else{
								echo "<tr><td>暂无记录</td><td></td><td></td><td></td><td></td></tr>";
							}
						?>
						
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>