/**
 * Created by Fred on 2017/5/31.
 */
$(function () {
    $('.list-label span').click(function () {
        var activeNum = 0;
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }else{
            $('.list-label span').each(function () {
                if($(this).hasClass('active')){
                    activeNum++;
                }
            });
            if(activeNum<=2){
                $(this).addClass('active');
            };
        }
    })
})