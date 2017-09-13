<template>
  <div class="message">
    <!-- <headers :title="msg"></headers> -->
    <footers :title='aActive'></footers>   
  </div>
</template>

<script>
import Headers from './../header.vue';
import Footers from './../footer.vue';
export default {
  name: 'message',
  data () {
    return {
      msg:'信息中心',
      aActive:{
        homeActive:false,
        modelActive:false,
        xxActive:true,
        wdActive:false,
        xx:true
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
    $("title").html("信息中心"); 
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
