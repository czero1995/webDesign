<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
body,html{height: 100%;width: 100%;}
#app {
  font-family: Helvetica , "Helvetica Neue" , Arial, sans-serif;
  font-size: 0.24rem;
  height: 100%;
  width: 100%;
}
a,button,input{-webkit-tap-highlight-color:rgba(255,0,0,0);}
/*选择身份页model框样式*/
.mint-radio-label{font-size: 0.28rem;}
.mint-radio-core{width: 0.4rem;height: 0.4rem;}
.mint-radio .mint-radio-input:checked + .mint-radio-core{background: url(../static/images/login/gou-active.png) no-repeat center;background-size: 70% 60%;border-color: #F2BB3F;}
.mint-radio-core::after{content: "";height: 0;width: 0;}
.mint-cell:last-child{background: #fff;}
.mint-cell{min-height: 0.96rem;}
</style>
