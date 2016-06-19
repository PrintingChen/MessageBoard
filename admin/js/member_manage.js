window.onload = function(){
	var oDel = document.getElementsByClassName('del_mem');
	for (var i = 0; i < oDel.length; i++) {
		oDel[i].onclick = del;
	};
	var oRst = document.getElementsByClassName('reset-mem-psw');
	for (var i = 0; i < oRst.length; i++) {
		oRst[i].onclick = reset;
	};

	function reset(){
		if (confirm("确定要重置密码吗？")) {
			return true;
		}else{
			return false;
		}
	}
	
	function del(){
		if (confirm("确定要删除吗？")) {
			return true;
		}else{
			return false;
		}
	}
}