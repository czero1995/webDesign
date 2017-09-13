/**
 * Created by dangran on 2017/8/14.
 */
$(function () {

    $('#banner_table').bootstrapTable({
        //url : '__URL__/getList',
        toolbar : '#toolbar', // 指明自定义的toolbar
        pagination : true, //显示分页条
        pageNumber : 1, //首页页码
        pageSize : 15, //页面数据条数
        pageList : [15, 20, 30, 50, 100],
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
                    title: '轮播图类型',
                    align: 'center',
                    width: 20
                },
                {
                    field: 'type',
                    title: '轮播图类型',
                    width: 50,
                    align: 'center'
                },
                {
                    field: 'post',
                    title: '配图',
                    align: 'center',
                    width: 80,
                    formatter: function (value) {
                        return "<img src='/admin/dist/img/user2-160x160.jpg' class='img-circle' style='max-width: 45px;border: 1px solid #00A1CB ;'>" ;
                    }
                },
                {
                    field: 'status',
                    title: '状态',
                    align: 'center',
                    width: 100,
                    formatter: function(value,row)
                    {
                        var c = '' ;
                        if(value=='1')
                        {
                            c = 'checked' ;
                        } else {
                            c = '' ;
                        }
                        var s = '<label class="switch switch-success bk-margin-top-10">'+
                                '<input type="checkbox" class="switch-input" uid="'+ row.id +'" ' + c +' >'+
                                '<span class="switch-label" data-on="启用" data-off="禁用"></span>'+
                                '<span class="switch-handle"></span>'+
                                '</label>' ;
                        return s;
                    }
                },
                
                {
                    field: 'create_time',
                    title: '添加时间',
                    align: 'center',
                    width: 100
                },
                {
                    field: 'id',
                    title: '操作',
                    width: 150,
                    align: 'center',
                    formatter: function(value,row)
                    {
                        var detail = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-success detail_user" ><i class="fa fa-search" ></i> 详情</button>'

                        var edit = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-primary edit_admin" data-toggle="modal" data-target="#edit_admin" data-backdrop="static"><i class="fa fa-edit" ></i> 修改</button>'

                        var del  = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-danger del_user" ><i class="fa fa-times" ></i> 删除</button>'

                        return detail + ' ' + edit + ' ' + del ;

                    }
                }
            ]
    });

    //表单清空
    $('#add_banner').on('hide.bs.modal', function () {
        document.getElementById("form1").reset();
    })

    //添加banner
    $('#banner_add').click(function(){
        $.ajax({
            url: YZL['URL'] + '/addbanner',
            type: 'post',
            data: {
                'name': $.trim($('#name').val()),
                'intro': $.trim($('#intro').val()),
                'title': $.trim($('#title').val()),
                'cate_id': $('#cate_id option:selected').val()
            },
            success: function(res) {

                if(res.data != false ) {
                    $('#banner_add').modal('hide');
                    $('#banner_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getBannerList'});
                    layer.msg('添加成功',{icon:6});
                } else {
                    layer.msg('添加失败',{icon:5});
                }

            }
        },'json');

    });

})
