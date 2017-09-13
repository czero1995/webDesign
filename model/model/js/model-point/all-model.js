/**
 * Created by Fred on 2017/5/18.
 */

$(function () {
    $('.page-btn').find('span').click(function () {
        $('.page-btn').find('span').removeClass('active1');
        $(this).addClass('active1');
    });


    $('.range-slider').jRange({
        from: 145,
        to: 210,
        step: 1,
        scale: [],
        format: '%s',
        width: 440,
        showLabels: true,
        isRange: true
    });
});