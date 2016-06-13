<?php
	//防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }

    function check_title($link, $data){
       //去掉前后的空格
       $data_clean = trim($data);
       //标题不得为空或大于20个字符
       if (empty($data_clean)) {
            skip('edit.php', '留言标题不得为空');
            exit();
       }
       if (mb_strlen($data_clean, 'utf-8') > 15) {
            skip('edit.php', '留言标题不得超过15个字符');
            exit();
       }

       return escape($link, $data_clean);
    }


    function check_content($link, $data){
      //去掉前后的空格
       $data_clean = trim($data);

       if (empty($data_clean)) {
            skip('edit.php', '留言内容不得为空');
            exit();
       }
       if (mb_strlen($data_clean, 'utf-8') > 255) {
            skip('edit.php', '留言内容不得超过255个字符');
            exit();
       }
       
       return escape($link, $data_clean);
    }

    //验证码
    function check_code($first_vcode, $end_code) {
        if (strtolower($first_vcode) != strtolower($end_code)) {
            skip("edit.php?cid={$_GET['cid']}", '验证码错误，页面跳转中.....');
            exit();
        }
    }

?>