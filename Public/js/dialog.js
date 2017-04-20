var dialog = {
		
	//错误提示
	error: function(message) {
		layer.open({
			content: message,
			icon: 2,
			title: "错误提示"
		});
	},
	
	//成功提示
	success: function(message, url) {
		layer.open({
			content: message,
			icon: 1,
			yes: function() {
				location.href = url;
			}
		});
	},
	
	//确认弹出层
	confirm: function(message) {
		layer.open({
			content: message,
			icon: 3,
			btn: ['是', '否'],
		});
	},
	
	//确认弹出层带跳转
	toconfirm: function(message, url) {
		layer.open({
			content: message,
			icon: 3,
			btn: ['是', '否'],
			yes: function(){
				location.href = url;
			}
		})
	}
}
