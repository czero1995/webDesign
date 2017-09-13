<template>
    <div class="header">
    {{title}}
    </div>
</template>

<script>
export default {
  data () {
    return {
      
    }
  },
  methods: {
    aaa: function () {
      $('.header').toggleClass('active')
    }
  },
  props: {
    title: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.header{height: 0.85rem;width: 100%;background: #252525;position: fixed;top: 0;text-align: center;line-height: 0.85rem;color: #fff;font-size: 0.35rem;z-index: 99;}
.active{background: red;}
</style>
