<template>
	<div data-page="order-confirm" class="page order-confirm-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.order_confirm')">订单结算</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content" v-if="order_confirm != null">
			<div class="list-block">
				<div class="order-item" v-for="shop in order_confirm.CartProductList">
					<ul>
						<li>
							<a href="#" class="item-link item-content">
								<div class="item-content">
									<div class="item-title clearfloat">
										<div class="store-name" v-if="shop.Merchant.SelfEmployed" v-text="$t('app.app_name')">億嘉國際</div>
										<div class="store-name" v-if="!shop.Merchant.SelfEmployed">{{shop.Merchant.Name}}</div>
									</div>
								</div>
							</a>
						</li>
						<li v-for="product in shop.OrderMerchantProducts">
							<div class="order-detail">
								<img class="shop-img" :src="product.Pictures" />
								<div class="shop-info">
									<p class="shop-name">{{product.Headline}}</p>
									<p class="shop-money text-gradient">{{product.DisplayPrice}}<span class="money-s"></span></p>
									<p v-show="user_type === 1" class="shop-bv">{{product.BV}}BV</p>
								</div>
								<div class="shop-num">X{{product.Quantity}}</div>
							</div>
						</li>
						<li class="clearfloat">
							<div class="order-l" v-text="$t('app.order_confirm.freight')">运费</div>
							<div class="order-r"> <span class="money-s"></span>{{shop.Merchant.Freight}}<span class="money-s"></span></div>
						</li>
						<li class="clearfloat">
							<div class="order-l" v-text="$t('app.order_confirm.tax')">税费</div>
							<div class="order-r"> <span class="money-s"></span>{{shop.Merchant.Tax}}</div>
						</li>
						<li class="clearfloat" @click="onShowShippingMethod(shop)">
							<div class="order-l" v-text="$t('app.order_confirm.shipping_method')">配送方式</div>
							<div class="order-r">
								{{shop.Merchant.SelectedTransportMethodDic.Text}}
								<img v-if="shop.showShippingMethod === true" class="flow-more" src="../../static/icon/list_btn_back_nor@3x.png" />
								<img v-if="shop.showShippingMethod === false" class="flow-more" src="../../static/icon/list_btn_more_nor@3x.png" />
							</div>
						</li>
						<li class="flow-way" v-show="shop.showShippingMethod">
							<div class="flow-way-item" @click="onSelectTransportMethod(shop, shippingMethod.Text, shippingMethod.Value)" :class="{active: shop.Merchant.SelectedTransportMethodDic.Value === shippingMethod.Value}" v-for="shippingMethod in shop.Merchant.ShippingMethodList">{{shippingMethod.Text}}</div>
							<!--<div class="flow-way-item" @click="onSelectTransportMethod(shop, shippingMethod, key_index)" :class="{active: shop.Merchant.SelectedTransportMethodDic.Value === key_index}" v-if="!shop.Merchant.SelfEmployed" v-for="(shippingMethod, key_index) in shop.Merchant.TransportMethodDic">{{shippingMethod}}</div>-->
						</li>
						<!-- 柜台自提 -->
						<li class="clearfloat" v-show="shop.Merchant.SelectedTransportMethodDic.Value === 'frontend' && shop.Merchant.SelectedFrontEnd.Id !== null">
							<div class="order-l">
								{{shop.Merchant.SelectedFrontEnd.Name}} {{shop.Merchant.SelectedFrontEnd.Address}}
							</div>
						</li>
						<!-- 服务中心自提或服务中心物流输送 -->
						<li class="clearfloat" v-show="(shop.Merchant.SelectedTransportMethodDic.Value === 'distributor' || shop.Merchant.SelectedTransportMethodDic.Value === 'distributorExpress') && shop.Merchant.SelectedDistributor.Id !== null">
							<div class="order-l">
								{{shop.Merchant.SelectedDistributor.Name}} {{shop.Merchant.SelectedDistributor.Address}}
							</div>
						</li>

					</ul>
				</div>
				<!-- 物流输送，只要有任意一个商家（包括自营）选择了物流输送，就需要显示，所有物流输送统一用一个收货地址 -->
				<div class="order-item" v-if="needAddress">
					<ul>
						<li class="add-address clearfloat" @click="onChoiceAddr">
							<div>
								<span v-text="$t('app.order_confirm.choice_address')">选择收货地址</span>
								<img class="flow-more" src="../../static/icon/nav_btn_right@3x.png" />
							</div>
						</li>
						<li class="clearfloat" v-if="order_confirm_address !== null">
							<div class="order-l">
								{{order_confirm_address.DistrictSummary}}-{{order_confirm_address.Address}}
							</div>
						</li>
					</ul>
				</div>
				<div class="order-info" v-if="user_type === 1">
					<div class="order-info-item clearfloat" @click="onHelpPay">
						<div class="info-item-l" v-text="$t('app.order_confirm.buy_for_friend')">代下线会员购买</div>
						<div class="info-item-r clearfloat">
							<img v-show="helpPay" src="../../static/icon/list_selected_sel@3x.png" alt="" />
							<img v-show="!helpPay" src="../../static/icon/list_Unselected_nor@3x.png" alt="" />
						</div>
					</div>
					<div class="info-item-l" v-show="helpPay">
						<input type="number" class="info-item-input" v-model="helpLoginId" pattern="\d{8}" :placeholder="$t('app.order_confirm.input_friend_id')" />
					</div>
					<div class="order-info-item" v-show="helpPay">
						<div class="info-item-l" v-text="helpFullName">订单接收会员姓名</div>
					</div>
					<div class="order-info-item">
						<div class="info-item-l">{{$t('app.order_confirm.total_sales_bv')}} {{totalSalesBV}} BV</div>
					</div>
				</div>
				<!-- 台湾窗口才可以选择发票信息 -->
				<div class="order-item" v-if="user.BranchCompanyId === 4">
					<ul>
						<li class="clearfloat" @click="onShowInvoiceType">
							<div class="order-l" v-text="$t('app.order_confirm.invoice_info')">发票信息</div>
							<div class="order-r">
								{{invoiceType === 1 ? $t('app.order_confirm.e_invoice') : $t('app.order_confirm.donate_invoce')}} {{invoiceType === 3 ? $t('app.order_confirm.e_invoice') : ''}}
								<img v-if="showInvoiceType === true" class="flow-more" src="../../static/icon/list_btn_back_nor@3x.png" />
								<img v-if="showInvoiceType === false" class="flow-more" src="../../static/icon/list_btn_more_nor@3x.png" />
							</div>
						</li>
						<li class="flow-way" v-if="showInvoiceType === true">
							<div @click="onSwitchInvoice(1)" class="flow-way-item" :class="{active: invoiceType === 1}" v-if="!user.IsCompanyAgent" v-text="$t('app.order_confirm.e_invoice')">电子发票</div>
							<div @click="onSwitchInvoice(2)" class="flow-way-item" :class="{active: invoiceType === 2}" v-if="!user.IsCompanyAgent" v-text="$t('app.order_confirm.donate_invoce')">捐赠</div>
							<div @click="onSwitchInvoice(3)" class="flow-way-item" :class="{active: invoiceType === 3}" v-if="user.IsCompanyAgent" v-text="$t('app.order_confirm.e_invoice')">电子发票</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="toolbar">
			<div class="toolbar-inner row no-gutter order-bottom">
				<div class="col-50 bottom-l">
					<div class="l-box clearfloat">
						<span class="l-title" v-text="$t('app.order_confirm.amount')">合计</span>
						<span class="l-money text-gradient" v-if="order_confirm !== null"> 
							<span class="money-s">{{order_confirm.CartProductList[0].OrderMerchantProducts[0].CurrenyCode}}</span> {{totalAmount}}<span class="money-s"></span>
						</span>
					</div>
				</div>
				<div class="col-50 bottom-r" @click="onPay" v-text="$t('app.order_confirm.pay')">支付</div>
			</div>
		</div>
	</div>
</template>
<style lang="less">
	.order-confirm-page {
		.page-content {
			position: static;
			padding-bottom: 44px;
			.list-block {
				margin: 0!important;
				.info-item-input {
					font-size: 0.26rem;
					padding-left: 0.3rem;
					border-bottom: 1px solid #eee;
				}
				.order-item {
					margin-bottom: 0.1rem;
					>ul {
						.item-content {
							width: 100%;
							padding-left: 0;
						}
						>li {
							border-bottom: 0.001rem solid #eee;
							padding: 0 0.3rem;
						}
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
							height: auto;
							padding: 0.3rem 0;
							position: relative;
							.shop-img {
								width: 1.2rem;
								height: 1.2rem;
								margin-right: 0.3rem;
								display: inline-block;
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
									width: 5rem;
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
									height: 0.26rem;
									line-height: 0.26rem;
									letter-spacing: 0.53px;
									margin: 0;
									margin-top: 0.02rem;
									padding: 4px;
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
						.order-l {
							display: inline-block;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #696969;
							letter-spacing: 0.76px;
							line-height: 0.34rem;
							padding: 0.3rem 0.1rem;
							text-align: left;
						}
						.order-r {
							float: right;
							font-family: PingFangSC-Medium;
							font-size: 0.26rem;
							color: #000000;
							letter-spacing: 0.76px;
							line-height: 0.88rem;
							.flow-more {
								width: 0.3rem;
								height: 0.16rem;
								margin-left: 0.18rem;
							}
						}
						.flow-way {
							margin: 0 0.3rem;
							padding: 0px;
							background: #F2F2F2;
							border: 1px solid #D7D7D7;
							text-align: center;
							.flow-way-item {
								padding-top: 0.2rem;
								padding-bottom: 0.26rem;
								font-family: PingFangSC-Regular;
								font-size: 0.26rem;
								color: #696969;
								letter-spacing: 0.76px;
								line-height: 0.34rem;
								&.active {
									background-color: #CDB87B;
									color: #fff;
								}
							}
						}
						.add-address {
							width: 100%;
							height: 0.88rem;
							background: #FFFFFF;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #696969;
							letter-spacing: 0.76px;
							line-height: 0.88rem;
							div {
								position: relative;
								padding-left: 0.1rem;
								.flow-more {
									width: 0.2rem;
									height: 0.2rem;
									right: 0;
									top: 0;
									bottom: 0;
									position: absolute;
									margin: auto;
								}
							}
						}
					}
				}
				.order-info {
					background: #FFFFFF;
					margin-bottom: 0.1rem;
					margin-top: 0.1rem;
					.order-info-item {
						width: 100%;
						height: 0.88rem;
						line-height: 0.88rem;
						border-bottom: 1px solid #eee;
						.info-item-l {
							padding-left: 0.3rem;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #696969;
							letter-spacing: 0.76px;
							display: inline-block;
						}
						.info-item-r {
							float: right;
							margin-right: 0.3rem;
							width: 20px;
							>img {
								width: 0.268rem;
								height: 0.268rem;
							}
						}
					}
				}
			}
		}
		.toolbar {
			.order-bottom {
				padding: 0px;
				height: 44px;
				background: #FFFFFF;
				.bottom-l {
					.l-title {
						font-family: PingFangSC-Regular;
						font-size: 0.24rem;
						color: #767676;
						line-height: 44px;
						letter-spacing: 0.71px;
						padding-left: 0.3rem;
					}
					l-money {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #000000;
						letter-spacing: 0.76px;
					}
				}
				.bottom-r {
					background: url(../../static/icon/list_bg_content_sel@3x.png);
					text-align: center;
					font-family: PingFangSC-Regular;
					font-size: 0.3rem;
					color: #FFFFFF;
					letter-spacing: 0;
					line-height: 44px;
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
	
	.shipping-list,
	.paymentway-list,
	.creditCardType-list,
	.cCTermType-list {
		margin: 10px -20px -15px -20px;
		li {
			.item-inner {
				color: #595959;
				font-weight: 200;
				text-align: center;
				font-size: 0.3rem;
				&:after {
					background: transparent;
				}
			}
			&.active {
				background: url(../../static/icon/Selected@3x.png);
				color: #595959;
				letter-spacing: 0;
			}
		}
	}
</style>
<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	//	import { accAdd } from '../utils/appFunc'
	export default {
		data() {
			const that = this
			return {
				fromType: 'cart', // 默认是从购物车跳转过来的，选择物流输送地址的时候，则为address
				resume: false, // 应用从后台返回前台
				newIntent: false, // 是否已经进入newIntent
				paying: false, // 是否正在提交支付
				helpPay: false, // 是否代下线购买
				helpLoginId: '', // 代下线购买的会员编号
				helpFullName: that.$t('app.order_confirm.friend_fullname'), // 代下线购买的会员名称
				totalSalesBV: 0, // 累计个人购货BV，会根据代下线会员购买或自己购买而改变
				paymentMethod: '', // 支付方式  （1. EP2："EP2"； 2. EP3："EP3"；3. 信用卡："CreditCard"； 4. Paypal："Paypal"； 5. 好友代付："AgentTrade"）
				paymentWay: null,
				securityPassword: '', // 支付密码
				callbackUrl: 'yijia://', // 支付回调协议， 3. 信用卡："CreditCard"； 4. Paypal："Paypal" 必须
				creditCardType: '', // 信用卡类型：马来西亚窗口信用卡类型（"MasterCard" 或者 "VISA"）
				cCTermType: '', // 台湾窗口信用卡分期类型（不分期 ："noTerm"; 3期： "term3"; 12期："term12"）
				//invoiceType: 1, // 发票类型(台湾窗口专用,0未知;1个人(电子发票);2个人捐赠(捐赠);3公司(纸本))
				showInvoiceType: true, // 是否显示发票选择框
				helpPayLoginId: '', // 代付会员编号
				subMember: null, // 下线会员
				// 配送方式数组
				shippingMethodArr: {
					'frontend': 1, // 柜台领取
					'express': 2, // 物流输送
					'distributor	': 3, // 经销商服务中心领取
					'distributorExpress': 4 // 服务中心物流输送
				}
			}
		},
		watch: {
			helpLoginId: function(val) {
				const that = this
				console.log('watch helpLoginId', val)
				if(val.trim().length === 8) {
					// 判断输入的是否是自己的编号
					if(that.user.LoginId === val) {
						that.$f7.alert(that.$t('app.order_confirm.do_not_input_self_id'))
						that.helpLoginId = ''
					} else {
						// 检查订单接收者编号资格检测
						that.CheckAgentInfoAndOrganization()
					}
				}
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				user_type: state => state.user_type,
				//paymentWay: state => state.paymentWay,
				order_confirm: state => state.order_confirm, // 订单结算确认
				order_confirm_address: state => state.order_confirm_address, // 物流输送地址详细信息
				invoiceType: state => state.order_confirm_invoiceType // 发票类型
			}),
			//// 动态判断是否需要选择物流输送地址
			needAddress: function() {
				const that = this
				var needAddress = false
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						// 只要选择了物流输送或经销商服务中心物流输送的，就需要选择收货地址
						if(shop.Merchant.SelectedTransportMethodDic.Value === 'express' || shop.Merchant.SelectedTransportMethodDic.Value === 'distributorExpress') {
							needAddress = true
						}
					})
				}
				return needAddress
			},
			// 动态判断是否需要选择柜台领取
			needFrontend: function() {
				const that = this
				var needFrontend = false
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						if(shop.Merchant.SelectedTransportMethodDic.Value === 'frontend' && shop.Merchant.SelectedFrontEnd.Id === null) {
							needFrontend = true
						}
					})
				}
				return needFrontend
			},
			// 动态判断是否需要选择服务中心自提
			needDistributor: function() {
				const that = this
				var needDistributor = false
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						// 服务中心自提或服务中心物流输送，都需要选择服务中心网点
						if((shop.Merchant.SelectedTransportMethodDic.Value === 'distributor' || shop.Merchant.SelectedTransportMethodDic.Value === 'distributorExpress') && shop.Merchant.SelectedDistributor.Id === null) {
							needDistributor = true
						}
					})
				}
				return needDistributor
			},
			// 动态判断是否有自营商家
			hasSelfMerchant: function() {
				const that = this
				var hasSelf = false
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						if(shop.Merchant.SelfEmployed === true) {
							hasSelf = true
						}
					})
				}
				return hasSelf
			},
			// 动态获取自营商品领取柜台信息
			selfFrontendInfo: function() {
				const that = this
				var frontendInfo = null
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						if(shop.Merchant.SelfEmployed === true) {
							frontendInfo = shop.Merchant.SelectedFrontEnd
						}
					})
				}
				return frontendInfo
			},
			// 动态获取经销商服务中心领取信息
			selfDistributorId: function() {
				const that = this
				var distributorInfo = null
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						if(shop.Merchant.SelfEmployed === true) {
							distributorInfo = shop.Merchant.SelectedDistributor
						}
					})
				}
				return distributorInfo
			},
			// 动态获取自营商品配送方式
			selectedShippingMethod: function() {
				const that = this
				var shippingMethod = null
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						if(shop.Merchant.SelfEmployed === true) {
							shippingMethod = shop.Merchant.SelectedTransportMethodDic.Value
						}
					})
				}
				return shippingMethod
			},
			// 组装商品信息
			productDic: function() {
				const that = this
				var productDic = []
				if(that.order_confirm !== null) {
					// 组装商品参数、商家信息、配送方式等
					that.order_confirm.CartProductList.forEach(function(shop) {
						shop.OrderMerchantProducts.forEach(function(item) {
							console.log('product item', item)
							productDic[item.Id] = item.Quantity
						})
					})
				}
				return productDic
			},
			// 订单总价
			totalAmount: function() {
				const that = this
				var total = 0.0
				if(that.order_confirm !== null) {
					that.order_confirm.CartProductList.forEach(function(shop) {
						console.log('total Amount', shop)
						shop.OrderMerchantProducts.forEach(function(product) {
							console.log('total product', product)
							total = that.accAdd(total, product.ProductAmount) // 商品总价
						})
						// 如果已经选择了配送方式，则需要算入运费和税费
						total = that.accAdd(total, shop.Merchant.Freight) // 运费
						total = that.accAdd(total, shop.Merchant.Tax) //税费
					})
				}
				return total
			}
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				if(that.plusReady) {
					// 新意图事件
					document.addEventListener('newintent', that.onNewIntent, false)
					// 运行环境从前台切换到后台事件
					document.addEventListener('pause', that.onPause, false)
					// 运行环境从后台切换到前台事件，处理支付回调操作
					document.addEventListener('resume', that.onResume, false)
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
				that.fromType = query.fromType
				console.log('query', query)
				if(that.fromType === 'cart') {
					var salesArea = query.salesArea
					var productDic = JSON.parse(query.productDicStr)
					console.log('salesArea', salesArea)
					console.log('productDic', productDic)
					// 获取订单结算信息
					that.onOrderConfirm(query.salesArea, query.productDicStr)
					// 获取支付方式
					//that.getPaymentWay(query.salesArea)
					// 需要清除选中的物流地址
					// 设置选中的地址信息
					that.$store.dispatch('setOrderConfirmAddress', {
						address: null
					}).then(() => {})
				} else if(that.fromType === 'address') {
					// 计算运费
					that.order_confirm.CartProductList.forEach(function(shop) {
						that.countFreightTax(shop)
					})
					// 防止累计个人购货BV被重置
					that.totalSalesBV = that.order_confirm.TotalSalesBV
				}
				// 如果是企业类型用户，则发票类型只能是公司发票（3），前端显示为：电子发票，如果是个人类型会员，则发票类型有：电子发票（1），捐赠（2）
				if(that.user.IsCompanyAgent) {
					that.$store.dispatch('setInvoiceType', {
						invoiceType: 3
					})
				}
			})
		},
		methods: {
			onNewIntent: function() {
				const that = this
				if(that.plusReady) {
					if(that.newIntent === false) {
						that.newIntent = true
						that.checkPayResult(window.plus.runtime.arguments)
					}
				}
			},
			onResume: function() {
				const that = this
				console.log('onResume')
				if(that.plusReady) {
					if(that.resume === false) {
						that.resume = true
						//that.checkPayResult(window.plus.runtime.arguments)
					}
				}
			},
			onPause: function() {
				const that = this
				// 应用从前台进去后台
				that.resume = false
				that.newIntent = false
			},
			routeBack: function() {
				const that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					that.$f7.mainView.router.load({
						url: '/cart/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			// 检查支付结果
			checkPayResult: function(args) {
				console.log('checkPayResult')
				//alert('checkPayResult = ' + args)
				const that = this
				if(that.paying === true) {
					if(args) {
						var parseResult = that.$$.parseUrlQuery(args)
						if(parseResult !== null) {
							if(parseResult.isPaySuccess === 'True') {
								// 网关支付结果回调支付成功的，清空购物车
								that.onClearCart()
								console.log('parseResult', parseResult)
								var linkTransactionIdArr = parseResult.linkTransactionId.split(',')
								console.log('linkTransactionIdArr', linkTransactionIdArr)
								console.log('linkTransactionIdArr length', linkTransactionIdArr.length)
								console.log('linkTransactionIdArr[0]', linkTransactionIdArr[0])
								// 支付成功，没有拆单，直接跳转到订单详情
								if(linkTransactionIdArr.length === 1) {
									that.$f7.alert(that.$t('app.order_confirm.pay_success'), '', function() {
										that.$f7.mainView.router.load({
											url: `/order_details/?orderNo=${linkTransactionIdArr[0]}`
										})
									})
								} else {
									// 有拆单，则跳转到订单列表
									that.$f7.alert(that.$t('app.order_confirm.pay_success'), '', function() {
										that.$f7.mainView.router.load({
											url: '/order'
										})
									})
								}
							} else {
								// 支付失败
								that.$f7.alert(that.$t('app.order_confirm.pay_fail') + parseResult.displayMessage, '', function() {
									that.$f7.mainView.router.load({
										url: '/order'
									})
								})
							}
						}
					} else {
						that.$f7.showPreloader(that.$t('app.order_confirm.checking_pay_result'))
						setTimeout(function() {
							that.$f7.hidePreloader()
							that.$f7.mainView.router.load({
								url: '/order'
							})
						}, 2000)
					}
					that.paying = false
				}
			},
			onHelpPay: function() {
				const that = this
				that.helpPay = !that.helpPay
			},
			// 检查订单接收者编号资格检测
			CheckAgentInfoAndOrganization: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.order_confirm.checking'))
				axios.get('Deals/Account/CheckAgentInfoAndOrganization', {
					params: {
						loginId: that.helpLoginId,
						salesArea: that.order_confirm.SalesArea
					}
				}).then(res => {
					that.$f7.hidePreloader()
					console.log('CheckAgent', res)
					if(res.IsSuccess === true) {
						that.helpFullName = res.Data.AgentFullName
						that.totalSalesBV = res.Data.TotalSalesBV
					} else {
						that.helpLoginId = ''
						that.helpFullName = ''
						that.totalSalesBV = that.order_confirm.TotalSalesBV
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			// 获取支付方式
			getPaymentWay: function(salesArea) {
				const that = this
				console.log('getPaymentWay salesArea', salesArea)
				that.$store.dispatch('getPaymentWay', {
					salesArea: salesArea,
				}).then(() => {
					console.log('paymentway', that.paymentWay)
				})
			},
			// 获取订单结算数据
			onOrderConfirm: function(salesArea, productDicStr) {
				const that = this
				that.$f7.showPreloader(that.$t('app.order_confirm.loading'))
				var productDicList = JSON.parse(productDicStr)
				var productDic = {}
				// 组装商品参数
				productDicList.forEach(function(item) {
					console.log('product item', item)
					productDic[item.Id] = item.Quantity
				})
				axios.post('Deals/ShoppingCart/CartProductConfirm', {
					'SalesArea': salesArea,
					'ProductDic': productDic
				}).then(res => {
					console.log('action orderConfirm', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						var orderConfirm = res.Data
						// 设置默认选中的配送方式
						orderConfirm.CartProductList.forEach(function(shop) {
							// 默认情况下没选中配送方式
							shop.Merchant.SelectedTransportMethodDic = {
								Text: that.$t('app.order_confirm.choice_shipping_method'),
								Value: ''
							}
							// 商户选中柜台领取信息
							shop.Merchant.SelectedFrontEnd = {
								Id: null,
								Name: '',
								Address: ''
							}
							// 商户选中服务中心领取信息
							shop.Merchant.SelectedDistributor = {
								Id: null,
								Name: '',
								Address: ''
							}
							// 物流配送地址信息 或 服务中心物流输送地址信息
							shop.Merchant.addressInfo = null
							// 商户的运费和税费
							shop.Merchant.Freight = 0
							shop.Merchant.Tax = 0
							if(shop.Merchant.SelfEmployed === true) {} else {
								// 第三方自己组装配送方式列表
								var shippingMethodList = []
								Object.keys(shop.Merchant.TransportMethodDic).forEach(function(key, value) {
									console.log('key', key)
									console.log('value', shop.Merchant.TransportMethodDic[key])
									shippingMethodList.push({
										Text: shop.Merchant.TransportMethodDic[key],
										Value: key
									})
								})
								shop.Merchant.ShippingMethodList = shippingMethodList
							}
							// 默认不打开选择配送方式下拉列表
							shop.showShippingMethod = true
							// 设置自营店的默认配送方式
							shop.Merchant.SelectedTransportMethodDic = {
								Text: shop.Merchant.ShippingMethodList[0].Text,
								Value: shop.Merchant.ShippingMethodList[0].Value
							}
						})
						console.log('成功获取订单确认信息')
						that.$store.dispatch('orderConfirm', {
							orderConfirm: orderConfirm
						}).then(() => {
							that.totalSalesBV = that.order_confirm.TotalSalesBV
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			accAdd: function(arg1, arg2) {
				if(isNaN(arg1)) {
					arg1 = 0
				}
				if(isNaN(arg2)) {
					arg2 = 0
				}
				arg1 = Number(arg1)
				arg2 = Number(arg2)
				var r1
				var r2
				var m
				var c
				try {
					r1 = arg1.toString().split('.')[1].length
				} catch(e) {
					r1 = 0
				}
				try {
					r2 = arg2.toString().split('.')[1].length
				} catch(e) {
					r2 = 0
				}
				c = Math.abs(r1 - r2)
				m = Math.pow(10, Math.max(r1, r2))
				if(c > 0) {
					var cm = Math.pow(10, c)
					if(r1 > r2) {
						arg1 = Number(arg1.toString().replace('.', ''))
						arg2 = Number(arg2.toString().replace('.', '')) * cm
					} else {
						arg1 = Number(arg1.toString().replace('.', '')) * cm
						arg2 = Number(arg2.toString().replace('.', ''))
					}
				} else {
					arg1 = Number(arg1.toString().replace('.', ''))
					arg2 = Number(arg2.toString().replace('.', ''))
				}
				return(arg1 + arg2) / m
			},
			// 切换发票类型
			onSwitchInvoice: function(invoiceType) {
				const that = this
				that.$store.dispatch('setInvoiceType', {
					invoiceType: invoiceType
				})
			},
			onShowInvoiceType: function() {
				console.log('onShowInvoiceType')
				const that = this
				that.showInvoiceType = !that.showInvoiceType
			},
			// 计算运费和税费
			countFreightTax: function(shop) {
				console.log('countFreightTax', shop)
				const that = this
				var productDic = {}
				// 组装商品参数
				shop.OrderMerchantProducts.forEach(function(item) {
					console.log('product item', item)
					productDic[item.Id] = item.Quantity
				})
				var value = shop.Merchant.SelectedTransportMethodDic.Value
				if(value === '') {
					return false
				}

				// 判断是否已经选择了对应配送方式所需的条件，例如： frontend、 express、distributor、distributorExpress
				if(value === 'frontend' && shop.Merchant.SelectedFrontEnd.Id === null) {
					return false
				}
				if(value === 'express' && that.order_confirm_address === null) {
					return false
				}
				if(value === 'distributor' && shop.Merchant.SelectedDistributor.Id === null) {
					return false
				}
				if(value === 'distributorExpress' && (shop.Merchant.SelectedDistributor.Id === null || that.order_confirm_address === null)) {
					return false
				}

				console.log('before Cart preview value', value)
				// 计算运费post参数
				var ownerLoginId = that.order_confirm.OwnerAgentLoginId
				// 如果是代下线会员购买，则需要更改订单所属会员编号
				if(that.helpPay && that.helpLoginId.length === 8) {
					ownerLoginId = that.helpLoginId
				}

				var postData = {
					SalesArea: that.order_confirm.SalesArea,
					OwnerLoginId: ownerLoginId,
					Products: productDic
				}

				var OrderMerchants = {}
				// 自营
				if(shop.Merchant.SelfEmployed) {
					if(value === 'frontend') {
						// 柜台自提
						postData.OrderMerchants = {
							BranchCompanyFrontendId: shop.Merchant.SelectedFrontEnd.Id,
							TransportModel: 1
						}
					} else if(value === 'express') {
						// 物流输送
						postData.OrderMerchants = {
							TransportModel: 2
						}
						postData.AddressId = that.order_confirm_address.Id
					} else if(value === 'distributor') {
						// 服务中心自提
						postData.OrderMerchants = {
							DistributorId: shop.Merchant.SelectedDistributor.Id,
							TransportModel: 3
						}
					} else if(value === 'distributorExpress') {
						// 服务中心物流输送
						postData.OrderMerchants = {
							TransportModel: 4,
							DistributorId: shop.Merchant.SelectedDistributor.Id
						}
						postData.AddressId = that.order_confirm_address.Id
					}
				} else {
					// 第三方目前只有柜台自提和物流输送方式
					if(value === 'frontend') {
						// 柜台自提
						postData.OrderMerchants = {
							TransportModel: 1,
							MerchantId: shop.Merchant.Id,
							MerchantFrontendId: shop.Merchant.SelectedFrontEnd.Id
						}
					} else if(value === 'express') {
						// 物流输送
						postData.OrderMerchants = {
							TransportModel: 2,
							MerchantId: shop.Merchant.Id,
						}
						postData.AddressId = that.order_confirm_address.Id
					}
				}
				console.log('before cart preview post', postData)
				// 计算运费
				axios.post('Deals/ShoppingCart/MerchantCartPreview',
					postData
				).then(res => {
					console.log('MerchantCartPreview res', res)
					if(res.IsSuccess === true) {
						shop.Merchant.Freight = res.Data.GrandTotalFreight
						shop.Merchant.Tax = res.Data.GrandTotalTax
					} else {
						// 商户的运费和税费
						shop.Merchant.Freight = 0
						shop.Merchant.Tax = 0
						shop.Merchant.SelectedTransportMethodDic = {
							Text: that.$t('app.order_confirm.choice_shipping_method'),
							Value: ''
						}
						shop.Merchant.SelectedFrontEnd = {
							Id: null,
							Name: '',
							Address: ''
						}
						shop.Merchant.SelectedDistributor = {
							Id: null,
							Name: '',
							Address: ''
						}
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			// 显示选择配送方式列表
			onShowShippingDetailsModal: function(shop, text, value) {
				// 选择配送方式之后详情信息
				const that = this
				console.log('onShowShippingDetailsModal', shop)
				console.log('shipping text', text)
				console.log('shipping value', value)
				// 如果是物流配送或者服务中心物流输送，需要可以选择配送地址
				if(value === 'express') {
					shop.Merchant.SelectedTransportMethodDic = {
						Text: text,
						Value: value
					}
					// 如果已经选过物流输送地址，则进行运费税费计算
					if(that.needAddress && that.order_confirm_address !== null) {
						that.countFreightTax(shop)
					}
					return false
				}

				var template = ''
				// 自营的处理方式
				if(shop.Merchant.SelfEmployed === true) {
					// 柜台领取
					if(value === 'frontend') {
						template += '<ul>'
						shop.Merchant.FrontEndList.forEach(function(item, index) {
							// 默认选中第一项或已经选中的项
							var active = ''
							if(shop.Merchant.SelectedFrontEnd.Id !== null && shop.Merchant.SelectedFrontEnd.Id === item.Id) {
								active = 'active'
							} else if(index === 0) {
								active = 'active'
							}
							var liTemp = `<li data-id='{0}' data-name='{1}' data-address='{2}' class='item-content {5}'>
													<div class='item-inner'>
														<div class='item-title'>
															<span>{3}</span>
															<span>{4}</span>
														</div>
													</div>
												 </li>`
							template += liTemp.format(item.Id, item.Name, item.Address, item.Name, item.Address, active)
						})
						template += '</ul>'
					} else if(value === 'distributor' || value === 'distributorExpress') {
						// 服务中心领取
						template += '<ul>'
						shop.Merchant.DistributorList.forEach(function(item, index) {
							var active = ''
							if(shop.Merchant.SelectedDistributor.Id !== null && shop.Merchant.SelectedDistributor.Id === item.Id) {
								active = 'active'
							} else if(index === 0) {
								active = 'active'
							}
							var liTemp = `<li data-id='{0}' data-name='{1}' data-address='{2}' class='item-content {5}'>
													<div class='item-inner'>
														<div class='item-title'>
															<span>{3}</span>
															<span>{4}</span>
														</div>
													</div>
												 </li>`
							template += liTemp.format(item.Id, item.DistributorCode, item.DistributorAddress, item.DistributorCode, item.DistributorAddress, active)
						})
						template += '</ul>'
					}
				} else {
					// 第三方商家
					// 柜台领取
					if(value === 'frontend') {
						template += '<ul>'
						shop.Merchant.MerchantFronts.forEach(function(item, index) {
							// 默认选中第一项或已经选中的项
							var active = ''
							if(shop.Merchant.SelectedFrontEnd.Id !== null && shop.Merchant.SelectedFrontEnd.Id === item.Id) {
								active = 'active'
							} else if(index === 0) {
								active = 'active'
							}
							var liTemp = `<li data-id='{0}' data-name='{1}' data-address='{2}' class='item-content {5}'>
													<div class='item-inner'>
														<div class='item-title'>
															<span>{3}</span>
															<span>{4}</span>
														</div>
													</div>
												 </li>`
							template += liTemp.format(item.Id, item.Name, item.Address, item.Name, item.Address, active)
						})
						template += '</ul>'
					}
				}

				that.$f7.modal({
					title: text,
					text: `<div class="shipping-list list-block">
								` + template + `
							</div>`,
					buttons: [{
						text: that.$t('app.modal.button_ok'),
						onClick: function() {
							console.log('onClick method details')
							// 输出选中的一项的信息
							var selectedItem = that.$$('.shipping-list li.active')
							var frontendId = that.$$(selectedItem).data('id')
							var name = that.$$(selectedItem).data('name')
							var address = that.$$(selectedItem).data('address')
							console.log('selected frontendId', frontendId)
							console.log('selected name', name)
							console.log('selected address', address)
							// 如果有选中某个柜台自取 柜台领取 或 服务中心领取
							if(frontendId) {
								if(value === 'frontend') {
									// 商户选中柜台领取信息
									shop.Merchant.SelectedFrontEnd = {
										Id: frontendId,
										Name: name,
										Address: address
									}
								} else if(value === 'distributor' || value === 'distributorExpress') {
									// 商户选中服务中心领取信息
									shop.Merchant.SelectedDistributor = {
										Id: frontendId,
										Name: name,
										Address: address
									}
								}
								// 如果选择了服务中心物流输送，但是还没有选择物流输送地址，则先不进行运费计算
								if(value === 'distributorExpress' && that.order_confirm_address === null) {
									return false
								}
								// 计算运费及税费
								that.countFreightTax(shop)
								//that.$f7.alert(address)
							} else {
								//								shop.Merchant.SelectedTransportMethodDic = {
								//									Text: '请选择配送方式',
								//									Value: ''
								//								}
								//								if(value === 'frontend') {
								//									that.$f7.alert('请选择柜台')
								//								} else if(value === 'distributor') {
								//									that.$f7.alert('请选择服务中心')
								//								}
							}
						}
					}, ]
				})
				// 点击选中柜台领取地址
				that.$$('.shipping-list li').on('click', function() {
					console.log('click li')
					var id = that.$$(this).data('id')
					console.log('shipping item id', id)
					that.$$(this).addClass('active')
					that.$$(this).siblings('li').removeClass('active')
				})
			},
			// 选择配送方式
			onSelectTransportMethod: function(shop, text, value) {
				console.log('onSelectTransportMethod', text + ':' + value)
				const that = this
				that.onShowShippingDetailsModal(shop, text, value)
				shop.Merchant.SelectedTransportMethodDic = {
					Text: text,
					Value: value
				}
			},
			onChoiceAddr() {
				const that = this
				that.$f7.mainView.router.load({
					url: '/address/?fromType=order_confirm'
				})
			},
			// 弹出选择支付方式
			onShowPaymentWayModal: function() {
				const that = this
				// 弹出选择支付方式
				var template = '<ul>'
				that.paymentWay.forEach(function(item, index) {
					console.log('payment way item', item)
					console.log('payment way index', index)
					// 默认选中第一个
					var active = ''
					if(index === 0) {
						active = 'active'
					}

					var balance = ''
					if(!(item.PaymentMethodValue === 'CreditCard' || item.PaymentMethodValue === 'Paypal' || item.PaymentMethodValue === 'AgentTrade')) {
						if(item.PaymentMethodValue === 'EP2') {
							balance = that.$t('app.order_confirm.balance') + item.CurrencyCode + ' ' + item.WalletBalance
						} else {
							balance = that.$t('app.order_confirm.balance') + item.WalletBalance
						}
					}

					var liTemp = `<li data-text='{0}' data-value='{1}' class='item-content {2}'>
									<div class='item-inner'>
										<div class='item-title' style="width: 100%;">
											<span style="float: left; ">{0}</span><span style="float: right;">{3}</span>
										</div>
									</div>
								 </li>`
					template += liTemp.format(item.PaymentMethodName, item.PaymentMethodValue, active, balance)
				})
				template += '</ul>'

				// 弹出选择支付方式
				that.$f7.modal({
					title: that.$t('app.order_confirm.payment'),
					text: `<div class="paymentway-list list-block">
								` + template + `
							</div>`,
					buttons: [{
						text: that.$t('app.modal.button_ok'),
						onClick: function() {
							console.log('onClick method details')
							// 输出选中的一项的信息
							var selectedItem = that.$$('.paymentway-list li.active')
							var text = that.$$(selectedItem).data('text')
							var value = that.$$(selectedItem).data('value')
							console.log('selected text', text)
							console.log('selected value', value)
							that.paymentMethod = value
							if(value === 'EP2' || value === 'EP3') {
								// 使用EP2或EP3，需要输入支付密码
								that.onShowPasswordInputModal()
							} else if(value === 'AgentTrade') {
								// 好友代付
								that.onShowAgentTradeModal()
							} else if(value === 'CreditCard') {
								//that.onShowCCTermTypeModal()
								if(that.user.BranchCompanyId === 1) {
									// 马来西亚信用卡类型（"MasterCard" 或者 "VISA"）
									that.onShowCreditCardTypeModal()
									return false
								}
								if(that.user.BranchCompanyId === 4) {
									//台湾信用卡分期类型（不分期 ："noTerm"; 3期： "term3"; 12期："term12"）
									that.onShowCCTermTypeModal()
									return false
								}
								// 提交订单并支付
								that.onSubmit()
							} else {
								// 提交订单并支付
								that.onSubmit()
							}
						}
					}, ]
				})
				// 点击选中支付方式
				that.$$('.paymentway-list li').on('click', function() {
					console.log('paymentway click li')
					var text = that.$$(this).data('text')
					console.log('shipping item text', text)
					that.$$(this).addClass('active')
					that.$$(this).siblings('li').removeClass('active')
				})
			},
			// 弹出选择信用卡类型
			onShowCreditCardTypeModal: function() {
				const that = this
				// 弹出选择支付方式
				var template = '<ul>'
				var liTemp = `<li data-text='{0}' data-value='{1}' class='item-content {2}'>
									<div class='item-inner'>
										<div class='item-title'>
											{0}
										</div>
									</div>
								 </li>`
				template += liTemp.format('MasterCard', 'MasterCard', 'active')
				template += liTemp.format('VISA', 'VISA', '')
				template += '</ul>'
				// 弹出选择支付方式
				that.$f7.modal({
					title: that.$t('app.order_confirm.credit_card_type'),
					text: `<div class="creditCardType-list list-block">
								` + template + `
							</div>`,
					buttons: [{
						text: that.$t('app.modal.button_ok'),
						onClick: function() {
							console.log('onClick method details')
							// 输出选中的一项的信息
							var selectedItem = that.$$('.creditCardType-list li.active')
							var text = that.$$(selectedItem).data('text')
							var value = that.$$(selectedItem).data('value')
							console.log('selected text', text)
							console.log('selected value', value)
							that.creditCardType = value
							that.onSubmit()
						}
					}, ]
				})
				// 点击选中支付方式
				that.$$('.creditCardType-list li').on('click', function() {
					console.log('paymentway click li')
					var text = that.$$(this).data('text')
					console.log('shipping item text', text)
					that.$$(this).addClass('active')
					that.$$(this).siblings('li').removeClass('active')
				})
			},
			// 弹出信用卡分期类型
			onShowCCTermTypeModal: function() {
				const that = this
				var template = '<ul>'
				var liTemp = `<li data-text='{0}' data-value='{1}' class='item-content {2}'>
									<div class='item-inner'>
										<div class='item-title'>
											{0}
										</div>
									</div>
								 </li>`
				template += liTemp.format(that.$t('app.order_confirm.noTerm'), 'noTerm', 'active')
				template += liTemp.format(that.$t('app.order_confirm.term3'), 'term3', '')
				template += liTemp.format(that.$t('app.order_confirm.term12'), 'term12', '')
				template += '</ul>'
				// 弹出选择支付方式
				that.$f7.modal({
					title: that.$t('app.order_confirm.credit_cards_periods'),
					text: `<div class="cCTermType-list list-block">
								` + template + `
							</div>`,
					buttons: [{
						text: that.$t('app.modal.button_ok'),
						onClick: function() {
							console.log('onClick method details')
							// 输出选中的一项的信息
							var selectedItem = that.$$('.cCTermType-list li.active')
							var text = that.$$(selectedItem).data('text')
							var value = that.$$(selectedItem).data('value')
							console.log('selected text', text)
							console.log('selected value', value)
							that.cCTermType = value
							that.onSubmit()
						}
					}, ]
				})
				// 点击选中支付方式
				that.$$('.cCTermType-list li').on('click', function() {
					console.log('paymentway click li')
					var text = that.$$(this).data('text')
					console.log('shipping item text', text)
					that.$$(this).addClass('active')
					that.$$(this).siblings('li').removeClass('active')
				})
			},
			// 弹出输入密码框
			onShowPasswordInputModal: function() {
				const that = this
				that.$f7.modalPassword(that.$t('app.order_confirm.input_wallet_password'), function(password) {
					console.log('password', password)
					if(password.trim().length === 0) {
						that.$f7.alert(that.$t('app.order_confirm.input_wallet_password'))
						that.securityPassword = ''
					} else {
						that.securityPassword = password
						that.onSubmit()
					}
				})
			},
			// 弹出输入代付好友编号
			onShowAgentTradeModal: function() {
				const that = this
				that.$f7.prompt(that.$t('app.order_confirm.input_friend_id'), function(value) {
					if(value.trim().length === 0) {
						that.$f7.alert(that.$t('app.order_confirm.input_friend_id'))
					} else {
						// 验证代付好友编号
						axios.get('Deals/Account/CheckAgentTradeInfo', {
							params: {
								loginId: value,
								salesArea: that.order_confirm.SalesArea
							}
						}).then(res => {
							console.log('CheckAgentTradeInfo', res)
							if(res.IsSuccess === true) {
								// 好友代付编号
								that.helpPayLoginId = value
								that.onSubmit()
							} else {
								that.helpPayLoginId = ''
								that.$f7.alert(res.ErrorInfos[0].Message)
							}
						})
					}
				})
			},
			// 点击支付按钮
			onPay() {
				const that = this
				// 判断是否代下线购买但是没有填写会员编号的
				if(that.helpPay === true && that.helpLoginId.length !== 8) {
					that.$f7.alert(that.$t('app.order_confirm.input_correct_id'))
					return false
				}
				// 会员购货专区，需要判断首单验证
				if(that.user_type === 1 && that.order_confirm.SalesArea === 1) {
					// 如果是当前会员自己购买，则需要判断是否可以进行购货
					if(that.helpPay === false && that.user.PackageId === 2) {
						that.$f7.alert(that.$t('app.order_confirm.star2_big_agent_limit'))
						return false
					}
					// 判断是否代下线会员购买
					var loginId = that.user.LoginId
					if(that.helpPay === true && that.helpLoginId.trim().length === 8) {
						loginId = that.helpLoginId
					}
					// 进行首单验证，传入当前要结算的商品的BV总和
					axios.get('Deals/Account/CheckFirstOrderBVInfo', {
						params: {
							loginId: loginId,
							totalBV: that.order_confirm.TotalBV
						}
					}).then(res => {
						console.log('CheckAgentTradeInfo', res)
						if(res.IsSuccess === true) {
							that.onCheckPayable()
						} else {
							that.$f7.alert(res.ErrorInfos[0].Message)
						}
					})
				} else {
					that.onCheckPayable()
				}
			},
			onCheckPayable: function() {
				const that = this
				// 检查是否可以支付
				// 判断是否有未选择配送方式的
				var canPay = true
				that.order_confirm.CartProductList.forEach(function(shop) {
					if(shop.Merchant.SelectedTransportMethodDic.Value === '') {
						canPay = false
					}
				})

				if(canPay === false) {
					that.$f7.alert(that.$t('app.order_confirm.choice_shipping_method'))
					return false
				}

				if(that.needFrontend === true) {
					that.$f7.alert(that.$t('app.order_confirm.choice_frontend'))
					return false
				}

				if(that.needDistributor === true) {
					that.$f7.alert(that.$t('app.order_confirm.choice_distributor_frontend'))
					return false
				}

				if(that.needAddress === true && that.order_confirm_address === null) {
					that.$f7.alert(that.$t('app.order_confirm.choice_address'))
					return false
				}

				//				if(that.paymentWay === null) {
				//					that.$f7.alert(that.$t('app.order_confirm.payment_way_error'))
				//					return false
				//				}

				that.$f7.showPreloader(that.$t('app.order_confirm.loading_payment_way'))
				// 实时获取支付方式
				axios.get('Deals/Common/GetPaymentWayBySalesArea', {
					params: {
						SalesArea: that.order_confirm.SalesArea
					}
				}).then(res => {
					if(res.IsSuccess === true) {
						setTimeout(function() {
							that.$f7.hidePreloader()
							that.paymentWay = res.Data
							// 弹出选择支付方式框
							that.onShowPaymentWayModal()
						}, 300)
					} else {
						that.$f7.hidePreloader()
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			// 提交下单并支付
			onSubmit: function() {
				console.log('onSubmit')
				const that = this
				console.log('shippingMethodArr', that.shippingMethodArr['frontend'])
				// 如果是代付订单，这里需要注意订单所属会员编号
				var ownerLoginId = that.order_confirm.OwnerAgentLoginId
				if(that.helpPay && that.helpLoginId.length === 8) {
					ownerLoginId = that.helpLoginId
				}
				// 商品参数数组
				var productDic = {}
				// 请求数据，公共参数
				var postData = {
					SalesArea: that.order_confirm.SalesArea,
					OwnerLoginId: ownerLoginId,
					PaymentMethod: that.paymentMethod,
				}

				// 如果是台湾窗口，则需要填写发票类型
				if(that.user.BranchCompanyId === 4) {
					postData.InvoiceType = that.invoiceType
				}

				if(that.paymentMethod === 'EP2' || that.paymentMethod === 'EP3') {
					// EP2 EP3 需要支付密码
					postData.SecurityPassword = that.securityPassword
				} else if(that.paymentMethod === 'AgentTrade') {
					// 订单代付会员编号
					postData.HelpPayLoginId = that.helpPayLoginId
				} else if(that.paymentMethod === 'CreditCard') {
					// 信用卡支付，马来西亚需要传入 CreditCardType  马来西亚信用卡类型（"MasterCard" 或者 "VISA"）
					if(that.user.BranchCompanyId === 1) {
						postData.CreditCardType = that.creditCardType
					}
					// 信用卡支付，台湾信用卡分期类型（不分期 ："noTerm"; 3期： "term3"; 12期："term12"）
					if(that.user.BranchCompanyId === 4) {
						postData.CCTermType = that.cCTermType
					}
					postData.CallbackUrl = that.callbackUrl
				} else if(that.paymentMethod === 'Paypal') {
					postData.CallbackUrl = that.callbackUrl
				}

				var shippingMethod = []
				var hasMerchant = false
				// 组装商品参数、商家信息、配送方式等
				that.order_confirm.CartProductList.forEach(function(shop) {
					shop.OrderMerchantProducts.forEach(function(item) {
						console.log('product item', item)
						productDic[item.Id] = item.Quantity
					})
					// 获取自营的参数
					if(shop.Merchant.SelfEmployed) {
						postData.SelectedShippingMethod = shop.Merchant.SelectedTransportMethodDic.Value
						if(shop.Merchant.SelectedTransportMethodDic.Value === 'frontend') {
							// 柜台自取id
							postData.SelfFrontendId = shop.Merchant.SelectedFrontEnd.Id
						} else if(shop.Merchant.SelectedTransportMethodDic.Value === 'distributor') {
							// 服务中心自取id
							postData.SelfDistributorId = shop.Merchant.SelectedDistributor.Id
						} else if(shop.Merchant.SelectedTransportMethodDic.Value === 'express') {
							// 物流地址输送
							postData.AddressId = that.order_confirm_address.Id
							// 物流地址输送，需要填写 ContactName 和 Telephone
							postData.ContactName = that.order_confirm_address.ContactName
							postData.Telephone = that.order_confirm_address.Telephone
						} else if(shop.Merchant.SelectedTransportMethodDic.Value === 'distributorExpress') {
							// 物流地址输送，还需要填写服务中心网点id ，需要填写 ContactName 和 Telephone
							postData.AddressId = that.order_confirm_address.Id
							postData.ContactName = that.order_confirm_address.ContactName
							postData.Telephone = that.order_confirm_address.Telephone
							postData.SelfDistributorId = shop.Merchant.SelectedDistributor.Id
						}
					} else {
						hasMerchant = true
						// 获取第三方商家的参数	
						var merchantShippingMethod = {
							Id: shop.Merchant.Id,
							ShippingMethod: shop.Merchant.SelectedTransportMethodDic.Value
						}
						// 如果是柜台自取，则需要填写
						if(shop.Merchant.SelectedTransportMethodDic.Value === 'frontend') {
							merchantShippingMethod.FrontEndId = shop.Merchant.SelectedFrontEnd.Id
						} else if(shop.Merchant.SelectedTransportMethodDic.Value === 'express') {
							// 物流地址输送，只要是物流输送的，都必须填写联系人和联系电话
							postData.AddressId = that.order_confirm_address.Id
							postData.ContactName = that.order_confirm_address.ContactName
							postData.Telephone = that.order_confirm_address.Telephone
						}
						shippingMethod.push(merchantShippingMethod)
					}
				})
				// 如果有第三方，则需要追加第三方的配送方式
				if(hasMerchant) {
					postData.ShippingMethod = shippingMethod
				}
				console.log('before Create OrderAndPay', that.productDic)
				// 追加商品数据
				postData.ProductDict = productDic
				console.log('before Create OrderAndPay', postData)
				that.$f7.showPreloader(that.$t('app.order_confirm.submitting'))
				axios.post('Deals/Order/CreateOrderAndPay',
					postData
				).then(res => {
					that.$f7.hidePreloader()
					console.log('CreateOrderAndPay res', res)
					if(res.IsSuccess === true) {
						console.log('支付返回正常')
						// EP2、EP3、好友代付，直接返回支付结果
						if(that.paymentMethod === 'EP2' || that.paymentMethod === 'EP3' || that.paymentMethod === 'AgentTrade') {
							var payResult = res.Data.PayResult
							if(payResult.PayResult === true) {
								console.log('支付成功', payResult)
								// 	清空购物车，使用电子货币购买的，直接可以判断支付结果的，支付成功之后，清空购物车
								that.onClearCart()
								// 支付成功，跳转到订单详情页面
								that.$f7.mainView.router.load({
									url: `/order_details/?orderNo=${payResult.MerchantOrders[0].OrderNo}`
								})
							} else {
								that.$f7.alert(payResult.Message)
							}
						} else if(that.paymentMethod === 'CreditCard' || that.paymentMethod === 'Paypal') {
							// 切换是否提交订单状态
							that.paying = true
							// 信用卡、Paypal需要跳转网关
							console.log('跳转到支付网关')
							if(that.plusReady) {
								// 关闭多余的弹出层
								that.$f7.closeModal()
								window.plus.runtime.openURL(res.Data.PayUrl)
							} else {
								window.open(res.Data.PayUrl)
							}
						}
					} else {
						// 切换是否提交订单状态
						that.paying = false
						console.log('支付出错了')
						that.$f7.alert(that.$t('app.order_confirm.pay_fail') + res.ErrorInfos[0].Message)
					}
				})
			},
			onShowShippingMethod(shop) {
				shop.showShippingMethod = !shop.showShippingMethod
			},
			// 清除指定购物车的指定商品
			onClearCart: function() {
				const that = this
				var idList = []
				that.order_confirm.CartProductList.forEach(function(shop) {
					shop.OrderMerchantProducts.forEach(function(item) {
						console.log('product item', item)
						idList.push(item.Id)
					})
				})
				// 清空购物车指定的商品
				axios.post('Deals/ShoppingCart/ClearCart', {
					SalesArea: that.order_confirm.SalesArea,
					IdList: idList
				}).then(res => {
					console.log('clear cart res', res)
				})
			}
		},
		components: {}
	}
</script>