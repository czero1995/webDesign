<template>
  <div class="wd">
    <router-view></router-view>
    <footers :title='aActive'></footers>   
  </div>
</template>

<script>
import Headers from './../header.vue';
import Footers from './../footer.vue';
export default {
  name: 'wd',
  data () {
    return {
      msg:'我的',
      aActive:{
        homeActive:false,
        modelActive:false,
        xxActive:false,
        wdActive:true,
      }
    }
  },
  components: {
   Headers,
   Footers
  } ,
  methods: {
   
  },
  mounted:function () {
    
  },
  beforeCreate:function () {
    $("title").html("个人中心"); 
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.wd{height: 100%;width: 100%;}
</style>
