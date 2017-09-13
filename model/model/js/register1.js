/**
 * Created by Fred on 2017/4/25.
 */
$(function () {
    $('.check1').click(function () {
        $('.check1').removeClass('active1');
        $(this).addClass('active1');
        console.log($(this).find('img').src);
    })
})