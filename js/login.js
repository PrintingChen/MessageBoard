window.onload = function(){

	var oForm = document.getElementsByTagName('form')[0];
	oForm.onsubmit = function(){
		//登录名验证
		if (oForm.user.value.length == 0) {
			alert("用户登录名不得为空");
			oForm.user.focus();
			return false;
		};

		//密码验证
		if (oForm.psw.value.length == 0) {
			alert("用户登录密码不得为空");
			oForm.psw.focus();
			return false;
		};

		//验证验证码
    	if (isNaN(oForm.nmun.value)) {
    		alert("验证码必须是数字");
    		oForm.nmun.focus();
    		return false;
    	};
    	if (oForm.nmun.value.length != 4 ) {
    		alert("验证码长度必须为4位");
    		oForm.nmun.focus();
    		return false;
    	};

		return true;
	}

	//点击刷新验证码
    var oVcode = document.getElementById('vcode');
    oVcode.onclick = function(){
        this.src="inc/vcode.php?tm="+Math.random()+"";
    }

}