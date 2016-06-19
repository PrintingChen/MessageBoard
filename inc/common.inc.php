<?php

    header("content-type:text/html;charset=utf-8;");
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }
    //引入核心函数库
    require "mysql.func.php";
    require "global.inc.php";
    
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PWD', '');
    define('DB_DATABASE', 'message_board');
    define('DB_PORT', 3306);

    //设置时区
    date_default_timezone_set('PRC');
   


?>