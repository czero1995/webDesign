<template>
	<div data-page="login" class="page login-page">
		<div class="page-content">
			<img src="../../static/icon/login_logo_nor@3x.png" alt="" />
			<div class="login-form clearfloat">
				<div class="login-box">
					<input type="number" pattern="\d{8}" class="login-input login-name" :placeholder="$t('app.login.account')" v-model="loginaccount" />
					<img v-show="login_error" @click="onClearAccount" class="login-error" src="../../static/icon/login_error_nor@3x.png" />
				</div>
				<div class="login-hr"></div>
				<div class="login-box">
					<input v-show="seen" type="text" v-model="loginpassword" class="login-input login-password" :placeholder="$t('app.login.password')" />
					<input v-show="!seen" type="password" v-model="loginpassword" class="login-input login-password" :placeholder="$t('app.login.password')" />
					<img v-show="login_error" @click="onClearPassword" class="login-error " src="../../static/icon/login_error_nor@3x.png" />
				</div>
				<div class="login-hr"></div>
				<img v-show="!login_error" :src="seen ? unseenImg : seenImg" @click="viewPassword" class="viewPassword" />
				<p @click="onRetrievePassword" class="back-password text-gradient" v-text="$t('app.login.retrieve_password')">找回登录密码</p>
			</div>
			<div class="login-btn" @click="onLogin">
				<p class="login-btn-text" v-text="$t('app.login.login_btn')">登录</p>
			</div>
			<div @click="onRegister" class="join-customer text-gradient" v-text="$t('app.login.join_consumer')">
				加入消费者
			</div>
			<div @click="routeBack" class="go-home text-gradient" v-text="$t('app.login.back_to_home')">
				去首页
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.login-page {
		.page-content {
			height: 100%;
			width: 100%;
			background: url(../../static/icon/login_img_background@3x.jpg) no-repeat;
			background-size: 100%;
			>img {
				width: 4.59rem;
				height: 3.24rem;
				margin: 0 auto;
				display: block;
				padding-top: 1.28rem;
			}
			.login-form {
				padding-top: 0.8rem;
				margin: 0 1rem;
				position: relative;
				.login-box {
					position: relative;
				}
				input {
					color: #fff;
				}
				.login-input {
					padding-left: 0.2rem;
					border: none;
					width: 100%;
					margin: 0 auto;
					display: block;
					background: transparent;
					padding-bottom: 0.23rem;
					font-size: 0.28rem;
				}
				.login-password {
					margin-top: 0.35rem;
				}
				.login-hr {
					background: url(../../static/icon/list_bg_content_sel@3x.png);
					width: 100%;
					height: 1px;
				}
				.login-error {
					position: absolute;
					right: 0.1rem;
					top: 0;
					bottom: 0;
					margin: auto;
					width: 0.27rem;
					height: 0.27rem;
				}
				.viewPassword {
					position: absolute;
					display: inline-block;
					width: 0.41rem;
					height: 0.24rem;
					right: 0;
					bottom: 1.2rem;
					background-size: 100%;
				}
				.back-password {
					color: #ffffff;
					font-size: 0.28rem;
					float: right;
				}
			}
			.login-btn {
				margin: 0 auto;
				background: url(../../static/icon/login_btn_nor@3x.png) no-repeat;
				background-size: 100%;
				height: 0.88rem;
				width: 5.5rem;
				margin-top: 1.15rem;
				.login-btn-text {
					color: #ffffff;
					font-size: 0.3rem;
					line-height: 0.88rem;
					text-align: center;
				}
			}
			.join-customer {
				width: 100%;
				position: relative;
				text-align: center;
				margin-top: 0.5rem;
			}
			.go-home {
				width: 100%;
				position: relative;
				text-align: center;
				margin-top: 0.5rem;
				margin-bottom: 0.5rem;
			}
		}
	}
	
	.clearfloat::after {
		display: block;
		content: '';
		height: 0;
		width: 0;
		clear: both
	}
</style>
<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				loginaccount: '',
				loginpassword: '',
				login_error: false,
				seen: false,
				seenImg: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACkAAAAMCAYAAAD/AZRzAAAAAXNSR0IArs4c6QAAA0lJREFUOBHFlGtIVFEQx2fuXTddqy9lZBFJWaBBfQzE1IXIlKCg2tLWR6VGjy+ZX/oQLIQS9UEoLUVry0fp9oCKakt0A+0FVhBJEJWgYRhRZpK67p1pzvXREttCZDSw98ydc85/fmfO3EUIskeXCzMMgkIEGGEdSpO31HQFTU+r234hd7mfuFwDfYd95/mBcOLCA9Dtc0X2feyrZOZd6l1GYIAAIBanbK85pWLTaW31zlUUAC8xzUfAHsl4DCP52trsS/2h8piQD5oLG4h4h4kmdKCialSG0DBHn7F3heP00Hjg756t7pytBFzLRLPNYkhBlClfnt3E0KsBfJUDkCT/BBpUYHtTQa4AXfi5cHKDikz6+EbX2bkmy/1kPPrnz9bG7MU0imVSiAxEPEAGpQlWChMvAybNRBRQZOiTQzwUJo8WF3sjM/PUKLY3FxySwr2Kts58ODyGo7rFb/OPjCQR8145XYZgyikBNFQDXwXGk6lOd4ckUrphjT0evW3oZqoBlCs5thFRpGj4UYP49F1NvWpzZ3VRxGfLYEyAdA2iYDDT2Tj4q6i62N+a72L+JiSslMovEPGpdeL1yMYOCT1FjfqZ8Qsx2pApRmoRI1c1TwNMkHG1rIlmltqoI05KED+eFTFzXfLuc9+mRMM4YSFFGO835D8T8QTpzbcCm2g2rEqoRCeyjudWEOJNgJi+vAjfB9Zxs8a02DCoVEJLzDnk90xYvGHflcth+Myp30J2dhZFfHvlPyof1FILWMpS884+99Xl7TcMo0Ku+oU6gDRQvMxHKSW5/IC0iEU8QiS3tP1cWbNRyD9GLk9caLe7Aswu7c6Zl+kG83pEWCmVjpOefCMQTVardnv9nmsfQgGLaGjzv4u2pDmrDwf3nlRiDSP22GxWe5Lj7OeW8zkHAYwTEVaMszsb33trs64DG8npBc0Fqh+9A1dcAl7y/fXL45KlGNElXyzcmfiFThwiKl97aEtylA8HA7a4c7Pl7uZZNUhTgOYug4bY4CYFqN41HUvkL2RM+ehwGBlFniM2tCySar+7VbFlY5dnq1XN/RPz+VwWnzs/7ldxb03WIW+9MzY4fqvKkXWvKntZcOy/+nfrcqJDAUx3xX4ArzWt3t82dbwAAAAASUVORK5CYII=',
				unseenImg: 'data:image/png;base64,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'
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user_type: state => state.user_type,
				user: state => state.user,
				isSetDetail: state => state.isSetDetail,
				confirmAgreement: state => state.confirmAgreement,
				branch_company_list: state => state.branch_company_list
			})
		},
		watch: {},
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
				that.loginaccount = ''
				that.loginpassword = ''
				that.login_error = false
				that.seen = false
				// 隐藏标题栏
				that.$f7.mainView.hideNavbar()
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
			onClearAccount: function() {
				this.loginaccount = ''
			},
			onClearPassword: function() {
				this.loginpassword = ''
			},
			onLogin: function() {
				const that = this
				that.login_error = false
				console.log('onLogin')
				if(that.loginaccount.trim().length === 0 || that.loginpassword.trim().length === 0) {
					that.$f7.alert(that.$t('app.login.require_account_password'))
					that.login_error = true
				} else {
					that.$f7.showPreloader(that.$t('app.login.logining'))
					axios.post('Member/Account/Login', {
						'LoginId': that.loginaccount,
						'Password': that.loginpassword,
						'RememberMe': true
					}).then(res => {
						that.$f7.hidePreloader()
						console.log('login res', res)
						if(res.IsSuccess === true) {
							that.$store.dispatch('login', {
								data: res.Data
							})
							// 登录成功，获取用户基本信息
							axios.get('Member/Member/GetCurrentAgentForSetDetail').then(res => {
								console.log('getAgentBasicInfo', res)
								if(res.IsSuccess === true) {
									that.$store.dispatch('setAgentBasicInfo', {
										user: res.Data
									}).then(() => {
										// 获取国家窗口信息
										axios.get('Member/Common/GetBranchCompanyList').then(res => {
											if(res.IsSuccess === true) {
												that.$f7.hidePreloader()
												that.$store.dispatch('setBranchCompanyList', {
													branchCompanyList: res.Data
												}).then(() => {
													// 登录成功之后，根据用户设置当前的国家窗口信息
													that.branch_company_list.forEach(function(branch) {
														if(that.user.BranchCompanyId === parseInt(branch.Value)) {
															that.$store.dispatch('setBranchCompany', {
																id: parseInt(branch.Value),
																name: branch.Text
															})
														}
													})
												})
											} else {
												that.$f7.hidePreloader()
												that.$f7.alert(res.ErrorInfos[0].Message)
											}
										})

										// 登录成功，跳转到对应的页面
										if(that.user_type === 1) {
											// 获取会员二维码
											that.$store.dispatch('getMyQRCode')
											if(that.confirmAgreement === false) {
												that.$f7.mainView.router.load({
													url: '/login_agreement/'
												})
											} else if(that.isSetDetail === false) {
												that.$f7.mainView.router.load({
													url: '/login_fill_info/'
												})
											} else {
												that.$f7.mainView.router.load({
													url: '/home/'
												})
											}
										} else if(that.user_type === 3) {
											that.$f7.mainView.router.load({
												url: '/home/'
											})
										}
									})
								} else {
									that.$store.dispatch('logout').then(() => {
										that.$f7.alert(res.ErrorInfos[0].Message)
									})
								}
							})
						} else {
							that.$store.dispatch('logout').then(() => {
								that.$f7.alert(res.ErrorInfos[0].Message)
							})
						}
					})
				}
			},
			onRetrievePassword() {
				this.$f7.mainView.router.load({
					url: '/retrieve_password/'
				})
			},
			onRegister() {
				var type = 3
				var IntroducerLoginId = ''
				this.$f7.mainView.router.load({
					url: `/register/?fromType=self&userType=${type}&IntroducerLoginId=${IntroducerLoginId}`
				})
			},
			viewPassword() {
				const that = this
				that.seen = !that.seen
			}
		},
		components: {

		}
	}
</script>