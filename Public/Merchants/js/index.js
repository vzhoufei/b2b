$(function(){

	$('#main_tw').bind('click',function(){
		$('.main_ltwo .main_lp >span').toggleClass("glyphicon-play glyphicon-chevron-down"); 
		 $(".main_ltwo > ul").slideToggle("slow");
	});

	$('#main_th').bind('click',function(){
		$('.main_lthree .main_lp >span').toggleClass("glyphicon-play glyphicon-chevron-down"); 
		 $(".main_lthree > ul").slideToggle("slow");

	});

	$('#main_fo').bind('click',function(){
		$('.main_lfour .main_lp >span').toggleClass("glyphicon-play glyphicon-chevron-down"); 
		 $(".main_lfour > ul").slideToggle("slow");
	});

	$('#main_fi').bind('click',function(){
		$('.main_lfive .main_lp >span').toggleClass("glyphicon-play glyphicon-chevron-down"); 
		 $(".main_lfive > ul").slideToggle("slow");
	});

	//产品点击显示更多
   var showMoreNChildren = function ($children, n) {
        //显示某jquery元素下的前n个隐藏的子元素
        var $hiddenChildren = $children.filter(":hidden");
        var cnt = $hiddenChildren.length;
        for ( var i = 0; i < n && i < cnt ; i++) {
            $hiddenChildren.eq(i).show();
        }
        return cnt-n;//返回还剩余的隐藏子元素的数量
    }

    //对页中现有的class=showMorehandle的元素，在之后添加显示更多条，并绑定点击行为
    $(".showMoreNChildren").each(function () {
        var pagesize = $(this).attr("pagesize") || 6;
        var $children = $(this).children();
        if ($children.length > pagesize) {
            for (var i = pagesize; i < $children.length; i++) {
                $children.eq(i).hide();
            };

            $("<div class='showMorehandle' >显示更多</div>").insertAfter($(this)).click(function () {
                if (showMoreNChildren($children, pagesize) <= 0) {
                    //如果目标元素已经没有隐藏的子元素了，就隐藏“点击更多的按钮条”
                    // $(this).hide();
                };
            });
        }
    });
          

    // function customA(){
    // 	alert('sasadas');
    // 	$('#material').hide('100');


    // }
    $('#customA').bind('click',function(){
    	// alert('assa');
    		$('#custom').show();
    		$('#material').hide();
    		$('#materialA').css('background','#fff');
    		$('#materialA > a').css('color','#000')
    		$(this).css('background','#0063FD');
    		$('#customA > a').css('color','#fff');
    });

    //产品自定义分类
    $('#myCustomone').bind('click',function(){    		
    		$('#myCustomone').removeClass('myCustomtwo');
    		$('#myCustomtwo').removeClass('myCustomone');
    		$('#myCustomone').addClass("myCustomone");
    		$('#myCustomtwo').addClass("myCustomtwo");
    		$('.myCustomone_A').show();
    		$('.myCustomone_B').hide();
    });

    $('#myCustomtwo').bind('click',function(){   		
    		$('#myCustomtwo').removeClass('myCustomtwo');
    		$('#myCustomone').removeClass('myCustomone');
    		$('#myCustomtwo').addClass("myCustomone");
    		$('#myCustomone').addClass("myCustomtwo");
    		$('.myCustomone_A').hide();
    		$('.myCustomone_B').show();
    });


























})