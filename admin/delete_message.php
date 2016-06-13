<?php
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    //判断获取过来的用户mid的合法性
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        echo "<script>alert('留言id参数错误');location.href = 'message_manage.php';</script>";
		exit();
    };
	//查询是否存在cid对应的留言信息
    $sql_sel_msg = "select * from message where id={$_GET['cid']}";
    $result_sel_msg = execute($link, $sql_sel_msg);
    $data_sel_msg = fetch_array($result_sel_msg);
    if (mysqli_num_rows($result_sel_msg) == 0) {
        echo "<script>alert('不存在此留言');location.href = 'message_manage.php';</script>";
		exit();
    }

    $sql_del = "delete from message where id={$_GET['cid']}";
    execute($link, $sql_del);
    if (mysqli_affected_rows($link)) {
		echo "<script>alert('删除成功');location.href = 'message_manage.php';</script>";
		exit();
	}else {
		echo "<script>alert('删除失败');location.href = 'message_manage.php';</script>";
		exit();
	}

?>