<?php 
	//session_start();
    header('Content-type:text/html;charset=utf-8');
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
?>
<div id="top">
	<div class="logo"><a href="../index.php"></a></div>
	<div class="menu">
		<ul>
			<li>
				<a href="../index.php"><img src="images/i2.gif"><br>浏览留言</a>
			</li>
			<li><a href="../write.php"><img src="images/i1.gif"><br>签写留言</a></li>
			<?php
			if (isset($_SESSION['admin']['name']) && isset($_SESSION['admin']['psw'])) {
				echo "<li><a href=''><img src='images/i3.gif'><br>退出管理</a></li>";
			}else{
				echo "<li><a href='admin_login.php'><img src='images/i3.gif'><br>管理留言</a></li>";
			}
			?>
		</ul>
	</div>
</div>