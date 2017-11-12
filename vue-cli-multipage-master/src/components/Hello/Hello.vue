<template>
  <div class="hello">
    <p>这是vue多页应用的首页{{msg}}</p>
  </div>
</template>

<script>
	
	import 'common/css/swiper.min.css';
	import 'common/js/rem.js';
	import 'common/js/http.js';
	import 'common/js/swiper.min.js';
	import 'common/css/base.css';
export default {
  name: 'hello',
  data () {
    return {
      msg: 'Welcome to Your Vue.js App'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
