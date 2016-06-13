window.onload = function () {
	var oLogout = document.getElementsByClassName('logout')[0];
	oLogout.onclick = logout;
	
	function logout(){
		if (confirm("确定要退出吗？")) {
			return true;
		}else{
			return false;
		}
	}

}