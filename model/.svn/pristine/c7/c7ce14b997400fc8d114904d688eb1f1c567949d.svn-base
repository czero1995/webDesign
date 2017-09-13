<template>
  <div class="xzsf">
      <p class="title">告诉我们，你是...</p>
      <div class="m-radio">
          <div class="radio-box" @click='showModel'>
              
          </div>
      </div>
      <div class="bg-model" @click='closeModel'>   
        <div class="message-box" @click='Showmodel'>
            <span class="close" @click='closeModel'>X</span>
            <p>请选择您的企业类型</p>
            <div class="message-radio">
              <mt-radio v-model="value" :options="options"></mt-radio>
            </div>
            <div class="box-shadow"></div>
        </div>
      </div>
  </div>
</template>

<script>

export default {
  name: 'xzsf',
  data () {
    return {
      value:'',
      options:[
        {
          label: '摄影机构',
          value: '摄影机构'
        },
        {
          label: '摄影机构1',
          value: '摄影机构1'
        },
        {
          label: '摄影机构2',
          value: '摄影机构2'
        },
        {
          label: '摄影机构3',
          value: '摄影机构3'
        },
        {
          label: '摄影机构4',
          value: '摄影机构4'
        },
        {
          label: '摄影机构5',
          value: '摄影机构5'
        },
        {
          label: '摄影机构6',
          value: '摄影机构6'
        },
        {
          label: '摄影机构7',
          value: '摄影机构7'
        },
        {
          label: '摄影机构8',
          value: '摄影机构8'
        }
      ]
    }
  },
  components: {
   
  } ,
  methods: {
   showModel:function () {
      $(".bg-model").fadeTo(200, 1);
   },
   closeModel:function () {
     $(".bg-model").hide();
   },
   Showmodel:function (event) {
     event.stopPropagation();
   }
  },
  mounted:function () {
    $("title").html("选择身份");
  },
  watch: {
    value : function(){
      console.log(this.value)
    }
  },
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.xzsf{padding-top: 0.7rem;}

.title{font-size: 0.43rem;color: #F2BA3D;text-align: center;margin-bottom: 0.6rem;}

.m-radio{padding: 0 0.3rem 0.5rem 0.3rem;}
.m-radio .radio-box{width: 100%;height: 1.7rem;border-radius: 50px;box-shadow: 1px 5px 10px rgba(0,0,0,.3);padding-left: 1.85rem;}

.bg-model {top: 0%;left: 0%;display: none;background: rgba(0, 0, 0, 0.5);width: 100%;height: 100%;position: absolute;z-index: 9999}
.message-box{padding-top: 0.95rem;width: 5.78rem;height: 6.8rem;background: #fff;position: absolute;top:50%;left:50%;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%); }
.message-box p{font-size: 0.28rem;color: #999;margin-bottom: 0.15rem;text-align: center;}
.close{color: #F2BB3F;position: absolute;right: 0.3rem;top: 0.25rem;display: block;font-size: 0.4rem;}
.message-radio{height: 5rem;overflow: hidden;overflow-y: auto;padding-left: 1.35rem;}
.message-box .box-shadow{height: 0.6rem;position: absolute;bottom: 0;left: 0;width: 100%;background: #fff;box-shadow:0px -10px 5px rgba(255,255,255,.6);}
</style>
