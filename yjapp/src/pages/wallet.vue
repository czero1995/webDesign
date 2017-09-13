<template>
	<div data-page="wallet" class="page wallet-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.wallet')">我的钱包</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<!-- 美国没有电子钱包 -->
			<div class="wallet-content" v-if="my_wallet != null && user.BranchCompanyId !== 6">
				<div class="wallet-item">
					<div class="wallet-way">EP1</div>
					<div class="wallet-box">
						<span class="wallet-title" v-text="$t('app.wallet.balance')">余额</span>
						<span class="wallet-num"><span class="num-f">{{user.CurrencyCode}}</span>{{my_wallet.EP1.Amount.value}}<span class="num-s"></span></span>
					</div>
					<div class="wallet-post">NO.{{my_wallet.EP1.AgentId}}</div>
				</div>
				<div class="wallet-item">
					<div class="wallet-way">EP2</div>
					<div class="wallet-box">
						<span class="wallet-title" v-text="$t('app.wallet.balance')">余额</span>
						<span class="wallet-num"><span class="num-f">{{user.CurrencyCode}}</span>{{my_wallet.EP2.Amount.value}}<span class="num-s"></span></span>
					</div>
					<div class="wallet-post">NO.{{my_wallet.EP2.AgentId}}</div>
				</div>
				<div class="wallet-item">
					<div class="wallet-way">EP3</div>
					<div class="wallet-box">
						<span class="wallet-title" v-text="$t('app.wallet.balance')">余额</span>
						<span class="wallet-num"><span class="num-f">{{user.CurrencyCode}}</span>{{my_wallet.EP3.Amount.value}}<span class="num-s"></span> </span>
					</div>
					<div class="wallet-post">NO.{{my_wallet.EP3.AgentId}}</div>
				</div>
				<!-- 加拿大没有GC钱包 -->
				<div class="wallet-item" v-if="user.BranchCompanyId !== 10">
					<div class="wallet-way">GC</div>
					<div class="wallet-box">
						<span class="wallet-title" v-text="$t('app.wallet.balance')">余额</span>
						<span class="wallet-num"><span class="num-f">{{user.CurrencyCode}}</span>{{my_wallet.GC.Amount.value}}<span class="num-s"></span> </span>
					</div>
					<div class="wallet-post">NO.{{my_wallet.GC.AgentId}}</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.wallet-page {
		.wallet-content {
			float: left;
			margin-top: 0.3rem;
			overflow-x: auto;
			width: 25rem;
			.wallet-item {
				float: left;
				background: url(../../static/icon/bonus_bg@3x.png);
				background-size: 100%;
				width: 5.65rem;
				height: 2.9rem;
				margin: 0 0.3rem;
				position: relative;
				border-radius: 10px;
				.wallet-way {
					top: 0.21rem;
					left: 0.31rem;
					position: absolute;
					font-family: PingFangSC-Semibold;
					font-size: 0.24rem;
					color: #FFFAED;
					letter-spacing: 0.71px;
				}
				.wallet-box {
					padding-top: 1.04rem;
					text-align: center;
					.wallet-title {
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #FFEFCD;
						letter-spacing: 0.76px;
						margin-right: 0.1rem;
					}
					.wallet-num {
						font-size: 0.5rem;
						color: #FFFFFF;
						.num-f {
							font-size: 0.28rem;
							margin-right: 0.1rem;
						}
						.num-s {
							font-size: 0.28rem;
						}
					}
				}
				.wallet-post {
					font-family: PingFangSC-Semibold;
					font-size: 0.18rem;
					color: #CBB16D;
					letter-spacing: 0.53px;
					line-height: 0.21rem;
					position: absolute;
					bottom: 0.19rem;
					right: 0.17rem;
				}
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
				my_wallet: null
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user
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
				that.myWallet()
				// 判断是否是美国窗口
				//				if(that.user.BranchCompanyId === 6) {
				//					that.$f7.alert('US窗口不支持钱包')
				//				} else {
				//					that.myWallet()
				//				}
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
			myWallet: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.wallet.loading'))
				axios.get('Member/Wallet/GetWalletList').then(res => {
					console.log('myWallet:', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.my_wallet = res.Data
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
		},
		components: {}
	}
</script>