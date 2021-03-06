<?php
    session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once '../inc/common.inc.php';

    $link = connect();

    //重置密码
    $str = '111111a';
    $psw = md5($str);

    //判断获取过来的aid的合法性
    if (!isset($_GET['aid']) || !is_numeric($_GET['aid'])){
        echo "<script>alert('管理员id参数错误');location.href = 'manage.php';</script>";
		exit();
    };
	//查询是否存在aid对应的管理员信息
    $sql_sel_adm = "select * from admin where id={$_GET['aid']}";
    $result_sel_adm = execute($link, $sql_sel_adm);
    $data_sel_adm = fetch_array($result_sel_adm);
    if (mysqli_num_rows($result_sel_adm) == 0) {
        echo "<script>alert('不存在此管理员');location.href = 'manage.php';</script>";
		exit();
    }

    //重置密码
    $sql_rst = "update admin set psw='{$psw}' where id={$_GET['aid']}";
    execute($link, $sql_rst);
    if (mysqli_affected_rows($link)) {
        //清除SESSION
        session_unset(); //释放当前会话注册的所有会话变量
        session_destroy(); //销毁当前会话中的全部数据    
        setcookie(session_name(), '', time()-3600, '/'); //销毁保存在客户端的卡号

        echo "<script>alert('密码重置成功');location.href = 'manage.php';</script>";
        exit();
    }else {
        echo "<script>alert('已经重置过密码');location.href = 'manage.php';</script>";
        exit();
    }
?>