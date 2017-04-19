
var login = {
	check: function(){
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();
		
		if(!username) {
			dialog.error("请输入用户名！");
			return;
		}
		if(!password) {
			dialog.error("请输入密码！");
			return;
		}
	}
}