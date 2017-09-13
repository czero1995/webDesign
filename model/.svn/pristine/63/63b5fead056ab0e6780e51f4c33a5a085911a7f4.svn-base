<template>
  <div class="signin">
      <p class="title">Hi~欢迎加入</p>
      <div class="input-box active">
        <i class="name-icon"></i><input class="user" type="text" placeholder='请输入昵称'>
      </div>
      <div class="input-box">
        <i class="user-icon"></i><input class="user" type="text" placeholder='请输入手机号码'>
      </div>
      <div class="input-box">
        <i class="psd-icon"></i><input class="user" type="text" placeholder='请输入密码'>
        <span class="yzm">获取验证码</span>
      </div>
      <div class="input-box">
        <i class="psd2-icon"></i><input class="user" type="text" placeholder='请再次输入密码'>
      </div>
      <span class="submit">          
          <router-link  to='/xzsf'>注册</router-link>
      </span>
      <span class="login">
          <router-link  to='/login'>立即登录</router-link>
      </span>
      <div class="fwtk clearfloat">
        <p class="fwtk-box" :class="{ active: isActive }" @click='changeActive'><span class="gou"></span>已阅读并同意<a href="javascript:void(0)">《服务条款》</a></p>        
      </div>
  </div>
</template>

<script>

export default {
  name: 'signin',
  data () {
    return {
      isActive:true
    }
  },
  components: {
   
  } ,
  methods: {
   changeActive:function () {
     this.isActive = !this.isActive;
   }
  },
  mounted:function () {
    $("title").html("注册");
    $('body').on('click','.input-box',function () {
      $('.input-box').removeClass('active');
      $(this).addClass('active');
    });
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.signin{padding-top: 0.9rem;padding-bottom: 2rem;}
.title{font-size: 0.43rem;color: #F2BA3D;text-align: center;margin-bottom: 0.45rem;}

.input-box{padding: 0 0.62rem;position: relative;}
.input-box input{display: block;height: 1.28rem;width: 100%;border-bottom: 1px solid #D0D0D0;font-size: 0.30rem;padding-left: 1.08rem;}
.input-box input::-webkit-input-placeholder {color: #CCCCCC;}
.name-icon{background: url(../../../static/images/login/name.png) no-repeat;background-size: 100% 100%;width: 0.42rem;height: 0.42rem;display: block;position: absolute;left: 0.87rem;top: 0;bottom: 0;margin: auto;}
.active .name-icon{background: url(../../../static/images/login/name-active.png) no-repeat;background-size: 100% 100%;}
.user-icon{background: url(../../../static/images/login/user.png) no-repeat;background-size: 100% 100%;width: 0.4rem;height: 0.5rem;display: block;position: absolute;left: 0.87rem;top: 0;bottom: 0;margin: auto;}
.active .user-icon{background: url(../../../static/images/login/user-active.png) no-repeat;background-size: 100% 100%;}
.psd-icon{background: url(../../../static/images/login/psd.png) no-repeat;background-size: 100% 100%;width: 0.4rem;height: 0.5rem;display: block;position: absolute;left: 0.87rem;top: 0;bottom: 0;margin: auto;}
.active .psd-icon{background: url(../../../static/images/login/psd-active.png) no-repeat;background-size: 100% 100%;}
.psd2-icon{background: url(../../../static/images/login/psd2.png) no-repeat;background-size: 100% 100%;width: 0.48rem;height: 0.52rem;display: block;position: absolute;left: 0.87rem;top: 0;bottom: 0;margin: auto;}
.active .psd2-icon{background: url(../../../static/images/login/psd2-active.png) no-repeat;background-size: 100% 100%;}
.input-box .yzm{display: block;width: 1.86rem;height: 0.36rem;position: absolute;right: 0.62rem;top: 0;bottom: 0;margin: auto;border-left: 2px solid #F2BA3D;text-align: center;color: #F2BA3D;font-size: 0.25rem;line-height: 0.36rem;}

.submit{display: block;margin: 1rem auto 0.3rem auto;width: 4.85rem;height: 1rem;line-height: 1rem;text-align: center;font-size: 0.28rem;background: #ECB02F;border-radius: 30px;}
.submit a{display: block;width: 100%;height: 100%;color: #fff;}
.login{display: block;margin: 0 auto 0.4rem auto;width: 4.85rem;height: 1rem;line-height: 1rem;text-align: center;font-size: 0.28rem;color: #666666;border-radius: 30px;border: 1px solid #A6A6A6;}
.login a{display: block;width: 100%;height: 100%;}

.fwtk{font-size: 0.26rem;text-align: center;width: 100%;height: 0.32rem;line-height: 0.32rem;}
.fwtk a{color: #F2C251;}
.fwtk .gou{display: inline-block;height: 0.24rem;width: 0.24rem;border-radius: 50%;border: 2px solid #F2BB3E;position: absolute;top: 0;left: 0;bottom: 0;margin: auto;}
.active .gou{background: url(../../../static/images/login/gou-active.png) no-repeat center;background-size: 70% 70%;}
.fwtk-box{width: 3.6rem;margin: 0 auto;position: relative;padding-left: 0.47rem;}
</style>
