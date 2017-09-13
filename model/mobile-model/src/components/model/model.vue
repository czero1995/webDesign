<template>
  <div class="model">
    <!-- <headers :title="msg"></headers> -->
    <footers :title='aActive'></footers>   
  </div>
</template>

<script>
import Headers from './../header.vue';
import Footers from './../footer.vue';
export default {
  name: 'model',
  data () {
    return {
      msg:'模特页',
      aActive:{
        homeActive:false,
        modelActive:true,
        xxActive:false,
        wdActive:false,
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
    $("title").html("模特"); 
  }
}

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
