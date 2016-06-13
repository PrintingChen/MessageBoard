window.onload = function(){
	var oBtn = document.getElementById('sbutton');
	var oTxt = document.getElementById('txt');
	var oTitle = document.getElementById('title');
	var arr = ['反动', '暴力', '1'];
	oBtn.onclick = function(){
		var oVal = oTxt.value;
		for(var i=0; i < arr.length; i++){
			var reg = new RegExp(arr[i]);
			if(reg.test(oVal)){
				alert('不得含有\"'+oVal+'\"等敏感词语');
				return false;
			}
		}
	}
}