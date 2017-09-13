<template>
	<div data-page="goods-details" class="page goods-details-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.goods_details')">商品详情</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="goods-img">
				<img :src="product_detail.Pictures" />
			</div>
			<div class="goods-info">
				<div class="goods-name">{{product_detail.LocalizationHeadline}}</div>
				<div class="goods-money text-gradient">{{product_detail.CurrencyCode}}</div>
				<div class="goods-bv" v-if="user_type === 1">{{product_detail.BV}}BV</div>
			</div>
			<div class="goods-introduce">
				<div class="goods-title text-gradient" v-text="$t('app.goods_details.goods_intro')">商品介绍</div>
			</div>
			<div class="goods-description" v-html="product_detail.LocalizationDescription">
			</div>
		</div>
		<div class="toolbar">
			<div class="toolbar-inner row no-gutter goods-bottom">
				<div class="col-50">
					<div class="row no-gutter">
						<div class="col-50">
							<a @click="routeToHome" href="javascript:void(0);" class="active tab-link icon-only link goods-home"><i class="icon icon icon-tab-home"></i></a>
						</div>
						<div class="col-50">
							<a @click="routeToCart" href="javascript:void(0);" class="tab-link icon-only link goods-cart"><i class="icon icon icon-tab-cart"></i></a>
						</div>
					</div>
				</div>
				<div class="col-50 buy-now" @click="onBuyNow(id, salesArea)" v-text="$t('app.goods_details.buy')">立即购买</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.goods-details-page {
		.page-content {
			padding-bottom: 44px;
		}
		.goods-img {
			width: 100%;
			height: 3.2rem;
			text-align: center;
			>img {
				height: 3.2rem;
			}
		}
		.goods-info {
			min-height: 1.28rem;
			width: 100%;
			background: #FFFFFF;
			position: relative;
			.goods-name {
				font-family: PingFangSC-Regular;
				font-size: 0.26rem;
				color: #000000;
				letter-spacing: 0.7px;
				padding-left: 0.3rem;
				padding-top: 0.22rem;
				padding-bottom: 0.07rem;
			}
			.goods-money {
				padding-left: 0.3rem;
				font-family: PingFangSC-Medium;
				font-size: 0.26rem;
				color: #000000;
				letter-spacing: 0.59px;
				line-height: 28px;
			}
			.goods-bv {
				position: absolute;
				background-image: linear-gradient(-146deg, #E6CF8B 0%, #9C7B38 100%);
				border-radius: 100px;
				font-family: PingFangSC-Medium;
				font-size: 0.18rem;
				color: #FFFFFF;
				letter-spacing: 0.53px;
				right: 0.3rem;
				bottom: 0.22rem;
				padding: 0 0.1rem;
				text-align: center;
			}
		}
		.goods-introduce {
			width: 100%;
			height: 0.88rem;
			background: #FFFFFF;
			margin-top: 0.2rem;
			line-height: 0.88rem;
			.goods-title {
				padding-left: 0.3rem;
			}
		}
		.goods-description {
			width: 100%;
			height: auto;
			p {
				width: 100% !important;
			}
			img {
				height: auto !important;
				width: 100% !important;
			}
		}
		.goods-bottom {
			background: #FFFFFF;
			padding: 0px;
			.goods-home,
			.goods-cart {
				height: 44px;
				text-align: center;
				line-height: 44px;
			}
			.buy-now {
				background: url(../../static/icon/list_bg_content_sel@3x.png);
				height: 44px;
				background-size: 100%;
				font-family: PingFangSC-Regular;
				font-size: 0.3rem;
				color: #FFFFFF;
				letter-spacing: 0;
				display: inline-block;
				text-align: center;
				line-height: 44px;
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
				id: '',
				salesArea: '',
				fromType: 'home', // 从哪里跳转过来的，默认为首页 home， 还有购货区 goods_list
				product_detail: {}, //产品详情页
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				isSetDetail: state => state.isSetDetail,
				confirmAgreement: state => state.confirmAgreement,
				user: state => state.user,
				user_type: state => state.user_type
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
				console.log('query', query)
				that.id = query.id // 商品id
				that.salesArea = query.salesArea // 所属购货区
				that.fromType = query.fromType // 来源类型 home  goods_list
				that.goodsDetail()
			})
		},
		methods: {
			routeBack: function() {
				const that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					if(that.fromType === 'home') {
						that.$f7.mainView.router.load({
							url: '/home/'
						})
					} else if(that.fromType === 'goods_list') {
						that.$f7.mainView.router.load({
							url: '/goods_list/'
						})
					}
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			goodsDetail: function() {
				const that = this
				that.$f7.showPreloader('正在获取商品数据')
				axios.get('Deals/Product/GetProductById', {
					params: {
						productId: that.id,
						salesArea: that.salesArea
					}
				}).then(res => {
					console.log('homeProduct_list', res)
					if(res.IsSuccess === true) {
						that.product_detail = res.Data
						setTimeout(function() {
							that.$f7.hidePreloader()
						}, 500)
					} else {
						that.$f7.hidePreloader()
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onBuyNow(id, salesArea) {
				const that = this
				if(that.user_type !== 0 && that.user !== null) {
					if(that.user_type === 1) {
						// 会员需要判断是否同意条款及填写详细信息
						// 会员未同意条款，需要跳转到同意条款页面
						if(that.confirmAgreement === false) {
							that.$f7.mainView.router.load({
								url: '/login_agreement/'
							})
							return false
						}
						// 会员未设置详细信息，需要跳转到详细信息页面
						if(that.isSetDetail === false) {
							that.$f7.mainView.router.load({
								url: '/login_fill_info/'
							})
							return false
						}
					}
					axios.post('Deals/ShoppingCart/AddCartItem', {
						'ProductId': that.id,
						'SalesArea': that.salesArea,
						'Count': 1
					}).then(res => {
						console.log('addCart', res)
						if(res.IsSuccess === true) {
							// 加入购物车，再跳转到购物车页面
							that.$f7.showPreloader('成功加入购物车')
							setTimeout(function() {
								that.$f7.hidePreloader()
								that.routeToCart()
							}, 800)
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
				} else {
					that.$f7.mainView.router.load({
						url: 'login'
					})
				}
			},
			routeToHome: function() {
				const that = this
				that.$f7.mainView.router.load({
					url: 'home'
				})
			},
			routeToCart: function() {
				const that = this
				if(that.user_type !== 0 && that.user !== null) {
					if(that.user_type === 1) {
						// 会员未同意条款，需要跳转到同意条款页面
						if(that.confirmAgreement === false) {
							that.$f7.mainView.router.load({
								url: '/login_agreement/'
							})
							return false
						}
						// 会员未设置详细信息，需要跳转到详细信息页面
						if(that.isSetDetail === false) {
							that.$f7.mainView.router.load({
								url: '/login_fill_info/'
							})
							return false
						}
					}
					that.$f7.mainView.router.load({
						url: `/cart/?salesArea=${that.salesArea}`
					})
				} else {
					that.$f7.mainView.router.load({
						url: 'login'
					})
				}
			}
		},
		components: {}
	}
</script>