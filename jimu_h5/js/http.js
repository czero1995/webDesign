var paths = {
	'dev': 'http://api.jimuapi.com/wx/',
	'dt': 'http://wechat.fullstack.cn/',
	'product': 'http://api.szyunzhili.com/wx/'

}

path = paths.dev;
var code;
var openid;
var userinfo;
is_weixn();

/*是否在微信浏览器打开*/
function is_weixn() {
	var ua = navigator.userAgent.toLowerCase();
	if(ua.match(/MicroMessenger/i) == "micromessenger") {
		if(!sessionStorage.url) {
			getAuth();
			
			sessionStorage.url = Number(sessionStorage.url) + 1;
		}
		if(sessionStorage.url && !sessionStorage.info){
			getUrlParam('code');
			getOpenId();
			setTimeout(function(){
					getInfo();
			
					sessionStorage.info = Number(sessionStorage.info) + 1;
			},1000)
		
		}
		
		document.getElementById('topBar').style.display="none";
	} else {
	return false;
}
}

/*获取授权*/
function getAuth() {
	var test = encodeURI(window.location.href);
	var openurls;
	axios.get(path + 'auth/getRedirectUrl?redirect=' + test, {}).then(function(res) {
			console.log('test', test)
			if(res.data.errcode == 200) {
				location.href = res.data.data.url;
			}

		})
		.catch(function(error) {
			console.log(error);
		});
}

/*获取地址传值*/
function getUrlParam(name) {
	const that = this;
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	var r = window.location.search.substr(1).match(reg);
	if(r != null) {
		code = r[2];
		return(r[2]);
	}
}

/*获取openid*/
function getOpenId() {
	
	axios.get(path + 'auth/getOpenid?code=' + code, {
		
	}).then(function(res) {
			openid = res.data.data.openid;
			sessionStorage.openid = openid;
			console.log('openid', res);

		})
		.catch(function(error) {
			console.log(error);
		});
}

/*获取会员信息*/
function getInfo() {
	axios.get(path + 'member/getMemberByOpenid?openid=' + sessionStorage.openid, {
		
	}).then(function(res) {
			if(res.data.data.info == 0) {
				sessionStorage.member = 0;
				userinfo=0;
			}else{
				console.log('getinfo',res);
			}
			console.log('info', res.data.data.info);

		})
		.catch(function(error) {
			console.log(error);
		});
}