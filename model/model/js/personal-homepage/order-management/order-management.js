/**
 * Created by Fred on 2017/5/25.
 */
$(function () {
    $('.page-btn span').click(function () {
        $(this).siblings('span').removeClass('active');
        $(this).addClass('active');
    })
})