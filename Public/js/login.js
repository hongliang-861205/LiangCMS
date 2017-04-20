var login = {
	check : function() {
		var username = $('input[name="username"]').val();
		var password = $('input[name="password"]').val();

		if (!username) {
			dialog.error("请输入用户名！");
			return;
		}
		if (!password) {
			dialog.error("请输入密码！");
			return;
		}

		var url = "/admin/login/login";
		var data = {
			'username' : username,
			'password' : password
		};

		$.post(url, data, function(res) {
			switch (res.status) {
			case 0:
				return dialog.error(res.message);
				break;
			case 1:
				return dialog.success(res.message, "/admin/index/index");
				break;
			}
		}, 'json')
	}
}