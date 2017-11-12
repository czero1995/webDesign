/**
 * Created by dangran on 2017/8/21.
 */

$('#type_table').bootstrapTable({
    //url : '__URL__/getList',
    toolbar : '#toolbar', // 指明自定义的toolbar
    pagination : true, //显示分页条
    pageNumber : 1, //首页页码
    pageSize : 10, //页面数据条数
    pageList : [10, 20, 30, 50, 100],
    //search : true, //是否启用搜索框 服务端建议不开启
    //searchAlign : 'left',
    // searchText : '请输入关键字', //初始化搜索文字
    showRefresh : true, //显示 刷新按钮
    showToggle : false, //显示 切换试图（table/card）按钮
    //showPaginationSwitch : true, //是否显示 数据条数选择框
    //detailView :　true,// 可以显示详细页面模式。
    clickToSelect : false, //设置true 将在点击行时，自动选择rediobox 和 checkbox
    singleSelect : false, //设置True 将禁止多选
    checkboxHeader : true, //设置false 将在列头隐藏check-all checkbox
    sortable : true, //设置为false 将禁止所有列的排序
    showExport: false,  //是否显示导出
    exportDataType: "basic",  //basic', 'all', 'selected'.
    sortName :　'id',
    sortOrder: 'desc', //排序方式
    showColumns : false, //显示下拉框
    striped : true, //是否显示行间隔色
    cache: false,  //是否使用缓存
    sidePagination: "server", //服务端获取数据
    queryParamsType: '', //默认值为 'limit' ,在默认情况下 传给服务端的参数为：offset,limit,sort
    // icons: {refresh:'fa fa-refresh'},

    queryParams: function (params) {
        return {
            pageSize: this.pageSize,
            pageNumber: this.pageNumber,
            sortName: this.sortName,
            sortOrder: this.sortOrder
        };
    },
    columns :
        [
            {
                checkbox: true
            },
           
            {
                field: 'sort',
                title: '排序',
                align: 'center',
                width: 30
            },
            {
                field: 'title',
                title: '名称',
                align: 'center',
                width: 100
            },
            {
                field: 'id',
                title: '操作',
                width: 150,
                align: 'center',
                formatter: function(value, row)
                {
                    var edit = '<button class="btn btn-primary btn-xs edit_stadium_type" id='+row.id+' data-toggle="modal" data-target="#edit_stadium_type" data-backdrop="static"><i class="fa fa-edit"></i> 修改</button>'
                    var del = '<button class="btn btn-danger btn-xs delStadium" id='+row.id+'><i class="fa fa-times"></i> 删除</button>'

                    return edit + ' ' + del ;

                }
            }
        ]
});

//表单清空
$('#add_stadium_type').on('hide.bs.modal', function () {
    document.getElementById("form1").reset();
})

//添加场馆
$('#stadium_type_add').click(function(){

    $(this).attr('disabled',true);

    $.ajax({
        url: admin_url+'stadiumcate/add',
        type: 'post',
        data: {
            'title': $.trim($('#title').val()),
        },
        success: function(res) {
            //console.log(res.errcode);
            if(res.errcode == 200) {

             /*   $('#add_stadium_type').modal('hide');
                $('#type_table').bootstrapTable('refresh',{url: admin_url+'stadium/getStadiumTypeList'});

                layer.msg('添加成功',{icon:6,title:'温馨提示'});*/
                layer.msg('添加成功',{icon:6,title:'温馨提示'},function(){
                    window.location =admin_url+"stadiumcate/index";
                });
            } else if(res.status == 500 || res.errcode == 500) {
                $(this).attr('disabled',false);
                layer.msg('添加失败',{icon:5,title:'温馨提示'});
            } else {
                $(this).attr('disabled',false);
                layer.msg(res.message,{icon:0,title:'温馨提示'});
            }

        }
    },'json');

});

//单条数据删除
$('body').on('click','.delStadium',function(){
    var _this = $(this);
    layer.confirm('确定要删除吗', {
        btn: ['确定','取消'],
        icon:0,
        title:'温馨提示',
        anim:4 //按钮
    }, function(){
        var id = _this.attr('id');
        $.ajax({
            url: admin_url+'stadiumcate/del',
            type: 'post',
            data: {'id':id},
            success: function(res) {
                if(res.errcode == 200) {
                    layer.msg('删除成功',{icon:6,title:'温馨提示'},function(){
                        window.location =admin_url+"stadiumcate/index";
                    });
                } else {
                    layer.msg('删除失败',{icon:5,title:'温馨提示'});
                }
            }
        });
    });
});

//批量删除
$('#btn_delete').click(function(){

    var ids = $('#type_table').bootstrapTable("getSelections");
    var arrid = Array();
    for(var i=0;i<ids.length;i++) {
        arrid.push(ids[i].id);
    }
    if(arrid.length < 1) {
        layer.msg('请至少选择一条数据');
        return false;
    }

    layer.confirm('确定要删除所选项吗', {
        btn: ['确定','取消'],
        icon:0,
        title:'温馨提示',
        anim:4 //按钮
    }, function(){

        $.ajax({
            url: admin_url+'stadium/delStadiumType',
            type: 'post',
            data: {'id':arrid},
            success: function(res) {
                if(res.errcode == 200) {
                    layer.msg('删除成功',{icon:6,title:'温馨提示'});
                    $('#type_table').bootstrapTable('refresh',{url: admin_url+'stadium/getStadiumTypeList'});
                } else {
                    layer.msg('删除失败',{icon:5,title:'温馨提示'});
                }
            }
        });

    });

});

//表单清空
$('#edit_stadium_type').on('hide.bs.modal', function () {
    $('.einput').removeAttr("checked"); //移除属性防止干扰
})

//修改教练页面
$('body').on('click','.edit_stadium_type',function(){
    var _this = $(this);
    $.ajax({
        url: admin_url+'stadiumcate/edit',
        type: 'post',
        data: {
            'id': $.trim(_this.attr('id'))
        },
        success: function(res) {
            console.log(res);
            $('#eid').val(res.data.id);
            $('#etitle').val(res.data.title);

        }
    },'json');
});
//修改教练动作
$('#stadium_type_edit').click(function(){

    $(this).attr('disabled',true);

    $.ajax({
        url: api_url+'stadiumcategory/editStadiumcate',
        type: 'post',
        data: {
            'id': $('#eid').val(),
            'title': $.trim($('#etitle').val())
        },
        success: function(res) {
            $(':button').attr('disabled',false);
            if(res.status == 200 || res.errcode == 200) {

                layer.msg('修改成功',{icon:6,title:'温馨提示'},function(){
                    window.location =admin_url+"stadiumcate/index";
                });

            } else if(res.status == 500 || res.errcode == 500) {
                $(this).attr('disabled',false);
                layer.msg('修改失败',{icon:5,title:'温馨提示'});
            } else {
                $(this).attr('disabled',false);
                layer.msg(res.message,{icon:0,title:'温馨提示'});
            }

        }
    },'json');

});

