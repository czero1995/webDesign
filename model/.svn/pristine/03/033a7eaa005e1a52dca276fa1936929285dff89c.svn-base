/**
 * Created by Fred on 2017/6/28.
 */

$(function () {
    //初始化翻书插件
    var Page = (function () {

        var config = {
                $bookBlock: $('#bb-bookblock'),
                $navNext: $('#bb-nav-next'),
                $navPrev: $('#bb-nav-prev')
            },
            init = function () {
                config.$bookBlock.bookblock({
                    speed: 800,
                    shadowSides: 0.8,
                    shadowFlip: 0.7,
                    autoplay: false,
                    interval: 4000,
                    shadows: true
                });
                initEvents();
            },
            initEvents = function () {

                var $slides = config.$bookBlock.children();

                // add navigation events
                config.$navNext.on('click touchstart', function () {
                    config.$bookBlock.bookblock('prev');
                    return false;
                });

                config.$navPrev.on('click touchstart', function () {
                    config.$bookBlock.bookblock('next');
                    return false;
                });


                // add swipe events
                $slides.on({
                    'swipeleft': function (event) {
                        config.$bookBlock.bookblock('prev');
                        return false;
                    },
                    'swiperight': function (event) {
                        config.$bookBlock.bookblock('next');
                        return false;
                    }
                });

                //add keyboard events
                $(document).keydown(function (e) {
                    var keyCode = e.keyCode || e.which,
                        arrow = {
                            left: 37,
                            up: 38,
                            right: 39,
                            down: 40
                        };

                    switch (keyCode) {
                        case arrow.left:
                            config.$bookBlock.bookblock('next');
                            break;
                        case arrow.right:
                            config.$bookBlock.bookblock('prev');
                            break;
                    }
                });
            };

        return {init: init};

    })();
    Page.init();

})