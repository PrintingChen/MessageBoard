window.onload = function(){

	var oForm = document.getElementsByTagName('form')[0];
	oForm.onsubmit = function(){
        //原密码验证
        if (oForm.opsw.value.length == 0) {
            alert("原密码不得为空");
            oForm.opsw.focus();
            return false;
        };
    	//新密码验证
    	if (oForm.npsw.value.length < 6) {
			alert("密码长度不得少于6个字符");
			oForm.npsw.focus();
			return false;
		};
		if (oForm.npsw.value.length > 15) {
			alert("密码长度不得超过15个字符");
			oForm.npsw.focus();
			return false;
		};
		//密码必须是字母，数字或者下划线的组合
    	if(!(/^\w+$/g.test(oForm.npsw.value))){
    		alert("密码必须包含字母，数字或者下划线");
    		oForm.npsw.focus();
    		return false;
    	}
    	//密码不能全为数字
    	if(/^\d+$/.test(oForm.npsw.value)){
    		alert("密码不能为全数字");
    		oForm.npsw.focus();
    		return false;
    	}
    	//新密码和确认密码必须一致
    	if(oForm.npsw.value != oForm.renpsw.value){
    		alert("两次密码不一致");
    		oForm.renpsw.focus();
    		return false;
    	}

		return true;
	}
    
}