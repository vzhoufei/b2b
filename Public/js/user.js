$('#login').click(function(e){
	var url = $(this).attr('url');
	var data = {};

	if($('[name="account"]').val()!=""){
		data['account']=$('[name="account"]').val()
	}else{
		alert('请输入用户名');
		return;
	}

	if($('[name="password"]').val()!=""){
		data['password']=$('[name="password"]').val()
	}else{
		alert('请输入密码');
		return;
	}

	data['check']=$("input[type='checkbox']").is(':checked');
	$.ajax({
		url: url,
		type: 'POST',
		dataType: 'json',
		data:data,
		success:function(result){
			alert(result['Msg']);
			if(result['status']=='0'){
				window.location.href=result['url'];
			}
		}
	});
	
})