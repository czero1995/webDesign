/**
 * Created by Fred on 2017/6/2.
 */
$(function () {
    var monthNum = $('.input-number input');
    $('.checked').click(function () {
        $('.u-radio').removeClass('active');
        radio(this);
    });
    $('.info-title').click(function () {
        $('.u-radio').removeClass('active');
        radio(this);
    });
    function  radio(obj) {
        $(obj).parents('.u-radio').addClass('active');
    };

    $('.minus').click(function () {
        var flag = false;
        changeNum(flag);
    });
    $('.add').click(function () {
        var flag = true;
        changeNum(flag);
    });
    function changeNum(flag) {
        var numberVal = monthNum.val();
        if(flag){
            numberVal++;
            monthNum.val(numberVal);
        }else{
            if(numberVal<=0){
                monthNum.val('0');
            }else {
                numberVal--;
                monthNum.val(numberVal);
            }
        }
    }
})