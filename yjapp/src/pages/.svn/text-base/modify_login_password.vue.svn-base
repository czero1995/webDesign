<template>
	<div data-page="modify-login-password" class="page modify-login-password-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.modify_login_password')">修改登录密码</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li class="item-content">
						<input v-show="showOldPassword" type="text" class="input-password" :placeholder="$t('app.modify_login_password.input_old_password')" v-model="oldpassword" />
						<input v-show="!showOldPassword" type="password" class="input-password" :placeholder="$t('app.modify_login_password.input_old_password')" v-model="oldpassword" />
						<span @click="onShowOldPassword" v-show="showOldPassword" class="view-password"></span>
						<span @click="onShowOldPassword" v-show="!showOldPassword" class="hide-password"></span>
					</li>
					<li class="item-content clearfloat">
						<input v-show="showNewPassword" type="text" class="input-password" :placeholder="$t('app.modify_login_password.input_new_password')" v-model="newpassword" />
						<input v-show="!showNewPassword" type="password" class="input-password" :placeholder="$t('app.modify_login_password.input_new_password')" v-model="newpassword" />
						<span @click="onShowNewPassword" v-show="showNewPassword" class="view-password"></span>
						<span @click="onShowNewPassword" v-show="!showNewPassword" class="hide-password"></span>
					</li>
				</ul>
			</div>
			<div @click="onModify" class="modify-insure" v-text="$t('app.modify_login_password.submit')">确定</div>
		</div>
	</div>
</template>

<style lang="less">
	.modify-login-password-page {
		.list-block {
			margin: 0;
			>ul {}
		}
		.item-content {
			width: 100%;
			height: 0.88rem;
			padding: 0 0.3rem;
			border-bottom: 1px solid #eee;
			font-family: PingFangSC-Regular;
			position: relative;
			.input-password {
				font-size: 0.26rem;
				color: #B2B2B2;
				letter-spacing: 0.76px;
				line-height: 0.34rem;
			}
			.view-password {
				position: absolute;
				background: url(../../static/icon/login_visible_nor@3x.png);
				width: 0.33rem;
				height: 0.24rem;
				background-size: 100%;
				display: inline-block;
				top: 0;
				bottom: 0;
				right: 0.3rem;
				margin: auto;
			}
			.hide-password {
				position: absolute;
				background: url(../../static/icon/login_Invisible_nor@3x.png) no-repeat;
				width: 0.44rem;
				height: 0.44rem;
				background-size: 100%;
				display: inline-block;
				bottom: 0;
				right: 0.3rem;
				margin: auto;
			}
		}
		.modify-insure {
			background: url(../../static/icon/list_bg_content_sel@3x.png);
			height: 0.98rem;
			width: 100%;
			font-family: PingFangSC-Regular;
			font-size: 0.3rem;
			line-height: 0.98rem;
			color: #FFFFFF;
			text-align: center;
			position: absolute;
			bottom: 0;
			letter-spacing: 0;
		}
	}
</style>
<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				oldpassword: '',
				newpassword: '',
				showOldPassword: false,
				showNewPassword: false
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
						url: '/member/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onShowOldPassword: function() {
				this.showOldPassword = !this.showOldPassword
			},
			onShowNewPassword: function() {
				this.showNewPassword = !this.showNewPassword
			},
			onModify: function() {
				const that = this
				if(that.oldpassword.trim().length === 0 || that.newpassword.trim().length === 0) {
					that.$f7.alert(that.$t('app.modify_login_password.password_required'))
				} else {
					that.$f7.showPreloader(that.$t('app.modify_pay_password.loading'))
					axios.post('Member/Account/ChangePassword', {
						'OldPassword': that.oldpassword,
						'NewPassword': that.newpassword
					}).then(res => {
						that.$f7.hidePreloader()
						console.log('modifyPay res', res)
						if(res.IsSuccess === true) {
							that.$f7.alert(that.$t('app.modify_pay_password.success'))
						} else {
							// 判断token是否已过期
							if(res.ErrorInfos[0].ErrorCode === 33555457) {
								that.$f7.alert('登录状态过期，请重新登录', '', function() {
									that.$f7.mainView.router.load({
										url: '/login/'
									})
								})
							} else {
								that.$f7.alert(res.ErrorInfos[0].Message)
							}
						}
					})
				}
			}
		},
		components: {}
	}
</script>