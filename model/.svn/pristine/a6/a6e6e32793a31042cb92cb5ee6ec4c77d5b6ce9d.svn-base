/**
 * Created by Fred on 2017/6/1.
 */
$(function () {
    $('.radio').click(function () {
        $('.radio').removeClass('active');
        $(this).addClass('active');
        $(".u-2-radio").each(function(i,ele){
            if($(this).hasClass('active')){
                $('.u-2-radio-title').addClass('active');
                return false;
            }else{
                $('.u-2-radio-title').removeClass('active');
            }
        });
    });


    $('.agreement-btn').click(function () {
        $('.agreement-btn span').toggleClass('active');
    })
})