<template>
	<div data-page="order-details" class="page order-details-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.order_details')">订单详情</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content" v-if="order_details != null">
			<div class="list-block">
				<ul>
					<li>
						<div class="item-content order-detail">
							<div class="item-title  clearfloat">
								<div class="order-title" v-text="$t('app.order_details.order_no')">订单号:</div>
								<div class="order-num">{{order_details.OrderNo}}</div>
								<div class="order-date">{{order_details.CreateAtString}}</div>
							</div>
						</div>
					</li>
					<li>
						<div class="flow-box">
							<img v-if="order_details.Status === 1" src="../../static/icon/order_status_01_wait_payment@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 2" src="../../static/icon/order_status_02_paymented@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 3" src="../../static/icon/order_status_03_delivering@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 4" src="../../static/icon/order_status_04_shipped@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 5" src="../../static/icon/order_status_05_wait_self_pickup@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 6" src="../../static/icon/order_status_06_self_pickedup@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 7" src="../../static/icon/order_status_07_canceled@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 8" src="../../static/icon/order_status_08_refunding@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 9" src="../../static/icon/order_status_09_refunded@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 10" src="../../static/icon/order_status_10_payment_confirming@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 11" src="../../static/icon/order_status_11_payment_failure@3x.png" class="flow-img" />
							<img v-if="order_details.Status === 12" src="../../static/icon/order_status_12_paymnet_overtime@3x.png" class="flow-img" />
							<img v-if="order_details.Status == 13" src="../../static/icon/order_status_13_signed@3x.png" class="flow-img" />
							<p class="flow-state">{{order_details.StatusString}}</p>
						</div>
					</li>
					<!--<li>
						<a href="/delivery" class="item-link item-content">
							<div class="item-inner">
								<div class="item-title flow-detail">快递 55555555666444
								</div>
							</div>
						</a>
					</li>-->
				</ul>
				<!-- 柜台自提 -->
				<div class="user-detail" v-if="order_details.TransportModel === 1">
					<div class="address-box">
						<div class="detailText" v-text="$t('app.order_details.frontend_address')">柜台地址</div>
						<div class="addressDir">{{order_details.ReceivingInfo.Frontend.Address}}</div>
					</div>
				</div>
				<!-- 物流输送 -->
				<div class="user-detail" v-if="order_details.TransportModel === 2 || order_details.TransportModel === 4">
					<div class="user-box clearfloat">
						<div class="detailText" v-text="$t('app.order_details.contact')">收件人</div>
						<div class="userName">{{order_details.ReceivingInfo.Receiver}}</div>
						<div class="userPhone">{{order_details.ReceivingInfo.Telephone}}</div>
					</div>
					<div class="address-box">
						<div class="detailText" v-text="$t('app.order_details.address')">地址</div>
						<div class="addressDir" style="padding-left: 30px;">{{order_details.ReceivingInfo.DeliveryAddress.DetailAddress}}</div>
					</div>
					<div class="post-box">
						<div class="detailText" v-text="$t('app.order_details.postcode')">邮编</div>
						<div class="postNum">{{order_details.ReceivingInfo.Postcode}}</div>
					</div>
				</div>
				<!-- 服务中心领取 -->
				<div class="user-detail" v-if="order_details.TransportModel === 3">
					<div class="post-box">
						<div class="detailText" v-text="$t('app.order_details.distributor')">服务中心</div>
						<div class="postNum">{{order_details.ReceivingInfo.Distributor.DistributorCode}}</div>
					</div>
					<div class="address-box">
						<div class="detailText" v-text="$t('app.order_details.address')">地址</div>
						<div class="addressDir">{{order_details.ReceivingInfo.Distributor.DistributorAddress}}</div>
					</div>
				</div>
				<div class="shop-detail" v-for="product in order_details.SalesOrderLines">
					<div class="store-title"></div>
					<div class="shop-box">
						<div class="shop-img">
							<img :src="product.SalesProduct.Pictures[0]" />
						</div>
						<div class="shop-info">
							<p class="shop-name">{{product.SalesProduct.LocalizationHeadline}}</p>
							<p class="shop-money text-gradient">{{order_details.ExchangeRate.CurrencyCode}} {{product.SalesProduct.Price}}<span class="money-s"></span></p>
						</div>
						<div class="shop-num">X{{product.Quantity}}</div>
					</div>
					<div class="shop-infos">
						<div class="infos-box clearfloat">
							<div class="infosText" v-text="$t('app.order_details.shipping_method')">物流模式</div>
							<div class="infosText infos-right">{{order_details.ReceivingInfoLeft}}</div>
						</div>
						<div class="infos-box clearfloat" v-show="user_type === 1">
							<div class="infosText" v-text="$t('app.order_details.product_bv')">商品BV</div>
							<div class="infosText infos-right">{{product.SalesProduct.BV}}BV</div>
						</div>
						<!-- 只有美国和加拿大显示税费和运费 -->
						<div class="infos-box clearfloat" v-if="user.BranchCompanyId === 6 || user.BranchCompanyId === 10">
							<div class="infosText" v-text="$t('app.order_details.tax')">税费</div>
							<div class="infosText infos-right text-gradient">{{order_details.ExchangeRate.CurrencyCode}} {{order_details.OrderTax.TotalTax}}</div>
						</div>
						<div class="infos-box clearfloat" v-if="user.BranchCompanyId === 6 || user.BranchCompanyId === 10">
							<div class="infosText" v-text="$t('app.order_details.freight')">运费</div>
							<div class="infosText infos-right text-gradient">{{order_details.ExchangeRate.CurrencyCode}} {{order_details.Freight}}</div>
						</div>
					</div>
				</div>

				<div class="infos-pay">
					<div class="payText" v-text="$t('app.order_details.sales_order_type')">购货方式</div>
					<div class="payWay">{{order_details.SalesOrderTypeString}}</div>
				</div>

				<div class="infos-pay">
					<div class="payText" v-text="$t('app.order_details.order_amount')">订单金额</div>
					<div class="payWay text-gradient">{{order_details.ExchangeRate.CurrencyCode}} {{order_details.TotalAmount}}</div>
				</div>

				<div class="infos-pay">
					<div class="payText" v-text="$t('app.order_details.payment')">支付方式</div>
					<div class="payWay">{{order_details.PaymentMethodString}}</div>
				</div>
			</div>
		</div>
	</div>
</template>
<style lang="less">
	.order-details-page {
		.list-block {
			margin: 0;
			>ul {
				.item-content {
					padding-left: 0;
				}
				.order-detail {
					border-bottom: 1px solid #eee;
				}
				.item-title {
					padding: 0 0.3rem;
					width: 100%;
					.order-title {
						display: inline-block;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #767676;
						etter-spacing: 0.76px;
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
					.order-date {
						float: right;
						font-family: PingFangSC-Regular;
						font-size: 0.24rem;
						color: #767676;
						letter-spacing: 0.71px;
						line-height: 0.44rem;
					}
				}
				.flow-box {
					width: 100%;
					height: 2.62rem;
					margin: 0 auto;
					border-bottom: 1px solid #eee;
					.flow-img {
						width: 0.95rem;
						height: 0.9rem;
						margin: 0 auto;
						display: block;
						margin-top: 0.61rem;
					}
					.flow-state {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #878787;
						padding-top: 0.1rem;
						letter-spacing: 0.76px;
						line-height: 0.34;
						text-align: center;
					}
				}
				.flow-detail {
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #767676;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
				}
			}
			.user-detail {
				margin-top: 0.1rem;
				background: #ffffff;
				padding: 0.3rem 0.3rem;
				border: double orange 3px;
				border-image: url(../../static/icon/Order_address_lace@3x.png) 30 30 round;
				.detailText {
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
					display: inline-block;
				}
				.user-box {
					.userName {
						display: inline-block;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #8F8F8F;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
						margin-left: 0.78rem;
					}
					.userPhone {
						display: inline-block;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #8F8F8F;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
						float: right;
					}
				}
				.address-box {
					padding-top: 0.1rem;
					.addressDir {
						display: inline-block;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #8F8F8F;
						letter-spacing: 0.76px;
						line-height: 0.4rem;
					}
				}
				.post-box {
					padding-top: 0.1rem;
					.postNum {
						display: inline-block;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #8F8F8F;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
						padding-left: 0.78rem;
					}
				}
			}
			.shop-detail {
				padding-top: 0.1rem;
				margin-top: 0.1rem;
				background: #ffffff;
				.store-title {
					padding: 0 0.3rem;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #767676;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
					height: 0.8rem;
				}
				.shop-box {
					padding: 0 0.3rem;
					position: relative;
					.shop-img {
						width: 1.2rem;
						height: 1.2rem;
						margin-right: 0.3rem;
						display: inline-block;
						vertical-align: middle;
						img {
							width: 100%;
							height: auto;
						}
					}
					.shop-info {
						display: inline-block;
						.shop-name {
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #000000;
							letter-spacing: 0.76px;
							line-height: 0.34rem;
							margin: 0;
							vertical-align: middle;
							position: relative;
						}
						.shop-name {
							position: absolute;
							top: 0;
						}
						.shop-money {
							font-family: PingFangSC-Medium;
							font-size: 0.26rem;
							color: #000000;
							letter-spacing: 0.76px;
							line-height: 0.28rem;
							margin: 0;
							position: absolute;
							margin-top: 100px;
							bottom: 0;
						}
					}
					.shop-num {
						position: absolute;
						right: 0.3rem;
						bottom: 0;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #B9B9B9;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
				}
			}
			.shop-infos {
				padding: 0.2rem 0.3rem;
				border-bottom: 1px solid #eee;
				.infos-box {
					margin-top: 0.1rem;
					.infosText,
					.moneyText {
						display: inline-block;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #696969;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
					.infos-right {
						float: right;
					}
				}
			}
			.infos-money {
				padding: 0.2rem 0.3rem;
				.moneyText {
					display: inline-block;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
				}
				.shopMoney {
					float: right;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
				}
			}
			.infos-pay {
				background: #ffffff;
				margin-top: 0.2rem;
				padding: 0 0.3rem;
				height: 0.88rem;
				line-height: 0.88rem;
				.payText {
					display: inline-block;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
				}
				.payWay {
					float: right;
					line-height: 0.88rem;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.88rem;
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
				order_details: null
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
				let query = that.$route.query
				console.log('query', query)
				that.orderDetail(query.orderNo)
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
						url: '/order/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			orderDetail: function(orderNo) {
				console.log('orderDetails', orderNo)
				const that = this
				that.$f7.showPreloader(that.$t('app.order_details.loading'))
				axios.get('Deals/Order/GetOrderInfo', {
					params: {
						orderNo: orderNo
					}
				}).then(res => {
					console.log('orderDetails', res)
					if(res.IsSuccess === true) {
						that.order_details = res.Data
						setTimeout(function() {
							that.$f7.hidePreloader()
						}, 500)
					} else {
						that.$f7.hidePreloader()
						// 判断token是否已过期
						if(res.ErrorInfos[0].ErrorCode === 33555457) {
							that.$f7.alert(that.$t('app.login_timeout'), '', function() {
								that.$f7.mainView.router.load({
									url: '/login/'
								})
							})
						} else {
							// 判断token是否已过期
							if(res.ErrorInfos[0].ErrorCode === 33555457) {
								that.$f7.alert(that.$t('app.login_timeout'), '', function() {
									that.$f7.mainView.router.load({
										url: '/login/'
									})
								})
							} else {
								that.$f7.alert(res.ErrorInfos[0].Message)
							}
						}
					}
				})
			},
			routeToDelivery(id) {
				this.$f7.mainView.router.load({
					url: '/delivery/'
				})
			}
		},
		components: {}
	}
</script>