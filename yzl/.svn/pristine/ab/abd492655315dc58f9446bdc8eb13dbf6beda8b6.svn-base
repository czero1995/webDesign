/**
 * Created by dangran on 2017/8/14.
 */
$(function () {

    $('#course_table').bootstrapTable({
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
                    title: '排序',
                    align: 'center',
                    width: 20
                },
                {
                    field: 'title',
                    title: '课程名称',
                    align: 'center',
                    width: 50,
                },
                {
                    field: 'sub_title',
                    title: '课程简介',
                    width: 100,
                    align: 'center'
                },
                {
                    field: 'post',
                    title: '封面图',
                    align: 'center',
                    width: 50,
                    formatter:function(value,row){
                         return "<img src='/admin/dist/img/user3-128x128.jpg' class='img-circle' style='max-width: 45px;border: 1px solid #00A1CB ;'>" ;
                    }
                },
                {
                    field: 'price',
                    title: '价格',
                    align: 'center',
                    width: 50
                },
                {
                    field: 'is_recommend',
                    title: '是否推荐',
                    align: 'center',
                    width: 50,
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
                            '<span class="switch-label" data-on="是" data-off="否"></span>'+
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
                        var detail = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-success detail" data-toggle="modal" href="#modal-id"><i class="fa fa-search" ></i> 详情</button>'

                        var edit = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-primary edit_course" data-toggle="modal" data-target="#edit_admin" data-backdrop="static"><i class="fa fa-edit" ></i> 修改</button>'

                        var del  = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-danger del_course" ><i class="fa fa-times" ></i> 删除</button>'

                        return detail + ' ' + edit + ' ' + del ;

                    }
                }
            ]
    });

    //表单清空
    $('#add_course').on('hide.bs.modal', function () {
        document.getElementById("form1").reset();
    })

    //添加课程
    $('#course_add').click(function(){
        
        $.ajax({
            url: YZL['URL'] + '/addCourse',
            type: 'post',
            data: {
                'cate_id': $('#cate_id option:selected').val(),
                'title': $.trim($('#title').val()),
                'sub_title': $.trim($('#sub_title').val()),
                'intro': ue.getContent(),
                'price': $.trim($('#price').val()),

            },
             secureuri: false, //一般设置为false
            fileElementId: 'post', // 上传文件的id、name属性名
            dataType: 'JSON', //返回值类型，一般设置为json、application/json  这里要用大写  不然会取不到返回的数据
            ajaxStart: function() {
                var file = $('#post').val();
                if(file == '')
                {
                    layer.msg('请上传图片',{icon:0,title:'温馨提示'});
                    return false;
                }
            },
            success: function(res) {
                if(res.data != false ) {
                    layer.msg('添加成功',{icon:6});
                } else {
                    layer.msg('添加失败',{icon:5});
                }

            }
        },'json');

    });


    /*修改课程*/
   /* $('body').on('click','.edit_course',function(){
         var _this = $(this);
         $.ajax({
            url:YZL['URL'] + '/addCourse',
            type:'post',
            data:{
                'id':$.trim(_this.attr('data-uid')),
            }
            success: function(res) {
                $('#id').val(res.id);
                $('#title').val(res.title);
                $('#sub_title').val(res.sub_title);
                $('#intro').val(res.intro);
                $('#post').val(res.post);
                $('#price').val(res.price);
                $('#cate_id option[value="'+res.type.id+'"]').attr('selected',true);
            }
         });
    });
*/

    //单条数据删除
    $('body').on('click','.del_course',function(){
        var _this = $(this);
        layer.confirm('确定要删除吗', {
            btn: ['确定','取消'],
            icon:0,
            title:'温馨提示',
            anim:4 //按钮
        }, function(){
            var id = _this.attr('data-uid');
            $.ajax({
                url: YZL['URL'] + '/delCourse',
                type: 'post',
                data: {'id':id},
                success: function(res) {
                    if(res.errcode == 200) {
                        layer.msg('删除成功',{icon:6,title:'温馨提示'});
                        $('#course_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCourseList'});
                    } else {
                        layer.msg('删除失败',{icon:5,title:'温馨提示'});
                    }
                }
            });
        });
    });
   

})
