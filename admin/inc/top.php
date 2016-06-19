<div class="topbar-wrap white">
	<div class="logo">留言板后台管理系统</div>
	<div class="navigation">
		<ul>
			<li>上次登录时间：<?php echo $_SESSION['last_login_time']?></li>
			<li><a class="home" href="../index.php" target="_blank">网站首页</a></li>
			<li>欢迎您！</li>
			<?php
				if (isset($_SESSION['admin']['name']) && isset($_SESSION['admin']['psw']) ) {
					echo "<li class='name-manage'>{$_SESSION['admin']['name']}</li>";
				}else{
					echo "<script>alert('您还未登录');location.href='admin_login.php';</script>";
					exit();
				}
			?>
			
			<li><a class="modify-psw" href="modify_adm_psw.php">修改密码</a></li>
			<li><a class="logout" href="admin_logout.php">退出</a></li>
		</ul>
	</div>
</div>