window.onload = function(){
	var oDel = document.getElementsByClassName('del_mem');
	for (var i = 0; i < oDel.length; i++) {
		oDel[i].onclick = del;
	};
	
	function del(){
		if (confirm("确定要删除吗？")) {
			return true;
		}else{
			return false;
		}
	}
}