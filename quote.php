<?php
    session_start();
	//定义常量ON来获取访问页面的权限 
    define('ON', true);
    //引入公共文件
    require_once 'inc/common.inc.php';
    
    $link = connect();

    //判断当前是否为登录状态
    if (!$member_id = login_state($link)){
        skip('login.php', '您还未登录无法进行回复留言，页面跳转中.....');
        exit();
    }

    //判断获取过来的留言id的合法性
    if (!isset($_GET['cid']) || !is_numeric($_GET['cid'])){
        skip('index.php', '留言id参数错误，页面自动跳转中.....');
        exit();
    };

    //判断获取过来的留言者id的合法性
    if (!isset($_GET['mid']) || !is_numeric($_GET['mid'])){
        skip('index.php', '留言者id参数错误，页面自动跳转中.....');
        exit();
    };
    
    //查询是否存在cid对应的留言信息
    $sql_sel_cont = "select * from message where id={$_GET['cid']}";
    $result_sel_cont = execute($link, $sql_sel_cont);
    $data_sel_cont = fetch_array($result_sel_cont);
    if (mysqli_num_rows($result_sel_cont) == 0) {
        skip('index.php', '这条留言帖信息不存在，页面自动跳转中.....');
        exit();
    }

    //查询是否存在mid对应的留言信息
    $sql_sel_mem = "select * from member where id={$_GET['mid']}";
    $result_sel_mem = execute($link, $sql_sel_mem);
    $data_sel_mem = fetch_array($result_sel_mem);
    if (mysqli_num_rows($result_sel_mem) == 0) {
        skip('index.php', '这个留言者帖信息不存在，页面自动跳转中.....');
        exit();
    }

    /*验证qid*/
    if (!isset($_GET['qid']) || !is_numeric($_GET['qid'])){
        skip('index.php', '您要引用的回复id参数不合法，页面自动跳转中.....');
        exit();
    }
    $sql_cont = "select * from reply where id={$_GET['qid']} and content_id={$_GET['cid']}";
    $result_cont = execute($link, $sql_cont);
    $data_cont = fetch_array($result_cont);
    if (mysqli_num_rows($result_cont) == 0) {
        skip('index.php', '您要引用回复子不存在，页面自动跳转中.....');
        exit();
    }

    //处理提交的数据
    if (isset($_POST['submit'])) {
        //引入验证文件
        include 'inc/reply.func.php';
        $clean = array();
        $clean['content_reply'] = check_reply_content($link, $_POST['reply_content']);
        check_code_re($_POST['unum'], $_SESSION['code'], $_GET['cid'], $_GET['mid']);

        $sql_ins = "insert into reply(content_id,content_reply,member_id,quote_id,reply_time) values({$_GET['cid']}, '{$clean['content_reply']}', $member_id, {$_GET['qid']}, now())";
        execute($link, $sql_ins);
        if (mysqli_affected_rows($link)) {
                skip("show.php?cid={$_GET['cid']}&qid={$_GET['qid']}&mid={$_GET['mid']}", '回复留言成功，页面自动跳转中.....');
                exit();
            }else{
                skip("reply.php?cid={$_GET['cid']}&mid={$_GET['mid']}", '回复留言失败，页面自动跳转中.....');
                exit();
            }

    }
   

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>回复留言 - 留言板</title>
    <link rel="stylesheet" type="text/css" href="style/common.css">
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <link rel="stylesheet" type="text/css" href="style/reply.css">
    <link rel="shortcut icon" href="images/favicon.ico">
    <script src="js/reply.js"></script>
</head>
<body>
    <div id="main">
        <?php include "inc/header.inc.php";?>
        <div id="list">
            <div id="list-main">
                <p class="pic">
                    <img src="images/i1.gif" alt="">
                    <img class="edit" src="images/edit.png" alt="">
                </p>
                <div class="list-main-box">
                    <div class="wrapper">
                        <p class="reply_title">引用由 <span><?php echo $data_sel_mem['name']?></span> 回复的：</p>
                        <p class="cont"><?php echo $data_cont['content_reply']?></p>
                    </div>
                    <form action="" method="post">
                        <textarea name="reply_content" placeholder="回复内容长度不得超过255个字符....."></textarea><br>
                        <input name="unum" type="text" id="unum" size="10"><img src="inc/vcode.php" alt="验证码" title="点击刷新" id="vcode"><br>
                        <input type="submit" class="reply_btn" name="submit" value="回复留言">
                    </form>
               </div>
            </div>
        </div>
        <?php include "inc/footer.inc.php";?>
    </div>
</body>
</html>