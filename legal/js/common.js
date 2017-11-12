    $().ready(function(){
    	 /*滚轮控制*/
    (function ($) {
        $(document).ready(function () {
            $("body,.draft,.chooseBox-parent,.file-tree,.htSignContent.file-tree ,.contackList,.fileList,.file-tree-model,.chooseDate,.searchFolder,.searchFile,.index-center-searchFolder,.folderSearch,.creatRight,.htPreLeft,.compaseFileMenu,.compaseFileMenuChange,.editorHT-Content,.creatRight,.viewFileMenu,.signRecord-box,.addSigonUser-content,.shareModelSign,.yhsz-content,.wddd-content-box,.tcxx-content-box").mCustomScrollbar();
            $(".htSignPre").mCustomScrollbar({
                horizontalScroll: true//横向滚动
            });
        });
    })(jQuery);
    
     /*首页右边布局下拉框*/
    $('.rightDropMenu1 li').click(function () {
        var selectVal = $(this).html();
        $('.btn-rightFilte1').html(selectVal);
    });
    $('.rightDropMenu2 li').click(function () {
        var selectVal = $(this).html();
        $('.btn-rightFilte2').html(selectVal);
    });
    $('.rightDropMenu3 li').click(function () {
        var selectVal = $(this).html();
        $('.btn-rightFilte3').html(selectVal);
    });
     /*日期选择器*/

    $('#datetimepicker').datetimepicker({
        format: 'yyyy-mm-dd hh:ii'
    });

    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    /*更改日期选择格式*/
    $('.dow').eq(0).html('Mon');
    $('.dow').eq(1).html('Tue');
    $('.dow').eq(2).html('Wen');
    $('.dow').eq(3).html('The');
    $('.dow').eq(4).html('Fir');
    $('.dow').eq(5).html('Sat');
    $('.dow').eq(6).html('Sun');
    })
   