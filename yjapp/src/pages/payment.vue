<template>
	<div data-page="payment" class="page payment-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.agent_pay')">代付列表</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content infinite-scroll">
			<div style="text-align: center;" v-if="order_list.length === 0">
				<p class="text-gradient" v-text="$t('app.agent_pay.no_have_order')">暂时没有订单</p>
			</div>
			<div class="list-block">
				<div class="pay-item" v-for="order in order_list">
					<ul v-for="salesOrder in order.SalesOrderCollection">
						<li>
							<div class="item-content">
								<div class="item-title clearfloat">
									<div class="order-title" v-text="$t('app.agent_pay.order_no')">订单号:</div>
									<div class="order-num" v-text="salesOrder.OrderNo">55555555</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-title clearfloat">
									<div class="order-num" v-text="salesOrder.MerchantName">55555555</div>
									<div class="order-state text-gradient" v-text="salesOrder.StatusDisplay">代付款</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-title clearfloat">
									<div class="order-title" v-text="$t('app.agent_pay.member_id')">会员编号</div>
									<div class="order-state" v-text="salesOrder.AgentLoginId">55555555</div>
								</div>
							</div>
						</li>
						<li>
							<div class="item-content">
								<div class="item-title clearfloat">
									<div class="order-title" v-text="$t('app.agent_pay.sales_order_type')">购货模式</div>
									<div class="order-state" v-text="salesOrder.SalesOrderTypeName">一般购货</div>
								</div>
							</div>
						</li>
						<!--<li>
							<a href="#" class="item-link item-content store">
								<div class="item-content">
									<div class="item-title clearfloat">
										<div class="store-name" v-text="salesOrder.MerchantName">億嘉國際</div>
										<div class="store-r">
											<div class="goods-num">共2件商品</div>
											<div class="money-text">合计</div>
											<div class="goods-money text-gradient" v-text="salesOrder.CurrencyCode + '' + salesOrder.TotalAmount">65,5<span class="money-s"></span> </div>
										</div>
									</div>
								</div>
							</a>
						</li>-->
					</ul>
					<ul v-if="order.CanPay === true">
						<li>
							<div class="clearfloat">
								<!--<div class="pay-btn-l">
									残忍拒绝
								</div>-->
								<div class="pay-btn-r" @click="onPay(order)" v-text="$t('app.agent_pay.pay_now')">
									果断付款
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.payment-page {
		.list-block {
			margin: 0;
			.pay-item {
				margin-bottom: 0.1rem;
				>ul {
					.item-content {
						width: 100%;
					}
					>li {
						border-bottom: 0.001rem solid #eee;
						padding: 0 0.3rem;
						padding-left: 0;
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
							color: #767676;
							letter-spacing: 0.71px;
							line-height: 0.44rem;
						}
					}
					.order-detail {
						width: 100%;
						height: 1.3rem;
						padding: 0.3rem 0;
						position: relative;
						.shop-img {
							width: 1.2rem;
							height: 1.2rem;
							// background: url(../../static/img/goods/ic_1@3x.png);
							margin-right: 0.3rem;
							display: inline-block;
							margin-left: 0.3rem;
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
					.store {
						padding-left: 0;
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
						.money-text {
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
						/*background: url(../../static/icon/list_btn_Refuse_nor@3x.png);*/
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
					.pay-btn-r {
						float: right;
						background: url(../../static/icon/list_btn_payment_nor@3x.png);
						display: inline-block;
						width: 3.3rem;
						background-size: 100%;
						height: 0.8rem;
						line-height: 0.8rem;
						text-align: center;
						font-family: PingFangSC-Regular;
						font-size: 0.28rem;
						color: #FFFFFF;
						letter-spacing: 0.82px;
						margin: 0.1rem 0;
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
	export default {
		data() {
			return {
				order_list: [],
				currentPage: 1, // 当前页码
				pageSize: 20, // 每页订单数，默认20
				lastPage: false, // 是否是最后一页，拉取订单数据没有返回数据时，设置为true
				loading: false, // 当前是否处于加载状态
				paymentMethod: '', // 支付方式  （1. EP2："EP2"； 2. EP3："EP3"；3. 信用卡："CreditCard"； 4. Paypal："Paypal"； 5. 好友代付："AgentTrade"）
				securityPassword: '', // 支付密码
				callbackUrl: 'yijia://', // 支付回调协议， 3. 信用卡："CreditCard"； 4. Paypal："Paypal" 必须
				creditCardType: '', // 信用卡类型：马来西亚窗口信用卡类型（"MasterCard" 或者 "VISA"）
				cCTermType: '', // 台湾窗口信用卡分期类型（不分期 ："noTerm"; 3期： "term3"; 12期："term12"）
				currentOrder: null, // 当前要付款的订单
				resume: false, // 应用从后台返回前台
				newIntent: false, // 是否接受新意图事件
				paying: false, // 是否正在提交支付
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				user_type: state => state.user_type,
			})
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
				that.getAgentPayList()
				// 监听无限滑动时间
				that.$$('.infinite-scroll').on('infinite', function() {
					console.log('infinite')
					that.getAgentPayList()
				})
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
			// 检查支付结果
			checkPayResult: function(args) {
				console.log('checkPayResult')
				const that = this
				if(that.paying === true) {
					if(args) {
						var parseResult = that.$$.parseUrlQuery(args)
						if(parseResult !== null) {
							if(parseResult.isPaySuccess === 'True') {
								// 支付成功
								that.$f7.alert(that.$t('app.agent_pay.pay_success'))
								that.updateCurrentOrder()
							} else {
								// 支付失败
								that.$f7.alert(that.$t('app.agent_pay.pay_fail') + parseResult.displayMessage, '', function() {})
							}
						}
					} else {
						that.$f7.showPreloader(that.$t('app.agent_pay.checking_pay_result'))
						setTimeout(function() {
							that.$f7.hidePreloader()
						}, 2000)
					}
					that.paying = false
				}
			},
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
			// 弹出选择信用卡类型
			onShowCreditCardTypeModal: function(creditCardType) {
				console.log('onShowCreditCardTypeModal', creditCardType)
				const that = this
				// 弹出选择支付方式
				var template = '<ul>'
				creditCardType.forEach(function(item, index) {
					var active = ''
					if(index === 0) {
						active = 'active'
					}
					var liTemp = `<li data-text='{0}' data-value='{1}' class='item-content {2}'>
									<div class='item-inner'>
										<div class='item-title'>
											{0}
										</div>
									</div>
								 </li>`
					template += liTemp.format(item.Text, item.Value, active)
				})
				template += '</ul>'
				// 弹出选择支付方式
				that.$f7.modal({
					title: that.$t('app.agent_pay.credit_card_type'),
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
			onShowCCTermTypeModal: function(periods) {
				const that = this
				var template = '<ul>'
				periods.forEach(function(item, index) {
					console.log('period item', item)
					var active = ''
					if(index === 0) {
						active = 'active'
					}
					var liTemp = `<li data-text='{0}' data-value='{1}' class='item-content {2}'>
									<div class='item-inner'>
										<div class='item-title'>
											{0}
										</div>
									</div>
								 </li>`
					template += liTemp.format(item.Text, item.Value, active)
				})
				template += '</ul>'
				// 弹出选择支付方式
				that.$f7.modal({
					title: that.$t('app.agent_pay.credit_cards_periods'),
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
				that.$f7.modalPassword(that.$t('app.agent_pay.input_wallet_password'), function(password) {
					console.log('password', password)
					if(password.trim().length === 0) {
						that.$f7.alert(that.$t('app.agent_pay.input_wallet_password'))
						that.securityPassword = ''
					} else {
						that.securityPassword = password
						that.onSubmit()
					}
				})
			},
			onPay: function(order) {
				console.log('onPay', order)
				const that = this
				that.currentOrder = order
				that.$f7.showPreloader(that.$t('app.agent_pay.loading_payment_way'))
				// 获取代付订单的支付方式
				axios.get('Member/AgentTrade/Behalf', {
					params: {
						tradeId: order.TradeId
					}
				}).then(res => {
					console.log('behalf res', res)
					if(res.IsSuccess === true) {
						setTimeout(function() {
							that.$f7.hidePreloader()
							that.onShowPaymentMethod(res.Data.PayMethodCollection)
						}, 300)
					} else {
						that.$f7.hidePreloader()
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			// 点击展开支付方式选择框
			onShowPaymentMethod: function(paymentMethod) {
				console.log('onShowPaymentMethod', paymentMethod)
				// 组装支付方式列表
				var payMethodList = []
				Object.keys(paymentMethod).forEach(function(key, value) {
					console.log('key', key)
					console.log('value', paymentMethod[key])
					// 过滤掉好友代付和Ep3支付方式
					if(key !== 'AgentTrade' && key !== 'EP3') {
						payMethodList.push({
							Obj: paymentMethod[key],
							Value: key
						})
					}
				})
				console.log('payMethodList', payMethodList)
				const that = this
				// 弹出选择支付方式
				var template = '<ul>'
				payMethodList.forEach(function(item, index) {
					console.log('payment way index', index)
					console.log('payment way item', item)
					// 默认选中第一个
					var active = ''
					if(index === 0) {
						active = 'active'
					}
					var balance = ''
					if(item.Value === 'EP2' && item.Obj !== null) {
						balance = that.$t('app.agent_pay.balance') + item.Obj.CurrencyCode + ' ' + item.Obj.Amount
					}
					var liTemp = `<li data-text='{0}' data-value='{1}' data-obj='{2}' class='item-content {3}'>
													<div class='item-inner'>
														<div class='item-title' style="width: 100%;">
															<span style="float: left;">{0}</span><span style="float: right;">{4}</span>
														</div>
													</div>
												 </li>`
					var objStr = null
					if(item.Obj !== null) {
						objStr = JSON.stringify(item.Obj)
					}
					template += liTemp.format(item.Value, item.Value, objStr, active, balance)
				})
				//				var liTemp = `<li data-text='{0}' data-value='{1}' class='item-content {2}'>
				//									<div class='item-inner'>
				//										<div class='item-title'>
				//											{0}
				//										</div>
				//									</div>
				//								 </li>`
				//				template += liTemp.format('EP2', 'EP2', 'active')
				//				template += liTemp.format('信用卡', 'CreditCard', '')
				//				template += liTemp.format('PayPal', 'PayPal', '')
				template += '</ul>'
				// 弹出选择支付方式
				that.$f7.modal({
					title: that.$t('app.agent_pay.payment'),
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
							var obj = that.$$(selectedItem).data('obj')
							console.log('selected text', text)
							console.log('selected value', value)
							console.log('selected obj', obj)
							if(obj !== null) {
								obj = JSON.parse(obj)
							}
							that.paymentMethod = value
							if(value === 'EP2') {
								// 使用EP2或EP3，需要输入支付密码
								that.onShowPasswordInputModal()
							} else if(value === 'CreditCard') {
								//that.onShowCCTermTypeModal()
								if(that.user.BranchCompanyId === 1) {
									// 马来西亚信用卡类型（"MasterCard" 或者 "VISA"）
									that.onShowCreditCardTypeModal(obj.CreditCardType)
									return false
								}
								if(that.user.BranchCompanyId === 4) {
									//台湾信用卡分期类型（不分期 ："noTerm"; 3期： "term3"; 12期："term12"）
									that.onShowCCTermTypeModal(obj.Periods)
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
			// 更新当前订单状态，支付成功之后更新
			updateCurrentOrder: function() {
				const that = this
				that.currentOrder.CanPay = false
				that.currentOrder.SalesOrderCollection.forEach(function(salesOrder) {
					salesOrder.StatusDisplay = that.$t('app.agent_pay.pay_success')
				})
			},
			onSubmit: function() {
				const that = this
				console.log('submit', that.currentOrder)
				console.log('onSubmit', that.paymentMethod)
				var url = ''
				var postData = {}
				if(that.paymentMethod === 'EP2') {
					console.log('SecurityPassword', that.securityPassword)
					url = 'Member/AgentTrade/DoPayForEP2'
					postData = {
						TradeId: that.currentOrder.TradeId,
						SecurityPassword: that.securityPassword
					}
				}
				if(that.paymentMethod === 'CreditCard') {
					console.log('creditCardType', that.creditCardType)
					console.log('cCTermType', that.cCTermType)
					url = 'Member/AgentTrade/DoPayForCreditCard'
					postData = {
						TradeId: that.currentOrder.TradeId,
						CallbackUrl: that.callbackUrl
					}
					//that.onShowCCTermTypeModal()
					if(that.user.BranchCompanyId === 1) {
						// 马来西亚信用卡类型（"MasterCard" 或者 "VISA"）
						postData.CreditCardType = that.creditCardType
					}
					if(that.user.BranchCompanyId === 4) {
						//台湾信用卡分期类型（不分期 ："noTerm"; 3期： "term3"; 12期："term12"）
						postData.Period = that.cCTermType
					}
				}
				if(that.paymentMethod === 'Paypal') {
					url = 'Member/AgentTrade/DoPayForPayPal'
					postData = {
						TradeId: that.currentOrder.TradeId,
						CallbackUrl: that.callbackUrl
					}
				}
				console.log('postData', postData)
				axios.post(url,
					postData
				).then(res => {
					console.log('DoPay res', res)
					if(res.IsSuccess === true) {
						// Paypal 或 信用卡支付，需要跳转网关
						if(that.paymentMethod === 'Paypal' || that.paymentMethod === 'CreditCard') {
							// 切换是否提交订单状态
							that.paying = true
							// 信用卡、Paypal需要跳转网关
							console.log('跳转到支付网关')
							if(that.plusReady) {
								// 关闭多余的弹出层
								that.$f7.closeModal()
								window.plus.runtime.openURL(res.Data.RedirectUrl)
							} else {
								window.open(res.Data.RedirectUrl)
							}
						} else {
							if(res.Data.IsPaySuccess === true) {
								that.$f7.alert(that.$t('app.agent_pay.pay_success'))
								that.updateCurrentOrder()
							} else {
								that.$f7.alert(res.Data.DisplayMessage)
							}
						}
					} else {
						// 切换是否提交订单状态
						that.paying = false
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			getAgentPayList: function() {
				const that = this
				console.log('loading', that.loading)
				console.log('lastPage', that.lastPage)
				if(that.lastPage || that.loading) {
					return false
				}
				that.$f7.showPreloader(that.$t('app.agent_pay.loading'))
				that.loading = true
				axios.post('Member/AgentTrade/List', {
					PageInfo: {
						PageSize: that.pageSize,
						CurrentPage: that.currentPage,
					}
				}).then(res => {
					console.log('order_list', res)
					that.$f7.hidePreloader()
					that.loading = false
					if(res.IsSuccess === true) {
						if(res.Data !== null && res.Data.length > 0) {
							that.lastPage = false
							console.log('data is not null')
							that.currentPage++ // 当前页码+1
								res.Data.forEach(function(item) {
									item.SalesOrderCollection.forEach(function(salesOrder) {
										switch(salesOrder.SalesOrderType) {
											case 1:
												salesOrder.SalesOrderTypeName = that.$t('app.agent_pay.purchase')
												break
											case 2:
												salesOrder.SalesOrderTypeName = that.$t('app.agent_pay.resales')
												break
											case 4:
												salesOrder.SalesOrderTypeName = that.$t('app.agent_pay.retail')
												break
											default:
												salesOrder.SalesOrderTypeName = ''
										}
									})
									that.order_list.push(item)
								})
						} else {
							console.log('data is null')
							that.lastPage = true
						}
					} else {
						that.lastPage = true
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