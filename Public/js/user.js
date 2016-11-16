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
			// alert(result['Msg']);
			if(result['res']==1){
				window.location.href=result['url'];
			}else{

			alert(result);
			}
		}
	});
	
})



//pattern = /^(13[0-9]|15[0|3|6|7|8|9]|18[8|9])\d{8}$/;
//缺少180 181 186开头号码
pattern = /^(13[0-9]|15[0|3|6|7|8|9]|18[0|1|6|8|9])\d{8}$/;

//注册提交验证 周飞
function mysubmit()
{	
	var data = {
		'phone' :$('input[name=phone]').val(),
		'pwd'	:$('input[name=keyword]').val(),
		'pwd2'	:$('input[name=keywords]').val(),
		'code'	:$('input[name=code]').val()
	};
	if(!pattern.test(data['phone'])){
		$('#error').html('手机号不合法！');
		return false;
	}else if(data['pwd'].length < 6){
		$('#error').html('密码最小长度为6位！');
		return false;
	}else if(data['pwd2'].length < 6){
		$('#error').html('确认密码最小长度为6位！');
		return false;
	}else if(data['pwd'] != data['pwd2']){
		$('#error').html('两次密码不一致！');
		return false;
	}else if(!data['code']){
		$('#error').html('请填写验证码！');
		return false;
	}

	
	// return false;
}


//手机号验证 周飞
function phoneyz(obj){
       if(pattern.test($(obj).val())){
       	 $('#error').html('');
       	 $('#button').removeAttr('disabled');
       }else{
       	 $('#button').attr('disabled','disabled');
       	 $('#error').html('手机号不合法！');
       }

}

//密码找回时手机号验证
function phone_pass(obj,url)
{
	  if(!pattern.test($(obj).val())){
       	
       	 $('#button').attr('disabled','disabled');
       	 $('#error').html('手机号不合法！');
       	 return;
       }
       $.post(url, {'phone':$(obj).val()}, function(res){
       		if(res == '1'){
       		      	 $('#error').html('');
       	 			 $('#button').removeAttr('disabled');	
       		}else{
       	 		$('#button').attr('disabled','disabled');
       			alert(res)
       		}

       })
}




//发送验证码 周飞
//p p为2是找回密码 1注册
function codes(url,p){
  var phone = $('input[name=phone]').val();
  if(!pattern.test(phone)){$('#error').html('手机号不合法！');return false;}
  $.post(url,{'phone':phone, 'p':p},function(res){
    if(res == 1){
      $('input[name=code]').removeAttr('disabled');
      $('#button').attr('disabled','disabled');
      times();
    }else{

      alert(res);
    }
    
  })
}

//查询验证码 周飞
function yzmyz(url){
	var phone = $('input[name=phone]').val();
	var code = $('input[name=code]').val();
	$.post(url,{'phone':phone},function(res){
		if(parseInt(res) == parseInt(code)){
      		$('#subss').removeAttr('disabled');
      		mysubmit();
		}else{
	
      		$('#error').html('验证码错误！');
      		$('#subss').attr('disabled','disabled');
			
		}
    
    
  })
}
//验证码时间 周飞
function times(){
	i = 60;
	var time = setInterval(function(){
		 $('#button').html( i +'秒中后重新获取');
	i--;
	if(i < 0){clearInterval(time); $('#button').html('重新获取');$('#button').removeAttr('disabled');}
	},1000);
}