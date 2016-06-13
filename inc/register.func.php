<?php
	//防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    function check_user($link, $data){
       //去掉前后的空格
       $data = trim($data);
       //长度不得小于$_min_num位或大于$_max_num位
       if ( empty($data) || mb_strlen($data, 'utf-8') > 20 ) {
           skip('register.php', '用户名不得为空或大于15个字符，自动跳转中.....');
           exit();
       }
       //限制敏感字符
       $pattern = '/[<>\'\"\ \	]/';
       if ( preg_match($pattern, $data) ) {
           skip('register.php', '用户名不能包含敏感字符，自动跳转中.....');
           exit();
       }
       return escape($link, $data);
    }

    function check_psw($link, $data){
        //密码长度不得小于6位或大于15位
        if ( mb_strlen($data, 'utf-8') < 6 || mb_strlen($data, 'utf-8') > 20 ) {
            skip('register.php', '密码长度不得小于6位或大于15位，自动跳转中.....');
            exit();
        }
        //密码必须是字母，数字或者下划线的组合
        $pattern1 = '/^\w+$/';
        if(!preg_match($pattern1, $data)){
            skip('register.php', '密码必须是字母，数字或者下划线，自动跳转中.....');
            exit();
        }
        return escape($link, md5($data));
    }

    //验证码
    function check_code($first_vcode, $end_code) {
        if (strtolower($first_vcode) != strtolower($end_code)) {
            skip('register.php', '验证码错误，自动跳转中.....');
            exit();
        }
    }

?>