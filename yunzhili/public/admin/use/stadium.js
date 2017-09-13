/**
 * Created by dangran on 2017/8/17.
 */

//获取场馆列表
var stadium = new Vue({
    el: '.content-wrapper',
    data: {
        //itemList: [],
        //page: [],
        formData:{
            title: '',
            intro: '',
            cate_id: '',
            province_code: '',
            city_code: '',
            district_code: '',
            address: '',
            tel: '',
            wechat: '',
            booking_url: '',
            post:''
        },
        ids: []
    },
    created: function () {
        //生命周期 开始即挂载
        //this.getDate()
    },
    methods: {
        // getDate: function ()
        // {
        //     var self = this;
        //     $.getJSON('/api/stadium/getStadiumList',function (res) {
        //         self.itemList = res.data.list;
        //         self.page = res.data.page;
        //     })
        // },
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
    
        },
        stadium_add: function ()
        {
            //$('#stadium_adds').arrt('disabled',true);
            var course_ids = [];

            $("input[name='courseid']").each(function () {

                if($(this).is(':checked'))
                {
                    course_ids.push($(this).val());
                }

            });

            var self = this;
            axios.post(api_url+'stadium/addStadium', {
                title: self.formData.title,
                intro: ue.getContent(),
                cate_id: self.formData.cate_id,
                province_code: self.formData.province_code,
                city_code: self.formData.city_code,
                district_code: self.formData.district_code,
                address: self.formData.address,
                tel: self.formData.tel,
                wechat: self.formData.wechat,
                booking_url: self.formData.booking_url,
                course_ids: course_ids,
                post: self.image,

            }) 
            .then(function (response) {
                if(response.data.errcode == 200)
                {
                    layer.msg('添加成功',{icon:6,title:'温馨提示'},function () {
                        window.location =admin_url+"stadium/index";
                    })
                } else {
                    layer.msg('添加失败',{icon:5,title:'温馨提示'},function () {
                       window.location.reload();
                    });
                }
            })
            .catch(function (error) {
                layer.msg('系统出错，请稍候再试！',{icon:5,title:'温馨提示'},function () {
                    window.location.reload();
                });
            });
        },
        delStadium: function (id) {
            console.log(id);
            layer.alert('确定要删除吗？',{icon:0,title:'温馨提示',anim:4},function () {
                $.getJSON(api_url+"stadium/delStadium/id/"+id,function(res){
                    layer.closeAll();
                    if(res.errcode == 200)
                    {
                        layer.msg('删除成功',{icon:6,title:'温馨提示'},function () {
                            window.location.reload();
                        })
                    } else {
                        layer.msg('删除失败',{icon:5,title:'温馨提示'},function () {
                            window.location.reload();
                        });
                    }

                })
            });
        },
        delStadiums: function () {

            var ids = this.ids;

            $("input[type='checkbox']").each(function () {

                if($(this).is(':checked'))
                {
                    ids.push($(this).attr('id'));
                }

            });

            if(ids.length <= 0)
            {

                layer.msg('请至少选择一条数据');

            } else {

                layer.alert('确定要删除吗？',{icon:0,title:'温馨提示',anim:4},function () {

                    axios.post(api_url+'stadium/delStadium', {
                        id: ids
                    })
                    .then(function (res) {
                        layer.closeAll();
                        if(res.data.errcode == 200)
                        {
                            layer.msg('删除成功',{icon:6,title:'温馨提示'},function () {
                                window.location.reload();
                            })
                        } else {
                            layer.msg('删除失败',{icon:5,title:'温馨提示'},function () {
                                window.location.reload();
                            });
                        }
                    })
                    .catch(function (error) {
                        layer.msg('系统出错，请稍候再试！',{icon:5,title:'温馨提示'},function () {
                            window.location.reload();
                        });
                    });

                });

            }

        }

    }
});
/*
//表单清空
$('#add_stadium').on('hide.bs.modal', function () {
    document.getElementById("form1").reset();
})*/
