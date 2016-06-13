<?php
	//防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    function check_reply_content($link, $data){
    	//去掉前后的空格
       $data = trim($data);
       //回复内容不得为空或大于255个字符
       if (empty($data)) {
            skip('reply.php', '回复内容不得为空');
            exit();
       }
       if (mb_strlen($data, 'utf-8') > 255) {
            skip('reply.php', '回复内容不得超过255个字符');
            exit();
       }
       
       return escape($link, $data);
    }

    //验证码
    function check_code_re($first_vcode, $end_code, $cid, $mid) {
        if (strtolower($first_vcode) != strtolower($end_code)) {
            skip("reply.php?cid=$cid&mid=$mid", '验证码错误，自动跳转中.....');
            exit();
        }
    }

?>