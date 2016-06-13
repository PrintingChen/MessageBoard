//alert(isNaN('1645'));
window.onload = function () {
	var oForm = document.getElementsByTagName('form')[0];
	oForm.onsubmit = function(){
		//验证标题
    	if(oForm.title.value.length == 0){
    		alert("标题不得为空");
    		oForm.title.focus();
    		return false;
    	};
    	if (oForm.title.value.length > 15) {
    		alert("标题长度不得超过15个字符");
    		oForm.title.focus();
    		return false;
    	};

    	//验证留言内容
    	if (oForm.content.value.length == 0) {
    		alert("留言内容不得为空");
    		oForm.content.focus();
    		return false;
    	};
    	if (oForm.content.value.length > 255) {
    		alert("留言长度不得超过255个字符");
    		oForm.content.focus();
    		return false;
    	};

    	//验证验证码
    	if (isNaN(oForm.unum.value)) {
    		alert("验证码必须是数字");
    		oForm.unum.focus();
    		return false;
    	};
    	if (oForm.unum.value.length != 4 ) {
    		alert("验证码长度必须为4位");
    		oForm.unum.focus();
    		return false;
    	};

        //验证明感词语
        var arr = ['反共', '反动', '暴力', '习近平', '胡景涛', '尼玛', '靠', '色情', '淫秽'];
        var oValT = oForm.title.value;
        var oValC = oForm.content.value;
        for(var i=0; i < arr.length; i++){ 
            var reg = new RegExp(arr[i]);
            if(reg.test(oValT)){
                alert('留言标题含有敏感词语\"'+arr[i]+'\"，请重新输入');
                oForm.title.focus();
                return false;
            }
            if(reg.test(oValC)){
                alert('留言内容含有敏感词语\"'+arr[i]+'\"，请重新输入');
                oForm.content.focus();
                return false;
            }
        }

    	return true;
	}


    //点击刷新验证码
    var oVcode = document.getElementById('vcode');
    oVcode.onclick = function(){
        this.src="inc/vcode.php?tm="+Math.random()+"";
    }

}