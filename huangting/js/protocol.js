new Vue({
	el: '#app',
	data: {
		protocolR: false,
		member_id: '',
		villa_id: ''
	},
	mounted: function() { 
		var that = this;
		that.member_id = localStorage.getItem('member_id');
		that.villa_id = localStorage.getItem('villa_id');
		$('.check').click(function () {
		   $('.check').toggleClass('active')
		   if($('.check').hasClass('active')){
		   		$('.btnInsure').addClass('active');
   }
});
	},
	methods: {
		
		miaosha: function(villa_id){
			var that = this;		
			axios.post(path+"/villa/crush", {
				villa_id: that.villa_id,
				member_id: that.member_id
			}).then(function(result) {
				if(result.data.errcode == 200){
					alert('恭喜您,秒杀成功!')
				}else{
					alert('不好意思,秒杀失败!')
				}
					//console.log(result)
				location.href = 'index.html'	
			}).catch(function(error) {
				console.log("error", error);
			});
		}
		
	}

})