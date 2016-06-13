<?php
	//防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    //验证码
    function check_code($first_vcode, $end_code) {
        if (strtolower($first_vcode) != strtolower($end_code)) {
            skip('admin_login.php', '验证码错误，自动跳转中.....');
            exit();
        }
    }


?>