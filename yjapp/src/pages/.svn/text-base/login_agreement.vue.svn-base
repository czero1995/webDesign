<template>
	<div data-page="login-agreement" class="page login-agreement-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="center"><span class="text-gradient" v-text="$t('app.page.login_agreement')">登录协议</span></div>
				<div @click="onLogout" class='right' style='margin-right: 10px;'>
					<a href='javascript:void(0);' class='text-gradient' style='font-size: 0.26rem;' v-text="$t('app.login_agreement.logout')">退出</a>
				</div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<div class="agrTitle" v-text="$t('app.login_agreement.agreement')">億嘉國際协议</div>
				<div class="agrContent" v-if="agreementInfo !== null" v-html="agreementInfo"></div>
			</div>
		</div>
		<div class="toolbar agree-toolbar">
			<div class="toolbar-inner">
				<div class="agr-insure">
					<img @click="onAgreement" v-show="!agreement" src="../../static/icon/list_Unselected_nor@3x.png" class="insure-img" />
					<img @click="onAgreement" v-show="agreement" src="../../static/icon/list_selected_sel@3x.png" class="insure-img" />
					<span @click="onAgreement" class="insure-text" v-text="$t('app.login_agreement.agree')">同意协议</span>
				</div>
			</div>
		</div>
		<div class="toolbar">
			<div class="toolbar-inner login_agreement-footer" v-bind:class="{ active : agreement }" @click="onNext">
				<span v-text="$t('app.login_agreement.next')">下一步</span>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.login-agreement-page {
		.page-content {
			background-color: #fff;
			padding-bottom: 44px;
		}
		.agree-toolbar {
			bottom: 64px;
			background: transparent;
			&:before {
				background: transparent;
			}
		}
		.list-block {
			margin: 0;
			width: 100%;
			height: 100%;
			.agrTitle {
				text-align: center;
				padding: 0.82rem 0;
				font-family: PingFangSC-Medium;
				font-size: 0.34rem;
				color: #CBB06D;
				letter-spacing: 1px;
			}
			.agrContent {
				padding: 0 0.44rem;
				line-height: 0.6rem;
				overflow: auto;
				font-size: 0.26rem;
				text-indent: 0.40rem;
				height: 7.36rem;
			}
		}
		.agr-insure {
			text-align: center;
			width: 100%;
			.insure-img {
				display: inline-block;
				width: 0.34rem;
				height: 0.34rem;
				vertical-align: middle;
				margin-right: 0.1rem;
			}
			.insure-text {
				display: inline-block;
				font-family: PingFangSC-Medium;
				font-size: 0.28rem;
				color: #CBB06D;
				letter-spacing: 0.82px;
			}
		}
		.login_agreement-footer {
			font-size: 0.3rem;
			background: #B4B4B4;
			color: #FFFFFF;
			text-align: center;
			display: block;
			height: 44px;
			span {
				display: block;
				height: 44px;
				line-height: 44px;
			}
			&.active {
				background-image: url(../../static/icon/tab_bg_content_nor@3x.png);
			}
		}
	}
	
	.clearfloat::after {
		display: block;
		content: '';
		height: 0;
		width: 0;
		clear: both;
	}
</style>
<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				agreement: false,
				agreementInfo: null, // 登录协议
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				isSetDetail: state => state.isSetDetail,
				confirmAgreement: state => state.confirmAgreement
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
					window.plus.key.addEventListener('backbutton', function() {
						that.routeBack()
					}, false)
				}
				that.onLoadAgreement()
			})
		},
		methods: {
			routeBack: function() {
				const that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					that.$f7.confirm(that.$t('app.modal.sure_exit'), function() {
						window.plus.runtime.quit()
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onAgreement() {
				this.agreement = !this.agreement
			},
			onLoadAgreement: function() {
				console.log('onLoadAgreement')
				const that = this
				that.$f7.showPreloader(that.$t('app.login_agreement.loading_agreement'))
				axios.get('Member/Member/GetSignUpAgreement', {
					params: {
						branchCompanyId: that.user.BranchCompanyId
					}
				}).then(res => {
					console.log('getRegisterCountry', res.Data)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.agreementInfo = res.Data
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onLogout: function() {
				console.log('onLogout')
				const that = this
				that.$f7.confirm(that.$t('app.login_agreement.sure_logout'), '', function() {
					that.$store.dispatch('logout')
					that.$f7.mainView.router.load({
						url: '/home/'
					})
				})
			},
			onNext: function() {
				console.log('下一步')
				const that = this
				if(that.agreement) {
					console.log('同意协议')
					that.$f7.showPreloader(that.$t('app.login_agreement.loading'))
					axios.post('Member/Member/ConfirmAgreement').then(res => {
						console.log('loginArgee', res)
						if(res.IsSuccess === true) {
							that.$f7.hidePreloader()
							that.$store.dispatch('setConfirmAgreement', {
								confirmAgreement: true
							}).then(() => {
								that.$f7.mainView.router.load({
									url: '/login_fill_info/'
								})
							})
						} else {
							that.$f7.alert(res.ErrorInfos[0].Message)
						}
					})
				}
			}
		},
		components: {}
	}
</script>