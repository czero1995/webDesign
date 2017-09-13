<template>
	<div data-page="score" class="page score-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.score')">我的积分</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="score-num" v-if="my_wallet != null">{{my_wallet.Point.Amount.value}}</div>
		</div>
	</div>
</template>

<style lang="less">
	.score-page {
		.page-content {
			width: 100%;
			height: 3.63rem;
			margin-top: 44px;
			background: #FFFFFF;
			.score-num {
				font-family: PingFangSC-Medium;
				text-align: center;
				font-size: 1rem;
				color: #CBB06D;
				letter-spacing: 0;
				text-align: center;
			}
		}
	}
</style>
<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				fromType: 'home', // 来源 默认为 home
				my_wallet: null, //我的钱包
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
				let query = that.$route.query
				that.fromType = query.fromType // 来源类型 home  member
				that.myScore()
				// 判断是否是美国窗口
				//				if(that.user.BranchCompanyId === 6) {
				//					that.$f7.alert('US窗口不支持积分')
				//				} else {
				//					that.myScore()
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
						url: '/' + that.fromType + '/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			myScore: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.score.loading'))
				axios.get('Member/Wallet/GetWalletList', {}).then(res => {
					console.log('myWallet:', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.my_wallet = res.Data
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			}
		},
		components: {}
	}
</script>