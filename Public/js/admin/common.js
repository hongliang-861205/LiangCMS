/**
 * 添加按钮操作
 */
$("#button-add").click(function(){
	var url = SCOPE.add_url;
	window.location.href = url;
});

$("#singcms-button-submit").click(function(){
	var data = $("#singcms-form").serializeArray();
	var postData = {};
	$(data).each(function(i){
		postData[this.name] = this.value;
	})
	var save_url = SCOPE.save_url;
	var jump_url = SCOPE.jump_url;
	$.post(save_url, postData, function(res){
		switch(res.status) {
		case 0: 
			return dialog.error(res.message);
			break;
		case 1:
			return dialog.success(res.message, jump_url);
			break;
		}
	}, "json")
})