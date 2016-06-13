<div class="topbar-wrap white">
	<div class="logo">留言板后台管理系统</div>
	<div class="navigation">
		<ul>
			<li>欢迎您！</li>
			<?php
				if (isset($_SESSION['admin']['name']) && isset($_SESSION['admin']['psw']) ) {
					echo "<li class='name-manage'>{$_SESSION['admin']['name']}</li>";
				}else{
					echo "<script>alert('您还未登录');location.href='admin_login.php';</script>";
					exit();
				}
			?>
			
			<li><a class="modify-psw" href="">修改设置</a></li>
			<li><a class="logout" href="admin_logout.php">退出</a></li>
		</ul>
	</div>
</div>