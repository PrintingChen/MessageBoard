<div class="sidebar-wrap">
	<div class="sidebar-title">
		<h3>系统管理</h3>
	</div>
	<div class="sidebar-content">
        <ul class="sidebar-list">
            <li class="tab"> <a <?php if (basename($_SERVER['SCRIPT_NAME'])=='index.php'){echo "id='current'";}?> href="index.php" class="sys-info" id="pic">系统信息</a></li>
            <li class="tab"><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='add_manage.php'){echo "id='current'";}?> href="add_manage.php" class="add-mng" id="pic">添加管理员</a></li>
            <li class="tab"><a <?php if (basename($_SERVER['SCRIPT_NAME'])=='manage.php'){echo "id='current'";}?> href="manage.php" class="mng" id="pic">管理员</a></li>
        </ul>
	</div>
	<div class="sidebar-title">
		<h3>内容管理</h3>
	</div>
	<div class="sidebar-content">
        <ul class="sidebar-list">
            <li class="tab"> <a <?php if (basename($_SERVER['SCRIPT_NAME'])=='message_manage.php'){echo "id='current'";}?> href="message_manage.php" class="ly-info" id="pic">留言管理</a></li>
            <li class="tab"> <a <?php if (basename($_SERVER['SCRIPT_NAME'])=='reply_manage.php'){echo "id='current'";}?> href="reply_manage.php" class="rpy-info" id="pic">回复管理</a></li>
	</div>
	<div class="sidebar-title">
		<h3>用户管理</h3>
	</div>
	<div class="sidebar-content">
        <ul class="sidebar-list">
            <li class="tab"> <a <?php if (basename($_SERVER['SCRIPT_NAME'])=='member_manage.php'){echo "id='current'";}?> href="member_manage.php" class="member-info" id="pic">用户管理</a></li>
        </ul>
	</div>
</div>