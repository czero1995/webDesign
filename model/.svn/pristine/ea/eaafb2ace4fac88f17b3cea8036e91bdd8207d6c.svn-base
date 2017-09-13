
$(function(){

	//banner 图片轮播；
	jQuery(".slideTxtBox_1").slide({
		mainCell:".bd ul",
		effect:"fold",
		autoPlay:true,
		trigger:'click',
		mouseOverStop:false,
		delayTime:800,
	});

	//合作伙伴 图片轮播；
	jQuery(".slideTxtBox_2").slide({
		titCell:".hd ul",
		mainCell:".bd ul",
		autoPage:true,
		effect:"left",
		autoPlay:true,
		vis:8,
	});

	//我们在这里 图片轮播；
	jQuery(".slideTxtBox_3").slide({
		titCell:".hd ul",
		mainCell:".bd ul",
		autoPage:true,
		effect:"left",
		autoPlay:false,
		vis:3,
	});

	//女神专区 - 图片轮播;
	var carousel_1 = $("#carousel_1").waterwheelCarousel({
	    flankingItems: 2,
	    separationMultiplier: .7,//边图大小比例;
	    sizeMultiplier: .76,//缩小比例
	    opacityMultiplier: .8,//透明度;
	    separation: 280,//图片间距离
	    autoPlay:3000,
	    movedToCenter:function(){
	    	$(".carousel-center").siblings(".intro").fadeIn();	    	
	    },
	    movingFromCenter:function(){
	    	$(".carousel-center").siblings(".intro").hide();	    	
	    }
	});
	$('.prev').bind('click', function () {
	    carousel_1.prev();
	    return false
	});
	$('.next').bind('click', function () {
	    carousel_1.next();
	    return false;
	});

	//选项卡
    $(".tabs_1").tabs({
    	'clickTarget':'a',
		'addClassName':'selected',
		'checkTarget':'.item'    	
    });
    $(".tabs_2").tabs({
    	'clickTarget':'.navRanking a',
		'addClassName':'selected',
		'checkTarget':'.tabsBox'    	
    });
	$(".sec_2 .topRanking .bottom a .box").click(function(event){
		//event.stopPropagation();
		var aObj = $(this).parent('a');
		if(aObj.hasClass("selected")){

		}else{
			aObj.siblings().removeClass("selected");
			$(this).parent('a').addClass("selected");
			return false;
		}				
	})
    $(".tabs_5").tabs({
    	'clickTarget':'.nav a',
		'addClassName':'selected',
		'checkTarget':'.tabsBox'    	
    });
    $(".tabs_6").tabs({
    	'clickTarget':'.nav a',
		'addClassName':'selected',
		'checkTarget':'.tabsBox'    	
    });
    $(".tabs_7").tabs({
    	'clickTarget':'.nav a',
		'addClassName':'selected',
		'checkTarget':'.tabsBox'    	
    });



	//阻止浏览器默认右键点击事件
// $("body").bind("contextmenu", function(){
//     return false;
// })

// $("body").mousedown(function(e) {
//     console.log(e.which);
//     //右键为3
//     if (3 == e.which) {
//         $(this).css({
//             "font-size": "-=2px"
//         });
//     } else if (1 == e.which) {
//         //左键为1
//         $(this).css({
//             "font-size": "+=3px"
//         });
//     }
// })

})