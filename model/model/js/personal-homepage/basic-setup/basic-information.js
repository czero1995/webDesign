/**
 * Created by Fred on 2017/6/2.
 */
$(function () {
    $('.label-box span').click(function () {
        var activeNum = 0;
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }else{
            $('.label-box span').each(function () {
                if($(this).hasClass('active')){
                    activeNum++;
                }
            });
            if(activeNum<=2){
                $(this).addClass('active');
            };
        };
    });
    $('.sex .radio').click(function () {
        $('.sex .radio').removeClass('active');
        $(this).addClass('active');
    });
    $('.work-time .radio').click(function () {
        $(this).toggleClass('active');
    })
})
