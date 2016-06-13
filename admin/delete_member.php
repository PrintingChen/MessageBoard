<?php
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    //判断获取过来的用户mid的合法性
    if (!isset($_GET['mid']) || !is_numeric($_GET['mid'])){
        echo "<script>alert('用户mid参数错误');location.href = 'member_manage.php';</script>";
		exit();
    };
	//查询是否存在mid对应的留言信息
    $sql_sel_mem = "select * from member where id={$_GET['mid']}";
    $result_sel_mem = execute($link, $sql_sel_mem);
    $data_sel_mem = fetch_array($result_sel_mem);
    if (mysqli_num_rows($result_sel_mem) == 0) {
        echo "<script>alert('不存在此用户');location.href = 'member_manage.php';</script>";
		exit();
    }

    $sql_del = "delete from member where id={$_GET['mid']}";
    execute($link, $sql_del);
    if (mysqli_affected_rows($link)) {
		echo "<script>alert('删除成功');location.href = 'member_manage.php';</script>";
		exit();
	}else {
		echo "<script>alert('删除失败');location.href = 'member_manage.php';</script>";
		exit();
	}

?>