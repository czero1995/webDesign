new Vue({
	el: '#app',
	data: {
		IndexList: [],
		member_id: ''
	},
	mounted: function() { 
		var that = this;
		that.list()
	},
	methods: {
		list: function(event) {
			var that = this;
			axios.get(path+"/villa/getVillaList", {

			}).then(function(result) {
				console.log(JSON.stringify(result))
				that.IndexList = result.data.data.data
			}).catch(function(error) {
				console.log("error", error);
			});
		},
		miaosha: function(villa_id){
			var that = this;
			localStorage.setItem('villa_id', villa_id);
			location.href = 'agreement.html'	
		}
		
	}

})