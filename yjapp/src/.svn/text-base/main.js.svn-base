// Ponyfill
import 'es6-object-assign/auto'
import 'es6-promise/auto'

// Import Vue
import Vue from 'vue'

// Import F7, F7-Vue
import 'framework7'
import Framework7Vue from 'framework7-vue'

// Import F7 iOS Theme Styles
import 'framework7/dist/css/framework7.ios.min.css'
import 'framework7/dist/css/framework7.ios.colors.min.css'
/* OR for Material Theme:
import Framework7Theme from 'framework7/dist/css/framework7.material.min.css'
import Framework7ThemeColors from 'framework7/dist/css/framework7.material.colors.min.css'
*/

// Import App Custom Styles
import './assets/fonts/iconfont.css'
import './assets/styles/modals.less'
import './assets/styles/app.less'

// Import Framework7-Indexed-List-Plugin
// import './assets/libs/f7-indexed-list-plugin/framework7.indexed-list.css'
// import './assets/libs/f7-indexed-list-plugin/framework7.indexed-list.js'

// Import Routes
import Routes from './routes.js'

// Import App Component
import App from './app'

// Import Vuex store
import store from './store'
import { getBranchCompanyList, getMyRaceList, setLang, plusReady } from './store/actions'

// Init network framework
import './network'

// Init Vue Plugin
Vue.use(Framework7Vue)

// Import language file
import VueI18n from 'vue-i18n'
import StoreCache from './utils/storeCache'
import enUS from './lang/en_us'
import zhCN from './lang/zh_cn'
import zhHK from './lang/zh_hk'

////取消浏览器的所有事件，使得active的样式在手机上正常生效
//document.addEventListener('touchstart', function() {
//	return false
//}, true)
//// 禁止选择
//document.oncontextmenu = function() {
//	return false
//}
//// DOMContentLoaded事件处理
//var _domReady = false
//document.addEventListener('DOMContentLoaded', function() {
//	_domReady = true
//	compatibleAdjust()
//}, false)
//// 兼容性样式调整
//var _adjust = false
//
//function compatibleAdjust() {
//	if(_adjust || !window.plus || !_domReady) {
//		return
//	}
//	_adjust = true
//	// iOS平台特效
//	if('iOS' === window.plus.os.name) {
//		document.getElementById('content').className = 'scontent' // 使用div的滚动条
//		if(navigator.userAgent.indexOf('StreamApp') >= 0) { // 在流应用模式下显示返回按钮
//			document.getElementById('back').style.visibility = 'visible'
//		}
//	}
//	// 预创建二级窗口
//	//	preateWebviews();
//	// 关闭启动界面
//	window.plus.navigator.setStatusBarBackground('#59bdf8')
//	setTimeout(function() {
//		window.plus.navigator.closeSplashscreen()
//	}, 200)
//}

// 是否进行网页开发调试
let webDev = false

let langArr = ['zh-CN', 'zh-HK', 'en-US']
console.log(langArr.indexOf('zh-CN'))
let cache = new StoreCache('vuex')
Vue.use(VueI18n)
Vue.locale('en-US', enUS)
Vue.locale('zh-CN', zhCN)
Vue.locale('zh-HK', zhHK)

console.log('langArr', langArr[0])

var currentLang = cache.get('lang') || 'zh-CN'
console.log('currentLang', currentLang)
console.log('indexOf', langArr.indexOf(currentLang))
if(langArr.indexOf(currentLang) === -1) {
	console.log('not support lang')
	Vue.config.lang = langArr[0]
	setLang(store, {
		'lang': langArr[0]
	})
} else {
	console.log('support lang')
	Vue.config.lang = currentLang
	setLang(store, {
		'lang': currentLang
	})
}

document.addEventListener('plusready', doPlusReady, false)

function doPlusReady() {
	console.log('doPlusReady')
	plusReady(store, {
		'isReady': true
	})
	//仅支持竖屏显示
	window.plus.screen.lockOrientation('portrait-primary')
	// 隐藏滚动条
	window.plus.webview.currentWebview().setStyle({
		scrollIndicator: 'none'
	})

	// 开启输出日志
	window.plus.navigator.setLogs(true)

	// Android处理返回键
	//	window.plus.key.addEventListener('backbutton', function() {
	//		('iOS' === window.plus.os.name) ? window.plus.nativeUI.confirm('确认退出？', function(e) {
	//			if(e.index > 0) {
	//				window.plus.runtime.quit()
	//			}
	//		}, '億嘉國際', ['取消', '确定']): (confirm('确认退出？') && window.plus.runtime.quit())
	//	}, false)

	//compatibleAdjust()

	// Init App
	new Vue({
		el: '#app',
		store,
		template: '<app/>',
		// Init Framework7 by passing parameters here
		framework7: {
			root: '#app',
			cache: true,
			cacheDuration: 0,
			animatePages: false,
			swipeBackPage: false,
			routerRemoveWithTimeout: true,
			actionsCloseByOutside: true,
			popupCloseByOutside: true,
			modalTitle: '',
			modalButtonOk: Vue.t('app.modal.button_ok'),
			modalButtonCancel: Vue.t('app.modal.button_cancel'),
			modalPasswordPlaceholder: Vue.t('app.modal.password_placeholder'),
			modalPreloaderTitle: '加载中...',
			swipeout: false,
			swipeoutNoFollow: true,
			swipeoutRemoveWithTimeout: true,
			routes: Routes,
		},
		// Register App Component
		components: {
			app: App
		}
	})
}

// 网页调试，需要初始化app
if(webDev) {
	// Init App
	new Vue({
		el: '#app',
		store,
		template: '<app/>',
		// Init Framework7 by passing parameters here
		framework7: {
			root: '#app',
			cache: true,
			cacheDuration: 0,
			animatePages: false,
			swipeBackPage: false,
			routerRemoveWithTimeout: true,
			actionsCloseByOutside: true,
			popupCloseByOutside: true,
			modalTitle: '',
			modalButtonOk: Vue.t('app.modal.button_ok'),
			modalButtonCancel: Vue.t('app.modal.button_cancel'),
			modalPasswordPlaceholder: Vue.t('app.modal.password_placeholder'),
			modalPreloaderTitle: '加载中...',
			swipeout: false,
			swipeoutNoFollow: true,
			swipeoutRemoveWithTimeout: true,
			routes: Routes,
		},
		// Register App Component
		components: {
			app: App
		}
	})
}

//getLoginUser(store)
//login(store)
//getAgentBasicInfo()
//odno()
//setLang(store, 'zh')
//getBranchCompanyList(store)
//getMyRaceList(store)
//// H5 plus事件处理
//function plusReady(){
//	// 设置系统状态栏背景为红色
//	if(window.plus){
//		plus.navigator.setStatusBarBackground('#FF0000')	
//	}
//}
//if(window.plus){
//	plusReady()
//}else{
//	document.addEventListener('plusready', plusReady, false)
//}

window.addEventListener('resize', function() {
	console.log('resize')
	if(document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') {
		window.setTimeout(function() {
			console.log('scrollIntoViewIfNeeded')
			document.activeElement.scrollIntoViewIfNeeded()
		}, 300)
	}
})