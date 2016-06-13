<?php
    //防止非法调用，需设置一个常量来授权
    if (!defined('ON')){
        exit('非法调用！！！');
    }  
     
    //跳转函数
	function skip($url, $msg) {
		$html = <<<EOT
		    <!DOCTYPE html>
		    <html>
		    <head>
			    <meta charset="UTF-8">
			    <meta http-equiv="refresh" content="3;url=$url"/>
			    <title>提示页</title>
			    <link rel="stylesheet" href="style/common.css">
		    </head>
		    <body>
		    	<div id="main">
		    		<div id="top">
						<div class="logo"><a href="index.php"></a></div>
						<div class="menu">
							<ul>
								<li>
									<a href="index.php"><img src="images/i2.gif"><br>浏览留言</a>
								</li>
								<li><a href="write.php"><img src="images/i1.gif"><br>签写留言</a></li>
								<li><a href="admin/admin_login.php"><img src="images/i3.gif"><br>管理留言</a></li>
							</ul>
						</div>
					</div>

					<div class="center">
						<div class="center-content">
							<p>{$msg}</p>
							<a href="{$url}">如果没有自动返回，请点击此处手动返回</a>	
						</div>
					</div>

			    	<div class="footer">
						Copyright © 2016 chyt. All rights reserved.
					</div>
		    	</div>
		    </body>
		    </html>
EOT;
       echo $html;
}


	 /**
     * vcode()是生成验证码函数
     * @access public
     * @param number $width 表示验证码的长度
     * @param number $height 表示验证码的高度
     * @param number $_rnd_num 表示验证码的位数
     * @param bool $_flag 表示验证码是否要边框
     * @return void 这个函数执行后返回一个验证码
     */
    function vcode($width = 75, $height = 23,  $_rnd_num = 4,
        $_flag = false){
        //创建随机码
        $_nmsg = null;
        for ($i = 0; $i < $_rnd_num; $i++) {
            $_nmsg .= dechex(mt_rand(0, 9));
        }
        //将随机码存放在session
        session_start();
        $_SESSION['code'] = $_nmsg;
    
        //创建画布
        $im = imagecreatetruecolor($width, $height);
    
        //设置颜色
        $color = imagecolorallocate($im, rand(200,255), rand(200,255), rand(150,255));
        $white = imagecolorallocate($im, 255, 255, 255);
    
        //填充背景颜色
        imagefill($im, 0, 0, $white);
    
        //设置边框
        if ($_flag) {
            $black = imagecolorallocate($im, 0, 0, 0);
            imagerectangle($im, 0, 0, $width-1, $height-1, $black);
        }
    
        //填充6条直线
        for ($i = 0; $i < 6; $i++) {
            $_rnd_color = imagecolorallocate($im, mt_rand(100, 255), mt_rand(100, 255), mt_rand(100, 255));
            imageline($im, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $_rnd_color);
        }
    
        //填充随机100个雪花
        for ($i = 0; $i < 100; $i++) {
            $_rnd_color = imagecolorallocate($im, mt_rand(150, 255), mt_rand(150, 255), mt_rand(150, 255));
            imagestring($im, 1, mt_rand(0, $width), mt_rand(0, $height), '*', $_rnd_color);
        }
    
        //输出验证码
        for ($i = 0; $i < strlen($_SESSION['code']); $i++) {
            $_rnd_color = imagecolorallocate($im, mt_rand(0, 150), mt_rand(0, 200), mt_rand(0, 150));
            imagestring($im, 5, mt_rand(1,10)+$i*$width/$_rnd_num, mt_rand(0,$height/2), $_SESSION['code'][$i], $_rnd_color);
            //imageTTFText($im, int size, int angle, int x, int y, int col, string fontfile, string text);
            //imagettftext($im, 5, rand(-5, 5), rand(1,10)+$i*$width/$_rnd_num, mt_rand(0,$height/2), $_rnd_color, "font/ManyGifts.ttf", $_SESSION['code'][$i]);
            
        }
    
        //输出图像
        header("Content-type:image/png");
        imagepng($im);
    
        //释放资源
        imagedestroy($im);
    }


     //login_state() 判断当前的登录状态（前台）
     
    function login_state($link){
        if (isset($_COOKIE['mb']['user']) && isset($_COOKIE['mb']['psw'])){
            $sql = "select * from member where name='{$_COOKIE['mb']['user']}' and psw='{$_COOKIE['mb']['psw']}'";
            $result = execute($link, $sql);
            if (mysqli_num_rows($result)) {
                $data = fetch_array($result);
                return $data['id'];
            }else{
                return false;
            }
        }else {
            return false;
        }
    }

    //manage_login_state() 判断当前的登录状态（后台）
    function manage_login_state($link){
        if (isset($_SESSION['admin']['name']) && isset($_SESSION['admin']['psw'])){
            $sql = "select * from admin where name='{$_SESSION['admin']['name']}' and psw='{$_SESSION['admin']['psw']}'";
            $result = execute($link, $sql);
            if (mysqli_num_rows($result) == 1) {
                return true;
            }else{
                return false;
            }
        }else {
            return false;
        }
    }

    /**
     * page() 分页函数
     * @param int $count 总记录数
     * @param int $page_size  每页显示的记录数
     * @param number $num_btn 要展示的页码按钮数目
     * @param string $page    分页的get参数
     * @return multitype:string    返回值：array('limit','html')
     */
    function page($count,$page_size,$num_btn=10,$page='page'){
        if(!isset($_GET[$page]) || !is_numeric($_GET[$page]) || $_GET[$page]<1){
            $_GET[$page]=1;
        }

        if ($count == 0) { //当版块没有帖子时,返回空数组
            $data=array(
                'limit'=>'',
                'html'=>''
            );
            return $data;
        }

        //总页数
        $page_num_all=ceil($count/$page_size);
        if($_GET[$page]>$page_num_all){
            $_GET[$page]=$page_num_all;
        }
        $start=($_GET[$page]-1)*$page_size;
        $limit="limit {$start},{$page_size}";
    
        $current_url=$_SERVER['REQUEST_URI'];//获取当前url地址
        $arr_current=parse_url($current_url);//将当前url拆分到数组里面
        $current_path=$arr_current['path'];//将文件路径部分保存起来
        $url='';
        if(isset($arr_current['query'])){
            parse_str($arr_current['query'],$arr_query);
            unset($arr_query[$page]);
            if(empty($arr_query)){
                $url="{$current_path}?{$page}=";
            }else{
                $other=http_build_query($arr_query);
                $url="{$current_path}?{$other}&{$page}=";
            }
        }else{
            $url="{$current_path}?{$page}=";
        }
        $html=array();
        if($num_btn>=$page_num_all){
            //把所有的页码按钮全部显示
            for($i=1;$i<=$page_num_all;$i++){//这边的$page_num_all是限制循环次数以控制显示按钮数目的变量,$i是记录页码号
                if($_GET[$page]==$i){
                    $html[$i]="<span>{$i}</span>";
                }else{
                    $html[$i]="<a href='{$url}{$i}'>{$i}</a>";
                }
            }
        }else{
            $num_left=floor(($num_btn-1)/2);
            $start=$_GET[$page]-$num_left;
            $end=$start+($num_btn-1);
            if($start<1){
                $start=1;
            }
            if($end>$page_num_all){
                $start=$page_num_all-($num_btn-1);
            }
            for($i=0;$i<$num_btn;$i++){
                if($_GET[$page]==$start){
                    $html[$start]="<span>{$start}</span>";
                }else{
                    $html[$start]="<a href='{$url}{$start}'>{$start}</a>";
                }
                $start++;
            }
            //如果按钮数目大于等于3的时候做省略号效果
            if(count($html)>=3){
                reset($html);
                $key_first=key($html);
                end($html);
                $key_end=key($html);
                if($key_first!=1){
                    array_shift($html);
                    array_unshift($html,"<a href='{$url}=1'>1</a>...");
                }
                if($key_end!=$page_num_all){
                    array_pop($html);
                    array_push($html,"<a href='{$url}={$page_num_all}'>{$page_num_all}</a>...");
                }
            }
        }
        if($_GET[$page]!=1){
            $prev=$_GET[$page]-1;
            array_unshift($html,"<a href='{$url}{$prev}'>上一页</a>");
        }
        if($_GET[$page]!=$page_num_all){
            $next=$_GET[$page]+1;
            array_push($html,"<a href='{$url}{$next}'>下一页</a>");
        }
        $html=implode(' ',$html);
        $data=array(
            'limit'=>$limit,
            'html'=>$html
        );
        return $data;
    }

?>