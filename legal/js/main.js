window.onload = function () {
    

    /*搜索*/
    $('.searchResult').click(function () {
        $('.searchResultModel').toggleClass('activeResult');
    });

    $('.btn-search').click(function () {
        $('.searchResult').toggleClass('activeSearchResult');
    });

    $('.searchTitleFolder').click(function () {
        $('.index-center-content').hide();
        $('.index-center-searchFolder').hide();
        $('.searchResultModel').hide();
        $('.index-center-searchFolder').show();
    });

    $('.searchTitleFile').click(function () {
        $('.index-center-content').hide();
        $('.index-center-searchFile').hide();
        $('.searchResultModel').hide();
        $('.index-center-searchFile').show();
    });

   

    /*树形文件夹*/
    $('.wordTree').click(function () {
        $('.wordicon').toggleClass('activeWordicon')
    });

    $('.pdfTree').click(function () {
        $('.pdficon').toggleClass('activePdficon')
    });

    $('.first-li').click(function (event) {
        var tree = $('.file-tree');
        var treeBra = $('.file-box');
        var treeLength = treeBra.length;
        if (tree.hasClass('file-tree2')) {
            $('.first-li').css("background", "#ffffff");
            $(this).css("background", "#e8f4f6");
            event.stopPropagation();
            if ($(this).parent('.file-box').hasClass('active')) {
                $(this).parent('.file-box').removeClass('active');
                treeBra.css({"padding-bottom": '0'});
            } else {
                treeBra.removeClass('active');
                $(this).parent('.file-box').addClass('active');
            }
            ;
            var thisTreebraIndex = $(this).index('.first-li');
            var lineNub = countTreebra(treeLength, thisTreebraIndex);
            var pb = $(this).siblings('.file-child-box').height();
            treeBra.css({"padding-bottom": '0'});
            for (var i = lineNub * 4; i > lineNub * 4 - 4; i--) {
                treeBra.eq(i - 1).css({"padding-bottom": pb});
            }
            return false;
        }
        var index = $(this).index('.first-li');
        treeBra.eq(index).toggleClass('active');
        $('.fileInfo-display').eq(index).toggleClass('active');
    });

    function countTreebra(length, index) {
        for (var i = 1; i < length / 4 + 1; i++) {
            if (4 * i >= index + 1) {
                return i
            }
        }
    }


    /* 树形文件夹切换*/

    $('.btn-l').click(function () {
        $('.file-tree').removeClass('. file-tree2');
        $('.file-box').css('padding-bottom', '0');
    });

    $('.btn-r').click(function () {
        $('.file-tree').addClass('. file-tree2');
        $('.file-box').removeClass('active');
    });

    $('.changeBtn').click(function () {
        $('.changeBtn').removeClass('activeBtn');
        $(this).addClass('activeBtn');
    });

    /*模态框文件夹*/

    $('.first-li-model').click(function () {
        var index = $(this).index('.first-li-model');
        $('.file-box-model').eq(index).toggleClass('active');
        $('.fileInfo-display').eq(index).toggleClass('active');
    });

    $('.file-child').click(function () {
        $('.file-child').removeClass('active1');
        $(this).addClass('active1');
    });

    $('.file-child-parent').click(function () {
        $('.file-child-parent').removeClass('active2');
        $(this).addClass('active2');
    });

    $('.radio').click(function (event) {
        var index = $(this).index('.radio');
        $('.radio').eq(index).toggleClass('activeRadio');

        if ($('.radio').eq(index).hasClass('activeRadio')) {
            $('.history').eq(index).hide();
            $('.share-in').eq(index).hide();
            $('.radioMove').eq(index).show();
            $('.igonre').eq(index).show();
        } else {
            $('.radioMove').eq(index).hide();
            $('.igonre').eq(index).hide();
            $('.history').eq(index).show();
            $('.share-in').eq(index).show();
        }

        var n = 0;
        $('.activeRadio').each(function (i, ele) {
            n++;
        });

        if (n > 0) {
            $('.fileChoose').text("已选择" + n);
            $('.fileMove').show();
            $('.fileChoose').show();
        } else {
            $('.fileChoose').text("文件名称");
            $('.fileMove').hide();
            $('.radioTitle').css("background", "url(./img/icon/radio.png) no-repeat");
        }

        event.stopPropagation();
    });

    var chooseActive = false;
    $('.radioTitle').click(function (event) {
        $('.radioTitle').css("background", "url(./img/icon/radioSelect.png) no-repeat");

        if (chooseActive) {
            chooseActive = false;
            $('.radio').removeClass('activeRadio');

        } else {
            chooseActive = true;
            $('.radio').addClass('activeRadio');
        }

        var n = 0;
        $('.activeRadio').each(function (i, ele) {
            n++;
        });
        $('.fileChoose').text("已选择" + n);
        $('.fileMove').show();
        if (n == 0) {
            $('.fileChoose').hide();
            $('.fileMove').hide();
            $('.history').show();
            $('.share-in').show();
            $('.igonre').hide();
            $('.radioMove').hide();
            $('.radioTitle').css("background", "url(./img/icon/radio.png) no-repeat");
        } else {
            $('.fileChoose').show();
            $('.igonre').show();
            $('.radioMove').show();
            $('.history').hide();
            $('.share-in').hide();
        }
        event.stopPropagation();

    });

    /**
     * 弹窗
     */
    /*父文件夹组工具弹框*/
    $('[data-toggle="popover-fileInfo-more"]').each(function () {
        var element = $(this);
        var id = element.attr('class');
        var txt = element.html();
        element.popover({
            trigger: 'manual',
            placement: 'right',
            html: 'true',
            content: '<span class="tool-toTop">置顶</span> ' +
            '<span class="tool-reName">重命名</span> ' +
            '<span class="tool-download">下载</span> ' +
            '<span class="tool-remove">删除</span>',
        }).on("click", function () {
            var _this = this;
            $(this).popover("show");
        })
    });
    /*子文件夹工具弹框*/
    $('[data-toggle="popover-fileInfoChild-more"]').each(function () {
        var element = $(this);
        var id = element.attr('class');
        var txt = element.html();
        element.popover({
            trigger: 'manual',
            placement: 'right',
            html: 'true',
            content: '<span class="toolChild-toTop">置顶</span> ' +
            '<span class="toolChild-reName">重命名</span> ' +
            '<span class="toolChild-download">下载</span> ' +
            '<span class="toolChild-remove">删除</span>',
        }).on("click", function () {
            var _this = this;
            $(this).popover("show");

        })
    });
    /*选择文件弹框*/
    $('[data-toggle="popoverFile"]').each(function () {
        var element = $(this);
        var id = element.attr('class');
        var txt = element.html();
        element.popover({
            trigger: 'manual',
            placement: 'right',
            html: 'true',
            content: '<span class="tool-Move">移动</span> ' +
            '<span class="tool-remove">删除</span> ' +
            '<span class="tool-download">下载</span> ',
        }).on("click", function () {
            var _this = this;
            $(this).popover("show");

        })
    });

    $('.fileInfo').on("click", ".tool-remove", function () {
        $('.removeFolders-model').show();
    });

    $('.fileInfo').on("click", ".toolChild-remove", function () {
        $('.removeFolder-model').show();
    });

    $('.removeFolderBtnCancel').click(function () {
        $('.removeFolder-model').hide();
    });

    $('.history').click(function (event) {
        $('.CompaseModel').show();
        event.stopPropagation();

    });

    $('.share-in').click(function () {
        $('.shareFile-model').show();
    });

    $('.shareModelEditor').click(function () {
        $('.shareModelEditorActive,.shareModelEditorContent').show();
        $('.shareModelViewActive,.shareModelViewContent').hide();
    });

    $('.shareModelView').click(function () {
        $('.shareModelViewActive,.shareModelViewContent').show();
        $('.shareModelEditorActive,.shareModelEditorContent').hide();
    });

    $('.CompaseModel').click(function (event) {
        $('.CompaseModel').show();
        event.stopPropagation();
    });

    $('.title-l').on("click", ".tool-FileMove", function (event) {
        $('.moveFile-model').show();
        $('.fileMove').hide();
        event.stopPropagation();
    });

    $('.copyicon').click(function () {
        $('.copyTip').show();
    });

    $('.download').on("click", function (event) {
        var ind = $(this).index('.download');
        $('.DateModel').show();
        $('.companyFile').removeClass('activeCompanyFile');
        $('.download').removeClass('activeDownload');
        $('.companyFile').eq(ind).toggleClass('activeCompanyFile');
        $('.download').eq(ind).toggleClass('activeDownload');
        event.stopPropagation();
    });

    $('.DateModel').click(function (event) {
        $(this).show();
        event.stopPropagation();
    });

    $('.dateRadioDownload').click(function () {
        var index = $(this).index('.dateRadioDownload');
        $('.dateRadioDownload').eq(index).toggleClass('activeDateRadioDownload');
        var i = 0;
        if ($('.dateRadioDownload').hasClass('activeDateRadioDownload')) {
            $('.activeDateRadioDownload').each(function () {
                i++
            });
            $('.chooseFormatText').text("已选择" + i + "下载");
        }
    });

    $('.compaseRadioDownload').click(function () {
        var index = $(this).index('.compaseRadioDownload');
        $('.compaseRadioDownload').eq(index).toggleClass('activeCompaseRadioDownload');
        var a = 0;
        $('.activeCompaseRadioDownload').each(function () {
            a++;
        });
        if (a > 1) {
            $('.CompaseText').css("color", "#333333");
        } else {
            $('.CompaseText').css("color", "#cccccc");
        }

    });

    $('.viewRadioDownload').click(function () {
        var index = $(this).index('.viewRadioDownload');
        $('.viewRadioDownload').eq(index).toggleClass('activeDateRadioDownload');
    });

    $('.word').click(function () {
        $('.wordicon').toggleClass('activeWordicon');
    });

    $('.pdf').click(function () {
        $('.pdficon').toggleClass('activePdficon');
    });

    $('.fileInfo-download ').on("click", function (event) {
        var index = $(this).index(".fileInfo-download ");
        $('.treeDownload').eq(index).show();
        event.stopPropagation();
    });

    $('.treeDownload').click(function (event) {
        $(this).show();
        event.stopPropagation();
    });

    $('.CompaseText').click(function () {
        $('.compaseFile-model').show();
    });

    $('.renameFileInsure').click(function () {

    });

    /*标题提示*/
    $('.signatoryText').on("mouseenter", function () {
        var index = $(this).index('.signatoryText');
        var title = $('.signatoryText').eq(index).text();
        $('.signatoryText').eq(index).attr("title", title);
    });

    /*图标状态切换*/

    $('.shareqq').on("mouseenter", function () {
        $('.shareqq').toggleClass('activeShareQQ');
    }).on("mouseleave", function () {
        $('.shareqq').removeClass('activeShareQQ');
    });

    $('.sharewechat').on("mouseenter", function () {
        $('.sharewechat').toggleClass('activeShareWeChat');
    }).on("mouseleave", function () {
        $('.sharewechat').removeClass('activeShareWeChat');
    });

    $('.shareweibo').on("mouseenter", function () {
        $('.shareweibo').toggleClass('activeShareWeiBo');
    }).on("mouseleave", function () {
        $('.shareweibo').removeClass('activeShareWeiBo')
    });


    $('.addContact').on("mouseenter", function () {
        $('.addContact').toggleClass('activeAddContact');
    }).on("mouseleave", function () {
        $('.addContact').removeClass('activeAddContact');
    });

    $('.addContactView').click(function () {
        $('.addContactView').toggleClass('activeAddContactView');
    });

    $('.remove').on("mouseenter", function () {
        $(this).toggleClass('activeRemove');
    }).on("mouseleave", function () {
        $(this).removeClass('activeRemove')
    });

    $('.removeView').click(function () {
        $(this).toggleClass('activeRemoveView');

    });

    /**
     * 下拉框
     */
    /*首页筛选框*/
    $('.dropdown-menu-filte li').click(function () {
        var selectVal = $(this).html();
        $('.btn-val').html(selectVal);
    });
   
    /*比较文件下拉框*/
    $('.compaseFileMenu li').click(function () {
        var selectVal = $(this).html();
        $('.compaseChooseText').html(selectVal);
        $('.compaseChooseText').find(".compasedDateNews").remove();

    });
    $('.compaseFileMenuChange li').click(function () {
        var selectVal = $(this).html();
        $('.compaseChooseTextChange').html(selectVal);
        $('.compaseChooseTextChange').find(".compasedDateNews").remove();
    });
    $('.compase-icon').click(function () {
        var tem1 = $('.compaseChooseText').html();
        var tem2 = $('.compaseChooseTextChange').html();
        $('.compaseChooseText').html(tem2);
        $('.compaseChooseTextChange').html(tem1);
    });

    /*模态框下拉框*/
    $('.modelDropMenu1 li').click(function () {
        var selectVal = $(this).html();
        $('.dropdown-auth1').html(selectVal);
    });
    $('.modelDropMenu2 li').click(function () {
        var selectVal = $(this).html();
        $('.dropdown-auth2').html(selectVal);
    });
    $('.modelDropMenu3 li').click(function () {
        var selectVal = $(this).html();
        $('.dropdown-auth3').html(selectVal);
    });
    $('.modelDropMenu4 li').click(function () {
        var selectVal = $(this).html();
        $('.dropdown-auth4').html(selectVal);
    });

    /**
     * 添加签收方弹出框
     */
    $('.addSignUserBtn').click(function () {
        var height = $('.signUser-model-content').height();
        $('.signUser-model-content').css("height", height + 38);
        $('.signUserModelBox').append('<div class="signUser-item "><span class="signUser signUser-Add">丁方：</span><input type="text" value="凡几创意设计有限公司" style="width: 490px;height: 32px;padding: 8px 14px;"> <span class="removeSignUser"></span> </div>');
        console.log(height)
    });
    $('.signUserModelBox').on("click", ".removeSignUser", function () {
        var index = $(this).index('.removeSignUser');
        $('.removeSignUser').eq(index).css("background", "url(./img/icon/tool_remove_yes.png) no-repeat");
        setTimeout(function () {
            var height = $('.signUser-model-content').height();
            $('.signUser-model-content').css("height", height - 34);
            $('.signUser-item').eq(index).remove();
        }, 100);

    });
    $('.signatory ').click(function () {
        $('.signUser-model').show();
    });

    /*筛选栏*/
    $('.filteCat-item').click(function () {
        var vatIndex = $(this).index('.filteCat-item');
        $('.filteCat-itemActive').remove();
        $('.filteCat-item').eq(vatIndex).append('<span class="filteCat-itemActive"></span>');
    });
    $('.shunxu').click(function () {
        $('.shunxu').toggleClass('activeShunxu');
    });
    /**
     * 取消弹窗
     */
    $('body').click(function (event) {
        var target = $(event.target);       // 判断自己当前点击的内容
        if (!target.hasClass('popover')
            && !target.hasClass('pop')
            && !target.hasClass('popover-content')
            && !target.hasClass('popover-title')
            && !target.hasClass('arrow')) {
            $('.pop').popover('hide');      // 当点击body的非弹出框相关的内容的时候，关闭所有popover
        }
        $('.DateModel').hide();
        $('.CompaseModel').hide();
        $('.treeDownload').hide();
        $('.companyFile').removeClass('activeCompanyFile');
        $('.download').removeClass('activeDownload');

    });

    /**
     * 弹窗关闭
     */
    $('.closeModel').click(function () {
        $('.modelDIY').hide();
    });
    $('.hideModel').click(function (event) {
        $('.modelDIY').hide();
        event.stopPropagation();
    });
    $('.modelDIY-content').click(function (event) {
        var index = $(this).index('.modelDIY-content');
        $('.modelDIY-content').eq(index).show();
        event.stopPropagation();
    });
    $('.btn-cancel').click(function () {
        $('.modelDIY').hide();
    });

    /*阻止boostrap下拉菜单隐藏*/

    $('.viewFileMenu').on("click", "[data-stopPropagation]", function (e) {
        e.stopPropagation();
    });

    $('.viewFileMenu li').click(function () {
        var index = $(this).index('.viewFileMenu li');
        $('.viewRadioDownload').eq(index).toggleClass('viewRadioDownloadActive');
    });

    $('.viewFileMenu li').click(function () {
        var index = $(this).index('.viewFileMenu li');
        var num = $('.viewVersion').eq(index).html()
        $('.viewDropText').html(num);
    });
};

