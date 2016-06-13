window.onload = function() {
	var oForm = document.getElementsByTagName('form')[0];
	oForm.onsubmit = function(){
		if (oForm.reply_content.value.length == 0) {
			alert("回复的内容不得为空");
			oForm.reply_content.focus();
			return false;
		};
		if (oForm.reply_content.value.length > 255) {
			alert("回复的内容长度不得超过255个字符");
			oForm.reply_content.focus();
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
        var arr = ['反共', '反动', '暴力', '习近平', '胡景涛', '尼玛', '靠'];
        var oValC = oForm.reply_content.value;
        for(var i=0; i < arr.length; i++){ 
            var reg = new RegExp(arr[i]);
            if(reg.test(oValC)){
                alert('留言内容含有敏感词语\"'+arr[i]+'\"，请重新输入');
                oForm.reply_content.focus();
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