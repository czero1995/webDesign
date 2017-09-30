new Vue({
	el: '#app',
	data: {
		mobile: '',
		passwd:'',
		phoneReg: /^13[0-9]{9}$|14[0-9]{9}|15[0-9]{9}$|18[0-9]{9}$|17[0-9]{9}$/,	
	},
	mounted: function() { 
		var that = this;
	},
	methods: {
		login: function(event) {
			var that = this;
			axios.post(path+"/member/login", {
				mobile: that.mobile,
				password: that.passwd
			}).then(function(result) {
				console.log(JSON.stringify(result))
				that.IndexList = result.data.data.data
				localStorage.setItem('member_id', result.data.data.id);
				location.href = 'index.html'	
			}).catch(function(error) {
				console.log("error", error);
			});
		},

		
	}

})