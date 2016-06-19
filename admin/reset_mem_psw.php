<?php
    session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    //重置密码
    $str = '000000a';
    $psw = md5($str);

    //判断获取过来的aid的合法性
    if (!isset($_GET['mid']) || !is_numeric($_GET['mid'])){
        echo "<script>alert('用户id参数错误');location.href = 'member_manage.php';</script>";
		exit();
    };
	//查询是否存在cid对应的用户信息
    $sql_sel_mem = "select * from member where id={$_GET['mid']}";
    $result_sel_mem = execute($link, $sql_sel_mem);
    $data_sel_mem = fetch_array($result_sel_mem);
    if (mysqli_num_rows($result_sel_mem) == 0) {
        echo "<script>alert('不存在此用户');location.href = 'member_manage.php';</script>";
		exit();
    }

    //重置密码
    $sql_rst = "update member set psw='{$psw}' where id={$_GET['mid']}";
    execute($link, $sql_rst);
    if (mysqli_affected_rows($link)) {
        echo "<script>alert('密码重置成功');location.href = 'member_manage.php';</script>";
        exit();
    }else {
        echo "<script>alert('密码重置失败');location.href = 'member_manage.php';</script>";
        exit();
    }
?>