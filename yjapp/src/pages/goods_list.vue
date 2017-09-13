<template>
	<div data-page="goods-list" class="page goods-list-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.goods')">购货专区</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="floor-list">
				<div class="floor-item" v-for="(category_item, category_index) in goods_list">
					<div class="floor-item-title floor-t">
						<span class="left text-gradient">{{category_item.Category.LocalizationName}}</span>
						<span class="right text-gradient">{{(category_index + 1)}}F</span>
					</div>
					<div class="clear"></div>
					<div class="goods-list" v-for="(goods_item, goods_index) in category_item.SalesProduct">
						<div class="goods-item">
							<div @click="routeToGoodsDetails(goods_item.Id, goods_item.SalesArea)">
								<img :src="goods_item.Pictures" class="post" />
								<p class="title">{{goods_item.LocalizationHeadline}}</p>
							</div>
							<div class="bottom">
								<span class="price text-gradient">{{goods_item.CurrencyCode}}</span>
								<span v-if="user_type === 1" class="price text-bv">{{goods_item.BV}}BV</span>
								<span @click="addCart(goods_item.Id)" class="cart icon icon-list-cart"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.goods-list-page {
		.floor-list {
			width: 100%;
			height: auto;
			background-color: #fff;
			.floor-item {
				margin-bottom: 0.1rem;
				background-color: #fff;
				float: left;
				.floor-item-title {
					border-bottom: 1px solid #eee;
					background-color: #fff;
					height: 0.66rem;
					.left {
						float: left;
						padding-left: 0.2rem;
						height: 0.66rem;
						line-height: 0.66rem;
					}
					.right {
						float: right;
						padding-right: 0.2rem;
						height: 0.66rem;
						line-height: 0.66rem;
					}
				}
				.goods-list {
					.goods-item {
						float: left;
						width: 50%;
						height: 5.46rem;
						padding-bottom: 0.39rem;
						background-color: #fff;
						.post {
							width: 100%;
							height: auto;
						}
						.title {
							height: 0.37rem;
							width: 3.12rem;
							padding: 0px 10px 0px 10px;
							color: #000;
							display: block;
							white-space: nowrap;
							overflow: hidden;
							text-overflow: ellipsis;
						}
						.bottom {
							height: 0.46rem;
							line-height: 0.46rem;
							position: relative;
							.price {
								height: 0.46rem;
								margin-left: 0.3rem;
								float: left;
								line-height: 0.46rem;
								position: absolute;
								bottom: 12px;
							}
							.text-bv {
								display: inline-block;
								position: absolute;
								width: 1rem;
								left: 0;
								bottom: -6px;
								font-family: PingFangSC-Medium;
								font-size: 0.18rem;
								color: #FFFFFF;
								letter-spacing: 0.53px;
								background-image: linear-gradient(-146deg, #E6CF8B 0%, #9C7B38 100%);
								border-radius: 100px;
								height: 0.36rem;
								line-height: 0.4rem;
								text-align: center;
								padding: 0 0.1rem;
							}
							.cart {
								width: 0.46rem;
								height: 0.46rem;
								float: right;
								margin-right: 0.3rem;
								line-height: 0.46rem;
							}
						}
						&:nth-child(odd) {
							width: calc(~"50% - 1px");
							border-right: 1px solid #eee;
						}
					}
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
				goods_list: [], //购货商品列表	
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				salesArea: state => state.salesArea,
				user: state => state.user,
				user_type: state => state.user_type,
				country_value: state => state.country_value
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
				that.goodsList()
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
			goodsList: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.goods.loading'))
				axios.get('Deals/Product/GetHomeProductList', {
					params: {
						branchCompanyId: that.user.BranchCompanyId,
						salesArea: that.salesArea.purchaseArea
					}
				}).then(res => {
					console.log('homeProduct_list', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.goods_list = res.Data
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
			},
			addCart: function(id) {
				const that = this
				axios.post('Deals/ShoppingCart/AddCartItem', {
					'ProductId': id,
					'SalesArea': that.salesArea.purchaseArea,
					'Count': 1
				}).then(res => {
					console.log('addCart', res)
					if(res.IsSuccess === true) {
						that.$f7.showPreloader(that.$t('app.goods.success_add_to_cart'))
						setTimeout(function() {
							that.$f7.hidePreloader()
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
			},
			routeToGoodsDetails(id, salesArea) {
				const that = this
				console.log('routeToGoodsDetails id', id)
				console.log('routeToGoodsDetails salesArea', salesArea)
				let fromType = 'goods_list'
				that.$f7.mainView.router.load({
					url: `/goods_details/?id=${id}&salesArea=${salesArea}&fromType=${fromType}`
				})
			},
		},
		components: {}
	}
</script>