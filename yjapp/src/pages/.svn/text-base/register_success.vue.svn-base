<template>
	<div data-page="register-success" class="page register-success-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<!--<div class="left">
					<a href="/" class="back icon icon-back"></a>
				</div>-->
				<div class="center"><span class="text-gradient" v-text="$t('app.page.register_success')">注册成功</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="register-t">
				<img src="../../static/icon/pop_msg_success_nor@3x.png" class="register-state" />
				<div class="register-title" v-if="userType === '1'" v-text="$t('app.register_success.save_screenshot_member')">请把新加入会员信息保存或截图</div>
				<div class="register-title" v-if="userType === '3'" v-text="$t('app.register_success.save_screenshot_consumer')">请把新加入消费者信息保存或截图</div>
			</div>
			<div class="register-c">
				<div class="info-box ">
					<div class="info-l" v-if="userType === '1'" v-text="$t('app.register_success.new_member_id')">新注册会员编号</div>
					<div class="info-l" v-if="userType === '3'" v-text="$t('app.register_success.new_consumer_id')">新注册消费者编号</div>
					<div class="info-r text-gradient">{{loginId}}</div>
				</div>
				<div class="info-box " v-if="userType === '1'">
					<div class="info-l" v-text="$t('app.register_success.default_login_password')">系统初始密码</div>
					<div class="info-r text-gradient">{{defaultPassword}}</div>
				</div>
				<div class="info-box ">
					<div class="info-l" v-text="$t('app.register_success.telephone')">联系号码</div>
					<div class="info-r text-gradient">{{telephone}}</div>
				</div>
			</div>
			<div @click="onLogin" class="register-d active" v-text="$t('app.register_success.login')">
				登录
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.register-success-page {
		width: 100%;
		.register-t {
			margin: 0 auto;
			width: 100%;
			.register-state {
				width: 1.3rem;
				height: 1.3rem;
				margin: 0 auto;
				display: block;
				margin-top: 1rem;
				margin-bottom: 0.26rem;
			}
			.register-title {
				font-family: PingFangSC-Medium;
				font-size: 0.26rem;
				color: #696969;
				letter-spacing: 0.76px;
				line-height: 0.34rem;
				text-align: center;
			}
		}
		.register-c {
			margin-top: 0.73rem;
			background: #FFFFFF;
			.info-box {
				width: 100%;
				height: 0.98rem;
				border-bottom: 1px solid #eee;
				.info-l {
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #595959;
					letter-spacing: 0.76px;
					padding: 0 0.3rem;
					line-height: 0.98rem;
					display: inline-block;
				}
				.info-r {
					float: right;
					font-size: 0.26rem;
					letter-spacing: 0.76px;
					line-height: 0.98rem;
					margin-right: 0.5rem;
				}
			}
		}
		.register-d {
			position: absolute;
			bottom: 0;
			width: 100%;
			height: 0.98rem;
			background: #B4B4B4;
			font-family: PingFangSC-Regular;
			font-size: 0.3rem;
			color: #FFFFFF;
			letter-spacing: 0;
			text-align: center;
			line-height: 0.88rem;
		}
		.active.register-d {
			background: url(../../static/icon/list_bg_content_sel@3x.png);
		}
	}
</style>
<script>
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				userType: '',
				loginId: '',
				telephone: '',
				defaultPassword: ''
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady
			})
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				if(that.plusReady) {
					// 首先移除事件
					window.plus.key.removeEventListener('backbutton', function() {
						console.log('removeEventListener')
					}, false)
					// Android处理返回键
					window.plus.key.addEventListener('backbutton', function() {
						that.routeBack()
					}, false)
				}
				let query = that.$route.query
				console.log('register success query', query)
				that.userType = query.userType
				that.loginId = query.loginId
				that.telephone = query.telephone
				that.defaultPassword = query.defaultPassword
			})
		},
		methods: {
			routeBack: function() {
				const that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					that.$f7.mainView.router.load({
						url: '/home/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onLogin() {
				this.$f7.mainView.router.load({
					url: '/login/'
				})
			}
		},
		components: {}
	}
</script>