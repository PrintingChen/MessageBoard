window.onload = function () {
	var oDel = document.getElementsByClassName('del_adm');
	for (var i = 0; i < oDel.length; i++) {
		oDel[i].onclick = del;
	};
	
	var oRst = document.getElementsByClassName('reset-adm-psw');
	for (var i = 0; i < oRst.length; i++) {
		oRst[i].onclick = reset;
	};

	//全选
	
	
	/*selAll.onclick = function(){
		for (var i = 0; i < cbxs.length; i++) {
			if(cbxs[i].type=="checkbox") { 
				cbxs[i].checked = true; 
			}

		};
	}*/

	

	function del(){
		if (confirm("确定要删除吗？")) {
			return true;
		}else{
			return false;
		}
	}

	function reset(){
		if (confirm("确定要重置密码吗？")) {
			return true;
		}else{
			return false;
		}
	}
}