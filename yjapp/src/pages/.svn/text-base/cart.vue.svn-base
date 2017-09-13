<template>
	<div data-page='cart' class='page cart-page'>
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="center" @click="onShowSelect">
					<span v-if="user_type !== 1" class="text-gradient" v-text="$t('app.cart.retail_cart')">购物车</span>
					<span v-if="user_type === 1" class="text-gradient" v-text="salesArea === 1 ? $t('app.cart.goods_cart') : $t('app.cart.resales_cart')">重消购物车</span>
					<span v-if="user_type === 1" class="icon icon-up" v-show="showSelect"></span>
					<span v-if="user_type === 1" class="icon icon-down" v-show="!showSelect"></span>
				</div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class='page-content'>
			<div style="text-align: center;" v-if="get_cart.length === 0">
				<p class="text-gradient" v-text="$t('app.cart.empty_cart')">购物车是空的</p>
			</div>
			<div class="list-block">
				<div class="cart-item" v-for="(cart_item, cart_index) in get_cart">
					<ul v-if="cart_item.OrderMerchantProducts.length > 0">
						<li>
							<div class="item-content">
								<div class="item-title clearfloat" @click="onShopChoice(cart_item)">
									<img src="../../static/icon/list_selected_sel@3x.png" class="order-choose" v-show="cart_item.selectAll" />
									<img src="../../static/icon/list_Unselected_nor@3x.png" class="order-choose" v-show="!cart_item.selectAll" />
									<div class="order-title" v-if="cart_item.Merchant.SelfEmployed === true">{{cart_item.YJMerchantName}}</div>
									<div class="order-title" v-if="cart_item.Merchant.SelfEmployed === false">{{cart_item.Merchant.Name}}</div>
								</div>
								<div class="order-edit text-gradient" v-if="!cart_item.swipeout" @click="onSwipeoutOpen(cart_item, cart_index)" v-text="$t('app.cart.edit')">编辑</div>
								<div class="order-edit text-gradient" v-if="cart_item.swipeout === true" @click="onSwipeoutClose(cart_item, cart_index)" v-text="$t('app.cart.finish')">完成</div>
							</div>
						</li>
						<li class="swipeout order-detail" :class="'swipeout-' + salesArea + '-' + cart_index + '-' + product_index" v-for="(cart_info, product_index) in cart_item.OrderMerchantProducts">
							<div class="swipeout-content item-content">
								<img src="../../static/icon/list_selected_sel@3x.png" class="order-choose" v-show="cart_info.selected" @click="onProductChoice(get_cart, cart_item, cart_info)" />
								<img src="../../static/icon/list_Unselected_nor@3x.png" class="order-choose" v-show="!cart_info.selected" @click="onProductChoice(get_cart, cart_item, cart_info)" />
								<div class="item-media" @click="onProductChoice(get_cart, cart_item, cart_info)">
									<img :src="cart_info.Pictures" class="shop-img" />
								</div>
								<div class="item-inner">
									<div class="shop-info">
										<p class="shop-name">{{cart_info.Headline}}</p>
										<p class="shop-money text-gradient">{{cart_info.DisplayPrice}} <span class="money-s"></span></p>
										<div class="shop-edit">
											<img src="../../static/icon/edit_Less_nor@3x.png" class="btn-less" @click="removeCartItem(cart_info)" />
											<span style="display: inline-block; width: 30px; text-align: center;" v-text="cart_info.Quantity"></span>
											<img src="../../static/icon/edit_plus_sel@3x.png" class="btn-plus" @click="addCartItem(cart_info)" />
										</div>
									</div>
									<p v-show="user_type === 1" class="shop-bv">{{cart_info.BV}}BV</p>
								</div>
							</div>
							<div class="swipeout-actions-right">
								<a href="#" class="" @click="deleteCartItem(cart_info, product_index, cart_item.OrderMerchantProducts)">
									<span class="icon icon-delete"></span>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- end of page-content-->
		<div class="toolbar tabbar count-toolbar">
			<div class="cartBottom toolbar-inner">
				<div class="bottom-l" @click="onSelectAll(get_cart)">
					<img src="../../static/icon/list_Unselected_nor@3x.png" class="order-choose" v-show="!selectAll" />
					<img src="../../static/icon/list_selected_sel@3x.png" class="order-choose" v-show="selectAll" />
					<span class="bottom-l-title" v-text="$t('app.cart.amount')">合计</span>
					<span v-if="get_cart.length > 0" class="all-money text-gradient" v-text="get_cart[0].CurrencyCode + ' ' + total_amount">¥0.00</span>
				</div>
				<div class="bottom-r" @click="onOrderConfirm" v-text="$t('app.cart.submit')">
					结算
				</div>
			</div>
		</div>
		<div class="toolbar tabbar">
			<div class="toolbar-inner">
				<a @click="routeToTab('home')" href="javascript:void(0);" class="tab-link">
					<i class="icon icon-tab-home"></i>
				</a>
				<a @click="routeToTab('order')" href="javascript:void(0);" class="tab-link">
					<i class="icon icon-tab-order"></i>
				</a>
				<a href="javascript:void(0);" class="tab-link active">
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
	.cart-page {
		.subnavbar {
			padding: 0px;
			.select-cart {
				position: relative;
				z-index: 999999;
				width: 100%;
				top: 0.34rem;
				.select-cart-item {
					position: relative;
					height: 0.88rem;
					line-height: 0.88rem;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #5A5A5A;
					letter-spacing: 0.76px;
					padding: 0 0.3rem;
					background: #FFFFFF;
					.select-active {
						background: url(../../static/icon/list_selected_sel@3x.png);
						display: inline-block;
						position: absolute;
						top: 0;
						bottom: 0;
						margin: auto;
						right: 0.3rem;
						width: 0.28rem;
						height: 0.28rem;
						background-size: 100%;
					}
				}
			}
		}
		.page-content {
			padding-bottom: 92px;
			.list-block {
				margin: 0;
				.item-media {
					margin-left: 0.1rem;
				}
				.item-inner {
					&:after {
						background: none;
					}
				}
				.cart-item {
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
							.order-choose {
								width: 0.27rem;
								height: 0.27rem;
								vertical-align: middle;
								margin-right: 0.2rem;
							}
							.order-title {
								display: inline-block;
								font-family: PingFangSC-Regular;
								font-size: 0.26rem;
								color: #767676;
								letter-spacing: 0.76px;
								line-height: 0.34rem;
							}
						}
						.order-edit {
							float: right;
							display: inline-block;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #767676;
							letter-spacing: 0.76px;
							line-height: 200%;
							width: 0.9rem;
							text-align: center;
						}
						.order-detail {
							width: 100%;
							padding: 0.3rem;
							position: relative;
							.order-choose {
								width: 0.27rem;
								height: 0.27rem;
								vertical-align: middle;
								margin-right: 0.3rem;
								position: absolute;
								top: 0;
								bottom: 0;
								margin: auto;
							}
							.shop-img {
								width: 1.7rem;
								height: auto;
								margin-right: 0.3rem;
								display: inline-block;
								margin-left: 0.3rem;
								vertical-align: middle;
							}
							.shop-info {
								display: inline-block;
								vertical-align: middle;
								.shop-name {
									font-family: PingFangSC-Regular;
									font-size: 0.26rem;
									color: #000000;
									letter-spacing: 0.76px;
									line-height: 0.34rem;
									margin: 0;
									height: auto;
									width: 4rem;
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
								.shop-edit {
									.btn-less {
										width: 0.48rem;
										height: 0.48rem;
										vertical-align: middle;
									}
									.btn-plus {
										width: 0.48rem;
										height: 0.48rem;
										vertical-align: middle;
									}
									.shop-numText {
										display: inline-block;
										padding: 0 0.2rem;
										width: 0.8rem;
									}
								}
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
								position: absolute;
								right: 0;
								top: 1rem;
								padding: 4px;
							}
						}
					}
				}
			}
		}
		.count-toolbar {
			bottom: 44px;
			.cartBottom {
				background: #FFFFFF;
				height: 44px;
				line-height: 44px;
				&.toolbar-inner {
					padding: 0;
				}
				.bottom-l {
					padding-left: 0.3rem;
					width: 50%;
					display: inline-block;
					.order-choose {
						margin-right: 0.2rem;
						width: 0.27rem;
						height: 0.27rem;
						vertical-align: middle;
					}
					.bottom-l-title {
						font-family: PingFangSC-Regular;
						font-size: 0.28rem;
						color: #767676;
						letter-spacing: 0.71px;
						line-height: 0.34rem;
					}
					.all-money {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #000000;
						letter-spacing: 0.76px;
						line-height: 0.28rem;
					}
				}
				.bottom-r {
					width: 47%;
					display: inline-block;
					text-align: center;
					font-family: PingFangSC-Regular;
					font-size: 0.3rem;
					color: #FFFFFF;
					letter-spacing: 0;
					float: right;
					background: url(../../static/icon/list_bg_content_sel@3x.png);
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
				showSelect: false,
				order_choose: false,
				salesArea: 2, // 购货购物车（1）， 重消购物车（2），消费者购物车（4），exchangeArea（5）
				selectAll: true,
				get_cart: [], //购物车
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				user_type: state => state.user_type
			}),
			total_amount: function() {
				var that = this
				var amount = 0
				that.get_cart.forEach(function(item) {
					item.OrderMerchantProducts.forEach(function(product) {
						if(product.selected) {
							amount = that.accAdd(amount, that.accMul(product.Price, product.Quantity))
						}
					})
				})
				return amount
			}
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
				console.log('cart query', query)
				var salesArea = query.salesArea
				if(salesArea === undefined) {
					// 默认为重消购物车
					salesArea = 2
				}else{
					salesArea = parseInt(salesArea)
				}
				console.log('query', query)
				if(that.user_type !== 1) {
					that.salesArea = 4
				} else {
					that.salesArea = salesArea
				}
				that.getCart()
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
			accMul: function(arg1, arg2) {
				if(isNaN(arg1)) {
					arg1 = 0
				}
				if(isNaN(arg2)) {
					arg2 = 0
				}
				arg1 = Number(arg1)
				arg2 = Number(arg2)
				var m = 0,
					s1 = arg1.toString(),
					s2 = arg2.toString()
				try {
					m += s1.split('.')[1].length
				} catch(e) {}
				try {
					m += s2.split('.')[1].length
				} catch(e) {}
				return Number(s1.replace('.', '')) * Number(s2.replace('.', '')) / Math.pow(10, m)
			},
			getCart: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.cart.loading'))
				axios.get('Deals/ShoppingCart/GetCartProductInfo?salesArea=' + that.salesArea).then(res => {
					console.log('cart', res)
					console.log('salesArea', that.salesArea)
					if(res.IsSuccess === true) {
						let data = res.Data
						data.forEach(function(item) {
							item.OrderMerchantProducts.forEach(function(product) {
								product.selected = true
							})
							item.selectAll = true // 是否全选，默认为true
							item.swipeout = false // 是否开启编辑，默认为false
						})
						that.get_cart = data
						setTimeout(function() {
							that.$f7.hidePreloader()
						}, 500)
					} else {
						that.$f7.hidePreloader()
						that.get_cart = []
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
			addCartItem: function(product) {
				const that = this
				axios.post('Deals/ShoppingCart/AddCartItem', {
					'ProductId': product.Id,
					'SalesArea': that.salesArea,
					'Count': 1
				}).then(res => {
					console.log('addCart', res)
					console.log('after add cart')
					product.Quantity++
				})
			},
			removeCartItem: function(product) {
				const that = this
				if(product.Quantity > 1) {
					axios.post('Deals/ShoppingCart/RemoveCartItem', {
						'ProductId': product.Id,
						'SalesArea': that.salesArea,
						'Count': 1
					}).then(res => {
						console.log('removeCart', res)
						console.log('after removeCartItem cart')
						product.Quantity--
					})
				}
			},
			editQuantity(id, counts) {
				const that = this
				that.$store.dispatch('editCartItem', {
					productId: id,
					salesArea: that.salesArea,
					count: counts,
				})
			},
			deleteCartItem: function(product, productIndex, productList) {
				const that = this
				// 从购物车删除商品
				console.log('deleteCartItem')
				that.$f7.confirm(that.$t('app.cart.sure_delete'), function() {
					axios.post('Deals/ShoppingCart/RemoveCartItem', {
						'ProductId': product.Id,
						'SalesArea': that.salesArea,
						'Count': 0
					}).then(res => {
						console.log('removeCart', res)
						productList.splice(productIndex, 1)
						console.log('after deleteCartItem cart')
					})
				})
			},
			onSwipeoutOpen: function(cartItem, cartIndex) {
				var that = this
				cartItem.swipeout = true
				// 加入购物车类型

				console.log('onSwipeoutOpen product list', cartItem.OrderMerchantProducts)
				console.log('onSwipeoutOpen product cartIndex', cartIndex)
				cartItem.OrderMerchantProducts.forEach(function(item, productIndex) {
					console.log('onSwipeoutOpen item', item)
					console.log('onSwipeoutOpen item index', productIndex)
					that.$f7.swipeoutOpen('.page-on-center .swipeout-' + that.salesArea + '-' + cartIndex + '-' + productIndex, 'right', function() {
						console.log('swipeoutOpen')
					})
				})
			},
			onSwipeoutClose: function(cartItem, cartIndex) {
				var that = this
				cartItem.swipeout = false
				console.log('onSwipeoutClose product list', cartItem.OrderMerchantProducts)
				console.log('onSwipeoutClose product cartIndex', cartIndex)
				cartItem.OrderMerchantProducts.forEach(function(item, productIndex) {
					console.log('onSwipeoutClose item', item)
					console.log('onSwipeoutClose item index', productIndex)
					that.$f7.swipeoutClose('.page-on-center .swipeout-' + that.salesArea + '-' + cartIndex + '-' + productIndex, function() {
						console.log('swipeoutClose')
					})
				})
			},
			onSelectAll(cartList) {
				console.log('onSelectAll')
				var that = this
				that.selectAll = !that.selectAll
				cartList.forEach(function(cartItem) {
					cartItem.selectAll = that.selectAll
					cartItem.OrderMerchantProducts.forEach(function(product) {
						product.selected = that.selectAll
					})
				})
			},
			onShopChoice(shop) {
				console.log('onShopChoice')
				if(shop.selectAll) {
					shop.selectAll = false
					shop.OrderMerchantProducts.forEach(function(item) {
						item.selected = false
					})
				} else {
					shop.selectAll = true
					shop.OrderMerchantProducts.forEach(function(item) {
						item.selected = true
					})
				}
			},
			onProductChoice(cartList, shop, product) {
				console.log('onProductChoice')
				var that = this
				product.selected = !product.selected
				var selectAll = true
				shop.OrderMerchantProducts.forEach(function(item) {
					if(!item.selected) {
						selectAll = false
					}
				})
				shop.selectAll = selectAll
				var cartSelectAll = true
				cartList.forEach(function(cartItem) {
					if(!cartItem.selectAll) {
						cartSelectAll = false
					}
				})
				that.selectAll = cartSelectAll
			},
			onShowSelect() {
				const that = this
				//this.$$('#customer-modal').show()
				that.showSelect = !that.showSelect
				var buttons = [{
						text: that.$t('app.cart.resales_cart'),
						onClick: function() {
							console.log('select resales cart')
							that.salesArea = 2
							that.onSelectCart(2)
						}
					},
					{
						text: that.$t('app.cart.goods_cart'),
						onClick: function() {
							console.log('select goods cart')
							that.salesArea = 1
							that.onSelectCart(1)
						}
					},
					{
						text: that.$t('app.modal.button_cancel'),
						color: 'red',
						onClick: function() {
							console.log('cancel cart select')
						}
					},
				]
				that.$f7.actions(buttons)
			},
			onSelectCart(salesArea) {
				// 切换购物车，只有会员可以切换购物车，非会员，只有消费者零售区
				var that = this
				//this.$$('#customer-modal').hide()
				that.showSelect = false
				that.salesArea = salesArea
				that.getCart()
				//收起所有的编辑状态和删除swipeout
				that.$f7.swipeoutClose('.swipeout', function() {
					console.log('swipeoutClose')
				})
			},
			onOrderConfirm() {
				var that = this
				var productDicList = []
				that.get_cart.forEach(function(cartItem) {
					console.log('cartItem', cartItem)
					cartItem.OrderMerchantProducts.forEach(function(product) {
						console.log('product', product)
						if(product.selected) {
							var productDic = {}
							productDic.Id = product['Id']
							productDic.Quantity = product['Quantity']
							productDicList.push(productDic)
						}
					})
				})
				if(productDicList.length === 0) {
					that.$f7.alert(that.$t('app.cart.before_submit'))
				} else {
					var productDicStr = JSON.stringify(productDicList)
					console.log('productDicList', productDicList.length)
					console.log('productDic', productDicStr)
					console.log('get_cart', that.get_cart)
					console.log('salesArea', that.salesArea)
					that.$f7.mainView.router.load({
						url: `/order_confirm/?salesArea=${that.salesArea}&productDicStr=${productDicStr}&fromType=cart`
					})
				}
			}
		},
		components: {}
	}
</script>