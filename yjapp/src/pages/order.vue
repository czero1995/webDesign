<template>
	<div data-page='order' class='page order-page'>
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="center">
					<span class="text-gradient" v-text="$t('app.page.order')"></span>
				</div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class='page-content infinite-scroll'>
			<div style="text-align: center;" v-if="order_list.length === 0">
				<p class="text-gradient" v-text="$t('app.order.no_have_order')">暂时没有订单</p>
			</div>
			<div class="list-block" v-if="order_list.length > 0">
				<div class="pay-item" v-for="item in order_list">
					<ul>
						<li @click="routeToOrderDetails(item.OrderNo)">
							<div class="item-content">
								<div class="item-title clearfloat">
									<div class="order-title" v-text="$t('app.order.order_no')">订单号:</div>
									<div class="order-num">{{item.OrderNo}}</div>
									<div class="order-state">{{item.StatusString}}</div>
								</div>
							</div>
						</li>
						<li @click="routeToOrderDetails(item.OrderNo)" v-for="salesProduct in item.SalesOrderLines">
							<div class="order-detail">
								<div class="shop-img">
									<img :src="salesProduct.SalesProduct.Pictures[0]" />
								</div>
								<div class="shop-info">
									<p class="shop-name">{{salesProduct.SalesProduct.LocalizationHeadline}}</p>
									<p class="shop-money text-gradient">{{item.ExchangeRate.CurrencyCode}} {{salesProduct.SalesProduct.Price}}<span class="money-s"></span></p>
									<p v-if="user_type === 1" class="shop-bv">{{salesProduct.SalesProduct.BV}}BV</p>
								</div>
								<div class="shop-num">X{{salesProduct.Quantity}}</div>
							</div>
						</li>
						<li @click="routeToOrderDetails(item.OrderNo)">
							<a href="#" class="item-link item-content">
								<div class="item-content">
									<div class="item-title clearfloat">
										<div class="store-name" v-if="item.MerchantName !== null" v-text="item.MerchantName">億嘉國際</div>
										<div class="store-r">
											<div class="goods-num">{{item.PaymentMethodString}} {{item.ReceivingInfoLeft}}</div>
										</div>
									</div>
								</div>
							</a>
						</li>
						<li @click="routeToOrderDetails(item.OrderNo)">
							<a href="#" class="item-link item-content">
								<div class="item-content">
									<div class="item-title clearfloat">
										<div class="store-name" v-text="$t('app.order.sales_order_type')">购货方式</div>
										<div class="store-r">
											<div class="goods-num">{{item.SalesOrderTypeString}}</div>
										</div>
									</div>
								</div>
							</a>
						</li>
						<li>
							<div class="clearfloat">
								<!--<div class="pay-btn-l">
								残忍拒绝
							</div>-->
								<span class="money-text">{{$t('app.order.amount')}} <span class="text-gradient">{{item.ExchangeRate.CurrencyCode}} {{item.TotalAmount}}</span><span class="money-s text-gradient"></span></span>
								<div v-if="item.Status === 4 || item.Status === 6" @click="orderConfirm(item)" class="pay-btn-r" v-text="$t('app.order.confirm_receipt')">
									确认收货
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="toolbar tabbar">
			<div class="toolbar-inner">
				<a @click="routeToTab('home')" href="javascript:void(0);" class="tab-link">
					<i class="icon icon-tab-home"></i>
				</a>
				<a href="javascript:void(0);" class="tab-link active">
					<i class="icon icon-tab-order"></i>
				</a>
				<a @click="routeToTab('cart')" href="javascript:void(0);" class="tab-link">
					<i class="icon icon-tab-cart"></i>
				</a>
				<a @click="routeToTab('member')" href="javascript:void(0);" class="tab-link">
					<i class="icon icon-tab-member"></i>
				</a>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.order-page {
		.page-content {
			padding-bottom: 44px;
			.list-block {
				margin: 0;
				.pay-item {
					margin-bottom: 0.3rem;
					>ul {
						.item-content {
							padding-left: 0;
							width: 100%;
						}
						>li {
							border-bottom: 1px solid #eee;
							padding: 0 0.3rem;
						}
						.pay-item {}
						.item-title {
							width: 100%;
							.order-title {
								display: inline-block;
								font-family: PingFangSC-Regular;
								font-size: 0.26rem;
								color: #767676;
								letter-spacing: 0.76px;
								line-height: 0.34rem;
							}
							.order-num {
								display: inline-block;
								font-family: PingFangSC-Regular;
								font-size: 0.26rem;
								color: #767676;
								letter-spacing: 0.76px;
								line-height: 0.34rem;
							}
							.order-state {
								float: right;
								font-family: PingFangSC-Regular;
								font-size: 0.24rem;
								color: #CBB06D;
								letter-spacing: 0.71px;
								line-height: 0.44rem;
							}
						}
						.order-detail {
							width: 100%;
							padding: 0.3rem 0;
							position: relative;
							.shop-img {
								width: 18%;
								height: 1.2rem;
								// background: url(../../static/img/goods/ic_1@3x.png);
								margin-right: 0.3rem;
								float: left;
								img {
									width: 100%;
									height: auto;
								}
							}
							.shop-info {
								display: inline-block;
								width: 76%;
								.shop-name {
									font-family: PingFangSC-Regular;
									font-size: 0.26rem;
									color: #000000;
									letter-spacing: 0.76px;
									line-height: 0.34rem;
									margin: 0;
								}
								.shop-money {
									font-family: PingFangSC-Medium;
									font-size: 0.26rem;
									color: #000000;
									letter-spacing: 0.76px;
									line-height: 0.28rem;
									margin: 0;
									margin-top: 0.1rem;
								}
								.shop-bv {
									background-image: linear-gradient(-146deg, #E6CF8B 0%, #9C7B38 100%);
									border-radius: 100px;
									font-family: PingFangSC-Medium;
									font-size: 0.18rem;
									color: #FFFFFF;
									width: 1.1rem;
									text-align: center;
									height: 0.36rem;
									line-height: 0.4rem;
									letter-spacing: 0.53px;
									margin: 0;
									margin-top: 0.02rem;
								}
							}
							.shop-num {
								position: absolute;
								right: 0;
								bottom: 0.3rem;
								font-family: PingFangSC-Regular;
								font-size: 0.26rem;
								color: #B9B9B9;
								letter-spacing: 0.76px;
								line-height: 0.34rem;
							}
						}
						.store-name {
							float: left;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #767676;
							letter-spacing: 0.76px;
							line-height: 0.5rem;
						}
						.store-r {
							float: right;
							.goods-num {
								display: inline-block;
								font-family: PingFangSC-Regular;
								font-size: 0.24rem;
								color: #767676;
								letter-spacing: 0.71px;
								line-height: 0.34rem;
							}
							.goods-money {
								display: inline-block;
								font-family: PingFangSC-Medium;
								font-size: 0.26rem;
								color: #000000;
								letter-spacing: 0.76px;
								line-height: 0.28rem;
							}
						}
						.pay-btn-l {
							display: inline-block;
							background: url(../../static/icon/list_btn_Refuse_nor@3x.png);
							width: 3.3rem;
							background-size: 100%;
							height: 0.8rem;
							text-align: center;
							font-family: PingFangSC-Regular;
							font-size: 0.28rem;
							color: #CBB06D;
							letter-spacing: 0.82px;
							line-height: 0.8rem;
							margin: 0.1rem 0;
							float: left;
						}
						.money-text {
							font-family: PingFangSC-Regular;
							font-size: 0.24rem;
							color: #767676;
							letter-spacing: 0.71px;
							line-height: 0.8rem;
						}
						.pay-btn-r {
							float: right;
							background: url(../../static/icon/list_btn_payment_nor@3x.png) no-repeat;
							display: inline-block;
							width: 2.67rem;
							height: 0.7rem;
							background-size: 100%;
							line-height: 0.6rem;
							text-align: center;
							font-family: PingFangSC-Regular;
							font-size: 0.28rem;
							color: #FFFFFF;
							letter-spacing: 0.82px;
							margin: 0.1rem 0;
						}
						.all-order {
							float: right;
						}
					}
				}
			}
		}
	}
	
	.money-s {
		font-family: PingFangSC-Medium;
		font-size: 0.2rem;
		color: #000000;
		letter-spacing: 0.59px;
		line-height: 28px;
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
				currentPage: 1, // 当前页码
				pageSize: 20, // 每页订单数，默认20
				queryModel: 1, // 查询模式（1：订单接收者是我 2：创建人是我 3：付款人是我）默认为1
				lastPage: false, // 是否是最后一页，拉取订单数据没有返回数据时，设置为true,
				loading: false, // 当前是否处于加载状态,
				order_list: [] // 订单列表
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
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
				that.orderList()
				// 监听无限滑动时间
				that.$$('.infinite-scroll').on('infinite', function() {
					console.log('infinite')
					that.orderList()
				})
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
			routeToTab: function(tab) {
				this.$f7.mainView.router.load({
					url: '/' + tab + '/'
				})
			},
			orderConfirm: function(order) {
				const that = this
				console.log('orderConfirm', order)
				that.$f7.confirm('确定已收到商品吗？', function() {
					//that.$f7.showPreloader('正在提交...')
					axios.get('Deals/Order/OrderConfirm?orderNo=' + order.OrderNo).then(res => {
						console.log('OrderConfirm res', res)
						//that.$f7.hidePreloader()
						if(res.IsSuccess === true) {
							order.Status = 13 // 已签收
							order.StatusString = '已签收'
						} else {
							that.$f7.alert(res.ErrorInfos[0].Message)
						}
					})
				})
			},
			orderList: function() {
				const that = this
				console.log('loading', that.loading)
				console.log('lastPage', that.lastPage)
				if(that.lastPage || that.loading) {
					return false
				}
				that.$f7.showPreloader(that.$t('app.order.loading'))
				that.loading = true
				axios.get('Deals/Order/GetOrderList', {
					params: {
						currentPage: that.currentPage,
						pageSize: that.pageSize,
						queryModel: that.queryModel
					}
				}).then(res => {
					console.log('orderList', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						if(res.Data !== null && res.Data.length > 0) {
							that.lastPage = false
							that.currentPage++ // 当前页码+1
								res.Data.forEach(function(item) {
									that.order_list.push(item)
								})
						} else {
							that.lastPage = true
						}
					} else {
						if(that.order_list.length > 0) {
							that.lastPage = true
						}
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
			},
			routeToOrderDetails(orderNo) {
				this.$f7.mainView.router.load({
					url: `/order_details/?orderNo=${orderNo}`
				})
			}
		}
	}
</script>