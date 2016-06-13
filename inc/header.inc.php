<?php 
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
?>
<div id="top">
	<div class="logo"><a href="index.php"></a></div>
	<div class="menu">
		<ul>
			<li>
				<a href="index.php"><img src="images/i2.gif"><br>浏览留言</a>
			</li>
			<li><a href="write.php"><img src="images/i1.gif"><br>签写留言</a></li>
			<?php
			if (!isset($_COOKIE['mb']['user']) && !isset($_COOKIE['mb']['psw'])) {
				echo "<li><a href='register.php'><img src='images/register.png' width='36' height='36'><br>用户注册</a></li>";
				echo "<li><a href='login.php'><img src='images/login.png' width='36' height='36'><br>用户登录</a></li>";
			}else{
				echo "<li><a href='person.php'><img src='images/person.png' width='36' height='36'><br>个人中心</a></li>";
				echo "<li><a href='logout.php'><img src='images/logout.png' width='36' height='36'><br>退出登录</a></li>";
			}
			?>
			<li><a href="admin/admin_login.php"><img src="images/i3.gif"><br>管理留言</a></li>
		</ul>
	</div>
</div>