<template>
	<f7-page name="member" class="member-page">
		<f7-navbar theme="white">
			<f7-nav-center sliding><span class="icon icon-logo"></span></f7-nav-center>
		</f7-navbar>
		<div class="list-block">
			<div v-show="user_type === 1" class="member-top">
				<img v-bind:src="qrcode" alt="" />
			</div>
			<div class="member-category" v-show="user_type === 1">
				<div class="member-category-box">
					<div class="category-item">
						<a href="/profile">
							<img src="../../static/icon/porfile_ic_data_nor@3x.png" class="category-icon" />
							<p class="category-title" v-text="$t('app.member.profile')">个人资料</p>
						</a>
					</div>
					<div class="category-item">
						<a href="/address?fromType=member">
							<img src="../../static/icon/porfile_ic_address_nor@3x.png" class="category-icon" />
							<p class="category-title" v-text="$t('app.member.address')">地址</p>
						</a>
					</div>
					<div class="category-item">
						<a href="/bonus?fromType=member">
							<img src="../../static/icon/porfile_ic_bonus_nor@3x.png" class="category-icon" />
							<p class="category-title" v-text="$t('app.member.bonus')">奖金</p>
						</a>
					</div>
					<div class="category-item">
						<a href="/score?fromType=member">
							<img src="../../static/icon/porfile_ic_integral_nor@3x.png" class="category-icon" />
							<p class="category-title" v-text="$t('app.member.score')">积分</p>
						</a>
					</div>
				</div>
			</div>
			<ul>
				<li v-show="user_type === 3">
					<a href="/profile" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.profile')">个人资料</div>
						</div>
					</a>
				</li>
				<li v-show="user_type === 1">
					<a href="/modify_pay_password" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.modify_payment_password')">修改电子钱包支付密码</div>
						</div>
					</a>
				</li>
				<li>
					<a href="/modify_login_password" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.modify_login_password')">修改登录密码</div>
						</div>
					</a>
				</li>
				<li v-show="user_type === 3">
					<a href="/address?fromType=member" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.address')">收货地址</div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.update')">版本更新</div>
							<div class="item-after" v-text="$t('app.member.update_tips')">已更新到最新版本</div>
						</div>
					</a>
				</li>
				<li>
					<a href="javascript:void(0);" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.current_version')">当前版本</div>
							<div class="item-after" v-text="version">1.0.0</div>
						</div>
					</a>
				</li>
				<li>
					<a @click="onLogout" href="javascript:void(0);" class="item-link item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.member.logout')">退出登录</div>
						</div>
					</a>
				</li>
			</ul>
		</div>
		<f7-toolbar tabbar>
			<f7-link icon="icon icon-tab-home" href="/home/"></f7-link>
			<f7-link icon="icon icon-tab-order" href="/order/"></f7-link>
			<f7-link icon="icon icon-tab-cart" href="/cart/"></f7-link>
			<f7-link icon="icon icon-tab-member" href="#" active></f7-link>
		</f7-toolbar>
	</f7-page>
</template>

<style lang="less">
	.member-page {
		.page-content {
			padding-bottom: 44px;
			.list-block {
				margin: 0;
				.member-top {
					background: url(../../static/img/Group@3x.png);
					background-size: 100%;
					height: 6.16rem;
					width: 100%;
					text-align: center;
					img {
						widows: 3rem;
						height: 3rem;
						margin-top: 0.85rem;
						border-radius: 6px;
					}
				}
				.member-category {
					background: #FFFFFF;
					margin-bottom: 0.2rem;
					height: 2.35rem;
					width: 100%;
					.member-category-box {
						width: 100%;
						padding-top: 0.47rem;
						padding-bottom: 0.54rem;
						text-align: center;
						margin: 0 auto;
						.category-item {
							width: 20%;
							display: inline-block;
							.category-icon {
								width: 0.8rem;
								height: 0.8rem;
							}
							.category-title {
								font-family: PingFangSC-Light;
								font-size: 0.24rem;
								color: #7A7A7A;
								letter-spacing: 0.71px;
								line-height: 0.34rem;
								margin: 0;
								text-align: center;
							}
						}
					}
				}
				.item-content {
					padding-left: 0;
					.item-title {
						padding-left: 0.3rem;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #5A5A5A;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
					.item-after {
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #5A5A5A;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
				}
			}
		}
	}
</style>

<script>
	import { mapState } from 'vuex'
	export default {
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				user_type: state => state.user_type,
				qrcode: state => state.qrcode,
				version: state => state.version
			}),
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
			})
		},
		methods: {
			routeBack: function() {
				const that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					('iOS' === window.plus.os.name) ? window.plus.nativeUI.confirm(that.$t('app.modal.sure_exit'), function(e) {
						if(e.index > 0) {
							window.plus.runtime.quit()
						}
					}, that.$t('app.app_name'), [that.$t('app.modal.button_cancel'), that.$t('app.modal.button_ok')]): (confirm(that.$t('app.modal.sure_exit')) && window.plus.runtime.quit())
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onLogout() {
				const that = this
				that.$f7.confirm(that.$t('app.member.sure_logout'), '', function() {
					that.$store.dispatch('logout')
					that.$f7.mainView.router.load({
						url: '/home/'
					})
				})
			}
		}
	}
</script>