<template>
	<div data-page="scan-qrcode" class="page scan-qrcode-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span v-text="$t('app.page.qrcode')" class="text-gradient">扫码加入億嘉</span></div>
				<div class="right" style="padding-right: 0.2rem;">
					<a href="javascript:void(0);" class="icon icon-gallary" @click="scanPicture"></a>
				</div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="scan-area" :id="bcid">
				<!--<div class="scan-content scan">
				</div>-->
			</div>
			<div class="scan-tips" v-text="$t('app.qrcode.auto_scan')">对准二维码，即可自动扫描</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				scan_error: 0, // 扫码错误次数，只提示一次
				scan: null
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user_type: state => state.user_type
			}),
			bcid: function() {
				// 返回时间戳作为扫描控件的id
				var timestamp = Date.parse(new Date())
				timestamp = timestamp / 1000
				return 'bcid-' + timestamp
			}
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				console.log('nextTick')
				if(that.plusReady === true) {
					// 首先移除事件
					window.plus.key.removeEventListener('backbutton', function() {
						console.log('removeEventListener')
					}, false)
					// Android处理返回键
					window.plus.key.addEventListener('backbutton', function() {
						that.routeBack()
					}, false)
					// 初始化二维码扫描控件
					that.onInit()
				}
			})
		},
		methods: {
			routeBack: function() {
				var that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					if(that.scan !== null) {
						that.scan.cancel()
						that.scan.close()
					}
					that.$f7.mainView.router.load({
						url: 'home',
						reload: false,
						ignoreCache: true
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onInit: function() {
				const that = this
				that.scan = null
				var filter = [window.plus.barcode.QR]
				var styles = {
					frameColor: '#CDB87B',
					scanbarColor: '#CDB87B'
				}
				// 这里需要制定当前显示页面的区域，否则会显示不正常
				that.scan = new window.plus.barcode.Barcode(that.bcid, filter, styles)
				that.scan.onmarked = that.onMarked
				that.scan.onerror = that.onError
				that.onScan()
			},
			onScan: function() {
				console.log('onScan')
				const that = this
				that.scan.start({
					conserve: false
				})
			},
			onMarked: function(type, result, file) {
				var that = this
				console.log('onMarked type ' + type)
				console.log('onMarked result ' + result)
				switch(type) {
					case window.plus.barcode.QR:
						type = 'QR'
						break
					case 'QR_CODE':
						type = 'QR_CODE'
						break
					case window.plus.barcode.EAN13:
						type = 'EAN13'
						break
					case window.plus.barcode.EAN8:
						type = 'EAN8'
						break
					default:
						type = '其它' + type
						break
				}

				if(type === 'QR' || type === 'QR_CODE') {
					result = result.replace(/\n/g, '')
					if(type === 'QR_CODE') {
						result = result.substring(1, result.length - 1)
						result = result + ''
					}
					console.log('scan result = ' + result)
					console.log('result length = ' + result.length)
					// 判断是否满足会员ID规则
					var reg = new RegExp('^[0-9]*$')
					//if(result.length === 8 && reg.test(result)) {
					if(result.length === 8) {
						console.log('match reg test')
						that.scan.cancel()
						that.scan.close()
						that.$f7.mainView.router.load({
							url: `/select_join/?IntroducerLoginId=${result}`
						})
					} else {
						console.log('no match')
						if(that.scan_error === 0) {
							window.plus.nativeUI.alert(that.$t('app.qrcode.scan_member_qrcode'))
							that.scan_error++
						}
						that.scan.cancel()
						that.scan.start({
							conserve: false
						})
					}
				} else {
					console.log('not qrcode')
					if(that.scan_error === 0) {
						window.plus.nativeUI.alert(that.$t('app.qrcode.scan_member_qrcode'))
						that.scan_error++
					}
					that.scan.cancel()
					that.scan.start({
						conserve: false
					})
				}
				console.log('onMarked:' + result)
				console.log("scaned('" + type + "','" + result + "','" + file + "');")
			},
			onError: function() {
				var that = this
				that.scan.cancel()
				that.scan.start({
					conserve: false
				})
			},
			scanPicture: function() {
				var that = this
				if(that.plusReady === true) {
					that.scan.cancel()
					var filter = [window.plus.barcode.QR]
					window.plus.gallery.pick(function(path) {
						window.plus.barcode.scan(path, that.onMarked, function(error) {
							console.log('error', JSON.stringify(error))
							window.plus.nativeUI.alert(that.$t('app.qrcode.unable_to_identity_image'), function() {
								that.scan.cancel()
								that.scan.start({
									conserve: false
								})
							})
						}, filter)
					}, function(err) {
						console.log('Failed: ' + JSON.stringify(err.message))
						//window.plus.nativeUI.alert('读取图片出错：' + err.message)
						window.plus.nativeUI.alert(that.$t('app.qrcode.cancel_pick_image'), function() {
							that.scan.cancel()
							that.scan.start({
								conserve: false
							})
						})
					})
				} else {
					console.log('plusReady', that.plusReady)
				}
			}
		},
		components: {}
	}
</script>

<style lang="less">
	.scan-qrcode-page {
		/*.navbar-inner {
			background-color: #D2D2D6;
			border: none;
			&:after {
				background-color: #D2D2D6;
				border: none;
			}
		}*/
		.page-content {
			/*background-color: #D2D2D6;*/
			background-color: #000;
			opacity: 0.5;
			.scan-area {
				width: 5rem;
				height: 5rem;
				/*background-image: url('../../static/icon/sao_ma.png');*/
				background-repeat: no-repeat;
				background-size: 5rem 5rem;
				background-position: center;
				margin: 0 auto;
				margin-top: 2.77rem;
				opacity: 1;
				.scan-content {
					margin: 0 auto;
					background-color: #bdbdbd;
					width: 4.5rem;
					height: 4.5rem;
					margin-top: 0.25rem;
					margin-left: 0.25rem;
					position: absolute;
					opacity: 0.6;
				}
			}
			.scan-tips {
				width: 100%;
				text-align: center;
				margin-top: 0.61rem;
				color: #fff;
				font-size: 0.3rem;
			}
		}
	}
</style>