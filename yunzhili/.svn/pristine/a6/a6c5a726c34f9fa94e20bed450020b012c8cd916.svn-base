/**
 * Created by dangran on 2017/8/14.
 */
$(function () {

    $('#coach_table').bootstrapTable({
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
                    width: 20
                },
                {
                    field: 'headimg',
                    title: '头像',
                    align: 'center',
                    width: 80,
                    formatter: function (value) {
                        return "<img src='"+ value +"' class='img-circle' style='width: 45px;height: 45px;border: 1px solid #00A1CB ;'>" ;
                    }
                },
                {
                    field: 'name',
                    title: '姓名',
                    width: 50,
                    align: 'center'
                },
                {
                    field: 'title',
                    title: '类型',
                    align: 'center',
                    width: 100
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
                                '<input type="checkbox" class="switch-input switch-input1" id="'+ row.id +'" ' + c +' >'+
                                '<span class="switch-label" data-on="在职" data-off="离职"></span>'+
                                '<span class="switch-handle"></span>'+
                                '</label>' ;
                        return s;
                    }
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
                            '<input type="checkbox" class="switch-input switch-input2" id="'+ row.id +'" ' + c +' >'+
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
                        var detail = '<a data-id="'+ value +'" href="getCoachInfo/id/'+ value +'/type/1" class="btn btn-xs btn-success " ><i class="fa fa-search" ></i> 详情</a>'

                        var edit = '<a data-id="'+ value +'" href="edit/id/'+ row.id +'" class="btn btn-primary btn-xs" ><i class="fa fa-edit"></i> 修改</a>'
                        /*var edit = '<button data-uid="'+ value +'" type="button" class="btn btn-xs btn-primary edit_coach" data-toggle="modal" data-target="#edit_coach" data-backdrop="static"><i class="fa fa-edit" ></i> 修改</button>'*/
                        var del  = '<button data-id="'+ value +'" type="button" class="btn btn-xs btn-danger del_coach" ><i class="fa fa-times" ></i> 删除</button>'

                        return detail + ' ' + edit + ' ' + del ;

                    }
                }
            ]
    });

    //添加教练
    $('#coach_add').click(function(){
        //场馆
        var stadiumIds = [];
        $('input[name="stadiumid"]:checked').each(function(){
            stadiumIds.push($(this).val());
        });
        //课程
        var courseIds = [];
        $('input[name="courseid"]:checked').each(function(){
            courseIds.push($(this).val());
        });
        //标签
        var tagsIds = [];
        $('input[name="tagsid"]:checked').each(function(){
            tagsIds.push($(this).val());
        });

        $(this).attr('disabled',true);

        $.ajaxFileUpload({
            url: YZL['URL'] + '/addCoach',
            type: 'post',
            data: {
                'name': $.trim($('#name').val()),
                'intro': $.trim($('#intro').val()),
                'title': $.trim($('#title').val()),
                'cate_id': $('#cate_id option:selected').val(),
                'tagsIds': tagsIds,
                'stadiumIds': stadiumIds,
                'courseIds': courseIds
            },
            secureuri: false, //一般设置为false
            fileElementId: 'headimg', // 上传文件的id、name属性名
            dataType: 'JSON', //返回值类型，一般设置为json、application/json  这里要用大写  不然会取不到返回的数据
            success: function(data) {
                //此处返回的json被<pre>包含
                var start = data.indexOf(">");
                if(start != -1) {
                    var end = data.indexOf("<", start + 1);
                    if(end != -1) {
                        data = data.substring(start + 1, end);
                    }
                }
                //以上代码 去除<pre></pre> 保留json格式数据 此时json为字符串格式

                var res = $.parseJSON(data); //把json数据转换成对象
                if(res.status == 200 || res.errcode == 200) {

                    layer.msg('修改成功',{icon:6,title:'温馨提示'},function () {
                            window.location = admin_url+"admin/coach";
                        })
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

    //表单清空
    $('#add_coach').on('hide.bs.modal', function () {
        document.getElementById("form1").reset();
    })

    //单条数据删除
    $('body').on('click','.del_coach',function(){
        var _this = $(this);
        layer.confirm('确定要删除吗', {
            btn: ['确定','取消'],
            icon:0,
            title:'温馨提示',
            anim:4 //按钮
        }, function(){
            var id = _this.attr('data-id');
            $.ajax({
                url: YZL['URL'] + '/deleteCoach',
                type: 'post',
                data: {'id':id},
                success: function(res) {
                    if(res.errcode == 200) {
                        /*layer.msg('删除成功',{icon:6,title:'温馨提示'});
                        $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});*/
                        layer.msg('删除成功',{icon:6,title:'温馨提示'},function () {
                            window.location =admin_url+"admin/coach";
                        })
                    } else {
                        layer.msg('删除失败',{icon:5,title:'温馨提示'});
                    }
                }
            });
        });
    });

    //批量删除
    $('#btn_delete').click(function(){

        var ids = $('#coach_table').bootstrapTable("getSelections");
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
                url: YZL['URL'] + '/deleteCoachList',
                type: 'post',
                data: {'id':arrid.join(',')}, //id变为字符串 格式：1,2,3...
                success: function(res) {
                    if(res.errcode == 200) {
                        layer.msg('删除成功',{icon:6,title:'温馨提示'});
                        $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});
                    } else {
                        layer.msg('删除失败',{icon:5,title:'温馨提示'});
                    }
                }
            });

        });

    });

    //教练详情
    $('body').on('click','.detail_coach',function(){
        var _this = $(this);

        var detail = layer.open({
            type: 2,
            title:'教练详情',
            fixed: true, //固定
            maxmin: true,
            area: ['90%', '80%'],
            content: '/admin/admin/getCoachInfo/id/' + _this.attr('data-id') + '/type/1'
        });
        layer.full(detail);
    });

    //状态操作
    $("body").on('click','.switch-input1',function(){
        var id = $(this).attr('id');
        var url = YZL['URL'] + '/coachStatus';
        if($(this).is(':checked')==false) {
            $.ajax({
                'url':url,
                'type':'post',
                'data':{'id':id,'status':'2','type':1},
                'success':function(dj){
                    if(dj.status == 'success'){
                        layer.msg('状态已变为【离职】');
                    }else{
                        $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});
                        layer.msg(dj.msg);
                    }
                },
            },'json');
        } else {
            $.ajax({
                'url':url,
                'data':{'id':id,'status':'1','type':1},
                'type':'post',
                'success':function(dj){
                    if(dj.status == 'success'){
                        layer.msg('状态已变为【在职】');
                    }else{
                        $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});
                        layer.msg(dj.msg);
                    }
                },
            },'json');
        }
    });

    //推荐操作
    $("body").on('click','.switch-input2',function(){
        var id = $(this).attr('id');
        var url = YZL['URL'] + '/coachStatus';
        if($(this).is(':checked')==false) {
            $.ajax({
                'url':url,
                'type':'post',
                'data':{'id':id,'is_recommend':'2','type':2},
                'success':function(dj){
                    if(dj.status == 'success'){
                        layer.msg('成功设置『不推荐』');
                    }else{
                        $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});
                        layer.msg(dj.msg);
                    }
                },
            },'json');
        } else {
            $.ajax({
                'url':url,
                'data':{'id':id,'is_recommend':'1','type':2},
                'type':'post',
                'success':function(dj){
                    if(dj.status == 'success'){
                        layer.msg('成功设置『推荐』');
                    }else{
                        $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});
                        layer.msg(dj.msg);
                    }
                },
            },'json');
        }
    });

    //表单清空
    $('#edit_coach').on('hide.bs.modal', function () {
        $('.einput').removeAttr("checked"); //移除属性防止干扰
    })

    //修改教练页面
    $('body').on('click','.edit_coach',function(){
        var _this = $(this);
        $.ajax({
            url: admin_url+'admin/getCoachInfo',
            type: 'post',
            data: {
                'id': $.trim(_this.attr('data-id')),
                'type': 2
            },
            success: function(res) {
                $('#eid').val(res.id);
                $('#ename').val(res.name);
                $('#eintro').val(res.intro);
                $('#etitle').val(res.title);
                $('#ecate_id').val(res.type.id); //设置选中
                console.log(res);

                //设置场馆选中
                if(res.stadium_info)
                {
                    for (var i = 0; i<res.stadium_info.length; i++)
                    {
                        $('input[name="estadiumid"][value="'+res.stadium_info[i]['id']+'"]').attr('checked',true);
                    }
                }

                //设置标签选中
                if(res.tags_name)
                {
                    for (var i = 0; i<res.tags_name.length; i++)
                    {
                        $('input[name="etagsid"][value="'+res.tags_name[i]['id']+'"]').attr('checked',true);
                    }
                }

                //设置课程选中
                if(res.course_info)
                {
                    for (var i = 0; i<res.course_info.length; i++)
                    {
                        $('input[name="ecourseid"][value="'+res.course_info[i]['id']+'"]').attr('checked',true);
                    }
                }

                //设置图片
                $('#eImgPr').attr('src',res.headimg);

            }
        },'json');
    });
    //修改教练动作
    $('#coach_edit').click(function(){
        //场馆
        var stadiumIds = [];
        $('input[name="estadiumid"]:checked').each(function(){
            stadiumIds.push($(this).val());
        });
        //课程
        var courseIds = [];
        $('input[name="ecourseid"]:checked').each(function(){
            courseIds.push($(this).val());
        });
        //标签
        var tagsIds = [];
        $('input[name="etagsid"]:checked').each(function(){
            tagsIds.push($(this).val());
        });

        $(this).attr('disabled',true);

        $.ajaxFileUpload({
            url: YZL['URL'] + '/editCoach',
            type: 'post',
            data: {
                'id': $('#eid').val(),
                'name': $.trim($('#ename').val()),
                'intro': $.trim($('#eintro').val()),
                'title': $.trim($('#etitle').val()),
                'cate_id': $('#ecate_id option:selected').val(),
                'tagsIds': tagsIds,
                'stadiumIds': stadiumIds,
                'courseIds': courseIds
            },
            secureuri: false, //一般设置为false
            fileElementId: 'eheadimg', // 上传文件的id、name属性名
            dataType: 'JSON', //返回值类型，一般设置为json、application/json  这里要用大写  不然会取不到返回的数据
            success: function(data) {
                //此处返回的json被<pre>包含
                var start = data.indexOf(">");
                if(start != -1) {
                    var end = data.indexOf("<", start + 1);
                    if(end != -1) {
                        data = data.substring(start + 1, end);
                    }
                }
                //以上代码 去除<pre></pre> 保留json格式数据 此时json为字符串格式

                var res = $.parseJSON(data); //把json数据转换成对象
                if(res.status == 200 || res.errcode == 200) {

                    // $('#add_coach').modal('hide');
                    // $('#coach_table').bootstrapTable('refresh',{url: YZL['URL'] + '/getCoachList'});
                        layer.msg('修改成功',{icon:6,title:'温馨提示'},function () {
                            window.location = admin_url+"admin/coach";
                        })
                       
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

})
