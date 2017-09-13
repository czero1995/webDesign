<template>
  <div class="login">
    <div class="header"><img src="../../../static/images/login/login-bg.png" alt=""></div>
    <p class="title">请登录</p>
    <div class="input-box active">
      <i class="user-icon"></i><input class="user" type="text" placeholder='请输入手机号'>
    </div>
    <div class="input-box">
      <i class="psd-icon"></i><input class="user" type="text" placeholder='请输入密码'>
    </div>
    <router-link class="submit" to='/index'>立即登录</router-link>
    <router-link class="signin" to='/signin'>我要注册</router-link>
    <span class="wjmm"><i class="wh-icon"></i>忘记密码</span>
  </div>
</template>

<script>

export default {
  name: 'login',
  data () {
    return {
      msg:''
    }
  },
  components: {
   
  } ,
  methods: {
   
  },
  mounted:function () {
    $("title").html("登录"); 
    $('body').on('click','.input-box',function () {
      $('.input-box').removeClass('active');
      $(this).addClass('active');
    });
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.login{padding-bottom: 1rem;width: 100%;height: calc(100% - 1rem);overflow: hidden;overflow-y: auto;-webkit-overlow-scrollind:touch;}
.header{width: 100%;height: 3.3rem;}
.header img{display: block;width: 100%;height: 100%;}

.title{font-size: 0.42rem;color: #F2BB3E;text-align: center;margin-bottom: 0.65rem;}

.input-box{padding: 0 0.62rem;position: relative;}
.input-box input{display: block;height: 1.28rem;width: 100%;border-bottom: 1px solid #D0D0D0;font-size: 0.30rem;padding-left: 1.08rem;}
.input-box input::-webkit-input-placeholder {color: #CCCCCC;}
.user-icon{background: url(../../../static/images/login/user.png) no-repeat;background-size: 100% 100%;width: 0.4rem;height: 0.5rem;display: block;position: absolute;left: 0.87rem;top: 0;bottom: 0;margin: auto;}
.active .user-icon{background: url(../../../static/images/login/user-active.png) no-repeat;background-size: 100% 100%;}
.psd-icon{background: url(../../../static/images/login/psd.png) no-repeat;background-size: 100% 100%;width: 0.4rem;height: 0.5rem;display: block;position: absolute;left: 0.87rem;top: 0;bottom: 0;margin: auto;}
.active .psd-icon{background: url(../../../static/images/login/psd-active.png) no-repeat;background-size: 100% 100%;}

.submit{display: block;margin: 1rem auto 0.3rem auto;width: 4.85rem;height: 1rem;line-height: 1rem;text-align: center;font-size: 0.28rem;color: #fff;background: #ECB02F;border-radius: 30px;}
.signin{display: block;margin: 0 auto 0.4rem auto;width: 4.85rem;height: 1rem;line-height: 1rem;text-align: center;font-size: 0.28rem;color: #666666;border-radius: 30px;border: 1px solid #A6A6A6;}

.wjmm{display: block;width: 1rem;padding-left: 0.35rem;text-align: center;color: #F2BD46;height: 0.28rem;line-height: 0.28rem;position: relative;margin: 0 auto;}
.wjmm .wh-icon{display: block;height: 0.28rem;width: 0.28rem;line-height: 0.28rem;background: url(../../../static/images/login/wenhao-icon.png) no-repeat;background-size: 100% 100%;position: absolute;top: 0;left: 0.05rem;bottom: 0;margin: auto;}
</style>
