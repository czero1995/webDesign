
$(function(){

	//窗口滚动处理头部变化
    $(document).scroll(function () {
        var scrollHeight = $(document).scrollTop();
        if (scrollHeight > 500 ) {
            $(".header").addClass('active');
        }
        if (scrollHeight > 600) {
            $(".header").addClass('selected');
        }
        if (scrollHeight < 300) {
            $(".header").removeClass("selected active");
        }
    });

})