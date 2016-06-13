window.onload = function () {
	var oForm = document.getElementsByTagName('form')[0];
	oForm.onsubmit = function(){
		if (oForm.name.value.length == 0) {
			alert("管理员名称不得为空");
			oForm.name.focus();
			return false;
		};
		if (oForm.name.value.length > 15) {
			alert("管理员名称长度不得超过15个字符");
			oForm.name.focus();
			return false;
		};
		//用户名不得包含一些敏感的字符
    	if(/[<>\'\"\ \	\!\#\*\&\^\$\~\`\/\\\，\。\：\；]/i.test(oForm.name.value)){
    		alert("管理员名称不得包含一切符号明感字符");
    		oForm.name.focus();
    		return false;
    	}

    	if (oForm.psw.value.length < 6) {
			alert("密码长度不得少于6个字符");
			oForm.psw.focus();
			return false;
		};
		if (oForm.psw.value.length > 15) {
			alert("密码长度不得超过15个字符");
			oForm.psw.focus();
			return false;
		};
		//密码必须是字母，数字或者下划线的组合
    	if(!(/^\w+$/g.test(oForm.psw.value))){
    		alert("密码必须包含字母，数字或者下划线");
    		oForm.psw.focus();
    		return false;
    	}
    	//密码不能全为数字
    	if(/^\d+$/.test(oForm.psw.value)){
    		alert("密码不能为全数字");
    		oForm.psw.focus();
    		return false;
    	}
    	//原密码和确认密码必须一致
    	if(oForm.psw.value != oForm.re_psw.value){
    		alert("两次密码不一致");
    		oForm.re_psw.focus();
    		return false;
    	}

    	return true;
	}
}