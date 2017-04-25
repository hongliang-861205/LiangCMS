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
	});
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
});

/**
 * 编辑按钮操作
 */
$(".singcms-table #singcms-edit").click(function () {
    var id = $(this).attr("attr-id");
    var edit_url = SCOPE.edit_url;
    window.location.href = edit_url + "?id=" + id;
});


/**
 * 删除按钮操作
 */
$(".singcms-table #singcms-delete").click(function () {
	var id = $(this).attr("attr-id");
	var a = $(this).attr("attr-a");
	var message = $(this).attr("attr-message");
	var url = SCOPE.set_status_url;

	var data = {};
	data['menu_id'] = id;
	data['status'] = -1;

    layer.open({
    	title: "提示信息",
        content: "确定要"+ message +"？",
        icon: 3,
        btn: ['是', '否'],
		yes: function () {
			toDelete(url, data);
        }
    });
});

function toDelete(url, data) {
	var jump_url = SCOPE.jump_url;
	$.post(url, data, function (res) {
		switch(res.status) {
			case 0:
				return dialog.error(res.message);
				break;
			case 1:
				return dialog.success(res.message, jump_url);
				break;
		}
    }, "json")
}

$("#button-listorder").click(function () {
	var data = $("#singcms-listorder").serializeArray();
	var postData = {};
	$(data).each(function (i) {
		postData[this.name] = this.value;
    })
	var listorder_url = SCOPE.listOrder_url;
	var jump_url = SCOPE.jump_url;

	$.post(listorder_url, postData, function (res)  {
		var jump_url = res.data['jump_url'];
        switch(res.status) {
            case 0:
                return dialog.error(res.message);
                break;
            case 1:
                return dialog.success(res.message, jump_url);
                break;
        }
    }, "json");
});