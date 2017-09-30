
$().ready(function () {
   /*判断是否第一次打开界面*/
    var iscookie=document.cookie.indexOf("firstVisit="); //得到分割的cookie名值
    if(iscookie==-1){ //判断cookie是否存在
        var exdate=new Date();
        exdate.setDate(exdate.getDate()+30); //设置过期时间为30天
        document.cookie="firstVisit=1;expires="+exdate.toGMTString();
        $('.helpModel').show();
    }

    /**
     * 草拟合同
     */
    /*标题激活*/
    $('.titleTab').click(function () {
        var index = $(this).index('.titleTab');
        $('.draftTitleActive').remove();
        $('.titleTab').eq(index).append('<span class="draftTitleActive">');
    });
    /**
     * 草拟合同预览弹框
     */
    $('.draftFileChild').click(function () {
        $('.draftModel').show();
    });

    $('.creHT').click(function () {
        $('.draftExample').hide();
        $('.draftModel').hide();
        $('.qtypeExample').show();
    });

    $('.draftFileParent').click(function () {
       var index = $(this).index('.draftFileParent');
       $('.draftFileChildBox').eq(index).toggleClass('draftFileChildBox-display');
        $('.draft-display-icon').eq(index).toggleClass('draft-display-icon-display');
    });

    /**
     * Qtype
     */

    $('.continue').on("click", function () {
        $('.creatHT').show();
        $('.qtypeExample').hide();
    });

    $('.backEidtorQtype').click(function () {
        $('.qtypeExample').hide();
        $('.draftExample').show();
    });

    $('.qtype-menu li').click(function () {
        var selectVal = $(this).html();
        $('.qtype-val').html(selectVal);
    });

    $('.chooseSingle').click(function () {
        var index = $(this).index('.chooseSingle');
        $('.radioChoose').removeClass('activeChooseSingle');
        $('.radioChoose').eq(index).toggleClass('activeChooseSingle');

    });

    $('.chooseDouble').click(function () {
        var index = $(this).index('.chooseDouble');
        $('.radioChooseDouble').eq(index).toggleClass('activeChooseDouble');
    });

    /**
     * 合同创建
     */
    /*返回编辑按钮*/
    $('.backEidtor').click(function () {
        $('.versionEditor,.versionCheck, .versionPDF, .versionWord, .versionShare,.insureDraft,.creatHT,.versionManageBtn').hide();
        $('.qtypeExample,.insureCreate').show();
        console.log('12');
    });
    /*确定创建按钮*/
    $('.insureCreate').on("click", function () {
        $('.ProcessBox,.insureCreate,.backEidtor').hide();
        $('.versionEditor,.versionCheck,.versionPDF,.versionWord,.versionShare,.insureDraft,.backEditorHide').show();
    });
    /*返回按钮*/
    $('.backEditorHide').click(function () {
        $('.backEidtor,.ProcessBox,.insureCreate').show();
        $('.versionEditor,.versionCheck,.versionPDF,.versionWord,.versionShare,.insureDraft,.backEditorHide').hide();
    });
    /*版本管理按钮*/
    $('.versionManageBtn').click(function () {
       $('.versionChange,.versionManageBtn,.editorHT,.creatHT').hide();
       $('.versionManage,.compaseFile,.reStoryVersion').show();
    });
    /*编辑模态框*/
    $('.Editor-model-content').click(function () {
        $('.editorHT').show();
        $('.creatHT,.versionChange,.Editor-model').hide();
    });

    /**
     * 修改合同
     */
    /*完成编辑按钮*/
    $('.insureDown').click(function () {
        $('.editorHT,.quitEditor').hide();
        $('.versionChange,.versionEditor, .versionShare,.versionCheck,.versionPDF, .versionWord,.backToEditor').show();
    });
    /* 退出合同编辑按钮*/
    $('.quitHTEditor').click(function () {
        $('.editorHT').hide();
        $('.creatHT').show();
    });
    /*编辑工具*/

    $('.editor-tool-box').click(function () {
       var index = $(this).index('.editor-tool-box');
       $('.editor-tool-box').removeClass('active');
       $('.editor-tool-box').eq(index).addClass('active');
    });
    $('.editor-tool-box').eq(0).trigger("click");
    /**
     * 版本修改
     */
    $('.quitEditor').click(function () {
        $('.creatHT').show();
        $('.versionChange').hide();
    });

    $('.insurePassword').click(function () {
        $('.eSign').show();
        $('.insureDraft ,.insureLine,.insureTitle,.insurePassword').hide();
    });

    $('.eSign').click(function () {
        $('.eSignAuthModel').show();
    });

    $('.eSignModel-content').click(function () {
        $('.htSign').show();
        $('.creatHT,.versionChange,.versionManageBtn,.eSignAuthModel').hide();
    });

    $('.insureDraft').click(function () {
        $('.insureModel').show();
    });

    $('.backToEditor').click(function () {
        $('.versionChange').hide();
        $('.editorHT').show();
    });
    /**
     * 合同签名
     */
    $('.cancelSign').click(function () {
        $('.htSign').hide();
        $('.versionChange').show();
    });

    $('.signNext').click(function () {
        $('.htSeal').show();
        $('.htSign').hide();
    });

    $('.htSignPreItem').click(function () {
        var preIndex = $(this).index('.htSignPreItem');
        $('.htSignPreItem').removeClass('htSignPreItemActive');
        $('.page').removeClass('pageActive');
        $('.htSignPreItem').eq(preIndex).toggleClass('htSignPreItemActive');
        $('.htSignPreItem>.page').eq(preIndex).toggleClass('pageActive');
        $('.htSignPre-model').show();

    });

    $('.htPreSidebarItem').click(function () {
        var preIndex = $(this).index('.htPreSidebarItem');
        $('.htPreSidebarItem').removeClass('htPreSidebarItemActive');
        $('.page').removeClass('pageActive');
        $('.htPreSidebarItem').eq(preIndex).toggleClass('htPreSidebarItemActive');
        $('.htPreSidebarItem>.page').eq(preIndex).toggleClass('pageActive');

    });

    $('.addContactSign').click(function () {
        $('.addContactSign').toggleClass('activeAddContactSign');
    });

    $('.addContactSignModel').click(function () {
        $('.addContactSignModel').toggleClass('activeAddContactSign');
    });

    $('.shareModelSignRemove').click(function () {
        var index = $(this).index('.shareModelSignRemove');
        $('.shareModelSignRemove').eq(index).toggleClass('activeShareModelSignRemove');
    });

    /**
     * 合同盖章
     */
    $('.helpIcon').click(function () {
        if ($('.helpModel').css("display") == "none") {
            $('.helpModel').show();
        } else {
            $('.helpModel').hide();
        }
    });

    $('.noRemind,.know').click(function () {
        $('.helpModel').hide();
    });

    $('.qifengzhang').click(function () {
        $('.sealPage-model,.sealSelect').show();
        $('.sealLocal').hide();
    });

    $('.danyeqian').click(function () {
        $('.sealLocal').show();
        $('.sealSelect').hide();
    });

    $('.sealLocal').draggable({
        stop: function (event, ui) {
          $('.sealPage-model').show();
          $('.sealLocal').css('background',"url(./img/icon/sealSelected.png) no-repeat")
        }
    });

    $('.cancelSealPage').click(function () {
        $('.sealPage-model,.sealSelect,.sealLocal').hide();
    });

    $('.insureSealPage').click(function () {
        $('#sealPageModal').hide();
    });

    $('.insureSealBtn').attr("disabled", true);

    $('#sealYZM').click(function () {
        $('.insureSealBtn').attr("disabled", false);
        $('.insureSealBtn').css("background", "#095963");
    });

    /**
     * 签章弹框
     */
    $('.radioSealAll').click(function () {
        $('.radioSealAll').toggleClass('activeRadioSealAll');
    });

    $('.radioSealPart').click(function () {
        $('.radioSealPart').toggleClass('activeRadioSealPart');
    });

    /*返回顶部*/
    $('.backTop').click(function () {
      $('.mCSB_dragger').css("top","0px");
      $('.mCSB_container').css("top","0px");
    });

    /**
     * 版本记录
     */
    $('.versionManagePre').click(function () {
        var preIndex = $(this).index('.versionManagePre');
        $('.versionManagePre').removeClass('versionManagePreActive');
        $('.page').removeClass('pageActive');
        $('.versionManagePre').eq(preIndex).toggleClass('versionManagePreActive');
        $('.versionManagePre>.page').eq(preIndex).toggleClass('pageActive');
    });

    $('.versionManageBack').click(function () {
        $('.versionManage').hide();
        $('.creatHT').show();
    });

    $('.View').click(function () {
       $('.versionManage,.View').hide();
       $('.versionView').show();
    });

    $('.backVersionManage').click(function () {
        $('.versionView').hide();
        $('.versionManage').show();
    });

    /**
     * 版本查看
     */

    $('.versionModelItem').click(function () {
        var index= $(this).index('.versionModelItem');
        $('.versionModelItem').removeClass('versionModelItemActive');
       $('.versionModelItem').eq(index).toggleClass('versionModelItemActive');
       if($('.versionModelItem').hasClass('versionModelItemActive')){
           $('.composeFile').css("background","#095963");
       }else {
           $('.composeFile').css("background","#9b9b9b");
       }
    });

    /**
     * 弹框
     *
     */
    $('.versionEditor').click(function () {
       $('.Editor-model,.versionManageBtn').show();
    });

    $('.signRecord').click(function () {
       $('.signRecord-model').show();
    });

    $('.addReceive').click(function () {
       $('.addSignUser-model').show();
    });

    $('.compaseFile').click(function () {
       $('.compaseFileModel').show()
    });
    $('.versionManageSidebarItem').click(function () {
        var index = $(this).index('.versionManageSidebarItem');
        $('.versionManageSidebarItemActive').remove();
        $('.versionManageSidebarItem').eq(index).append('<span class="versionManageSidebarItemActive"></span>')
    });
    /**
     * 弹框关闭
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

    $('.cancelVersion').click(function () {
        $('.compaseFileModel').hide();
    });

    $('.insureSealPage').click(function () {
       $('.authUserModel') .show();
    });

    $('.creatHTSidebarItem').click(function () {
        var index = $(this).index('.creatHTSidebarItem');
        $('.creatHTSidebarItemActive').remove();
        $('.creatHTSidebarItem').eq(index).append('<span class="creatHTSidebarItemActive"></span>');
    });

    $('.versionChangeUser').click(function () {
    var index = $(this).index('.versionChangeUser');
    $('.versionChangeUserActive').remove();
    $('.versionChangeUser').eq(index).append('<span class="versionChangeUserActive"></span>')
});

});

