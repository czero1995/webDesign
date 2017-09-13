<template>
  <div class="footer">  
      <router-link :class="{ active: aActive.homeActive}" to='/index'>
          <i class="home"></i>
          <p>首页</p>
      </router-link>
       <router-link :class="{ active: aActive.modelActive }" to='/model'>
        <i class="model"></i>
          <p>模特</p>
      </router-link>
       <router-link :class="" to='/index'>
          <span class="send"></span>
      </router-link>
       <router-link :class="{ active: aActive.xxActive }" to='/message'>
          <i class="xx"><span class="badge" v-if='xx'>{{xxNum}}</span></i>
          <p>消息</p>
      </router-link>
      <router-link :class="{ active: aActive.wdActive }" to='/wd'>
          <i class="wd"></i>
          <p>我的</p>
      </router-link>
  </div>
</template>

<script>
export default {
  data () {
    return {
      aActive:{},
      xxNum:"14",
      xx:true
    }
  },
  components: {
   
  } ,
  methods: {
    
  },
  props: ['title'],
  mounted:function(){
    this.aActive = this.title;
    if (this.aActive.xx) {
      this.xx = false;
    } else {
      this.xx = true;
    }
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.footer {position: fixed;bottom: 0;width: 100%;height: 1rem;display: flex;z-index: 99;background: url(../../static/images/index/footer-bg.png) no-repeat;background-size: 100% 100%;}
.footer a{display: block;height: 100%;flex: 1;text-align: center;color: #999;line-height: 0.97rem;padding-top: 0.1rem;position: relative;}
.footer a p{font-size: 0.2rem;line-height: 0.2rem;padding-top: 0.02rem;}
.footer a i{display: block;width: 0.56rem;height: 0.56rem;margin: 0 auto;}
.footer a .home{background: url(../../static/images/index/home.png) no-repeat;background-size: 100% 100%;}
.footer a .model{background: url(../../static/images/index/model.png) no-repeat;background-size: 100% 100%;}
.footer a .xx{background: url(../../static/images/index/xx.png) no-repeat;background-size: 100% 100%;position: relative;}
.footer a .xx .badge{display: block;min-width: 0.3rem;height: 0.3rem;position: absolute;top: -0.05rem;right: -0.1rem;font-size: 0.16rem;text-align: center;line-height: 0.3rem;border-radius: 50%;color: #fff;background: red;}
.footer a .wd{background: url(../../static/images/index/wd.png) no-repeat;background-size: 100% 100%;}
.footer a .send{display: block;width: 1.22rem;height: 1.22rem;background: url(../../static/images/index/send.png) no-repeat;background-size: 100% 100%;position: absolute;top: -0.4rem;left: 0;right: 0;margin: auto;}
.footer .active{color: #F3B632;}
.footer .active .home{background: url(../../static/images/index/home-active.png) no-repeat;background-size: 100% 100%;}
.footer .active .model{background: url(../../static/images/index/model-active.png) no-repeat;background-size: 100% 100%;}
.footer .active .xx{background: url(../../static/images/index/xx-active.png) no-repeat;background-size: 100% 100%;}
.footer .active .wd{background: url(../../static/images/index/wd-active.png) no-repeat;background-size: 100% 100%;}
</style>
