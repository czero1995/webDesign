/**
 * Created by Fred on 2017/5/17.
 */
$(function () {
        //banner轮播初始化
        var carousel = $("#carousel").waterwheelCarousel({
            flankingItems: 3,
            movedToCenter:function($item){
                $(".carousel-center").siblings(".intro").fadeIn();
                // console.log($item.index('.banner-img'));
            },
            movingFromCenter:function(){
                $(".carousel-center").siblings(".intro").hide();
            },
            autoPlay:3000,
            separation: 400
        });

        $('.banner-prev').bind('click', function () {
            carousel.prev();
            return false
        });

        $('.banner-next').bind('click', function () {
            carousel.next();
            return false;
        });
        //轮播选项小球




})