<template>
	<div data-page='home' class='page home-page'>
		<!-- Top Navbar-->
		<f7-navbar theme="white">
			<f7-nav-left>
				<f7-link @click="onRouteTo('settings')" href="javascript:void(0);" icon="icon icon-setting"></f7-link>
			</f7-nav-left>
			<f7-nav-center sliding><span class="icon icon-logo"></span></f7-nav-center>
			<f7-nav-right>
				<f7-link icon="icon icon-scancode" icon-size="22" v-show="user === null || user_type === 0" @click="routeToScanQrCode"></f7-link>
				<f7-link icon="icon icon-card" icon-size="22" v-show="user !== null && user_type === 1" @click="routeToCard"></f7-link>
			</f7-nav-right>
		</f7-navbar>
		<!--<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="onRouteTo('settings')">
					<a class="link" href="javascript:void(0);">
						<i class="icon icon-setting" style="font-size: 22px;"></i>
					</a>
				</div>
				<div class="center">
					<span class="icon icon-logo"></span>
				</div>
				<div class="right" @click="routeToScanQrCode" v-show="user === null || user_type === 0">
					<a class="link" href="javascript:void(0);">
						<i class="icon icon-scancode" style="font-size: 22px;"></i>
					</a>
				</div>
				<div class="right" @click="routeToCard" v-show="user !== null && user_type === 1">
					<a class="link" href="javascript:void(0);">
						<i class="icon icon-card" style="font-size: 22px;"></i>
					</a>
				</div>
			</div>
		</div>-->
		<!-- /End of Top Navbar-->
		<div class='page-content'>
			<!-- 消费者模块 start -->
			<div class="member-home" v-if="user !== null && user_type === 3">
				<div class="member-detail">
					<div class="member-top">
						<div class="member-name" v-text="user.FullName">昵称</div>
						<div class="member-num" v-text="user.LoginId">会员编号</div>
					</div>
				</div>
			</div>
			<!-- 消费者模块 end -->
			<!-- 会员模块 start -->
			<div class="member-home" v-if="user != null && user_type === 1">
				<div class="member-detail">
					<div class="member-top" v-if="home_info !== null">
						<div class="member-name" v-text="home_info.DisplayName">昵称</div>
						<div class="member-num" v-text="home_info.LoginId">会员编号</div>
						<div class="circle">
							<div v-if="home_info.RemainBVToElite > 0" class="circle-bv text-gradient">{{home_info.RemainBVToElite}}<span class="bv-s text-gradient">BV</span> </div>
							<div v-if="home_info.RemainBVToElite > 0" class="circle-text text-gradient">
								<div class="circle-title">{{home_info.EliteTitle}}</div>
							</div>
							<div v-if="home_info.RemainBVToElite === 0" class="circle-text text-gradient">
								<div class="circle-title-only">{{home_info.YJTitle}}</div>
							</div>
						</div>
						<div class="bonus-detail" :class="{'english': lang === 'en-US'}">
							<div class="bonus-item text-gradient-home" :class="{'english': lang === 'en-US'}">
								<div class="bonus-num">${{home_info_direct.Amount}}</div>
								<div class="bonus-title" :class="{'english': lang === 'en-US'}">{{home_info_direct.Title}}</div>
							</div>
							<div class="bonus-item text-gradient-home" :class="{'english': lang === 'en-US'}">
								<div class="bonus-num">${{home_info_rebate.Amount}}</div>
								<div class="bonus-title" :class="{'english': lang === 'en-US'}">{{home_info_rebate.Title}}</div>
							</div>
							<div class="bonus-item text-gradient-home" :class="{'english': lang === 'en-US'}">
								<div class="bonus-num">${{home_info_retail.Amount}}</div>
								<div class="bonus-title" :class="{'english': lang === 'en-US'}">{{home_info_retail.Title}}</div>
							</div>
						</div>
					</div>
					<img class="member-center" src="../../static/icon/home_bg_curve@3x.png" />
					<div class="member-down">
						<div class="member-category">
							<div class="member-category-item">
								<a href="/wallet">
									<img class="category-img" src="../../static/icon/Home_tool_btn_wallet_nor@3x.png" />
									<div class="category-title" v-text="$t('app.home.wallet')">钱包</div>
								</a>
							</div>
							<div class="member-category-item">
								<a href="/score?fromType=home">
									<img class="category-img" src="../../static/icon/Home_tool_btn_integral_nor@3x.png" />
									<div class="category-title" v-text="$t('app.home.score')">积分</div>
								</a>
							</div>
							<div class="member-category-item">
								<a href="/bonus?fromType=home">
									<img class="category-img" src="../../static/icon/Home_tool_btn_bones_nor@3x.png" />
									<div class="category-title" v-text="$t('app.home.bonus')">奖金</div>
								</a>
							</div>
							<div class="member-category-item">
								<a href="/payment">
									<img class="category-img" src="../../static/icon/Home_tool_btn_to pay_nor@3x.png" />
									<div class="category-title" v-text="$t('app.home.agent_pay')">代付</div>
								</a>
							</div>
							<div class="member-category-item">
								<a href="/goods_list">
									<img class="category-img" src="../../static/icon/Home_tool_btn_purchase_nor@3x.png" />
									<div class="category-title" v-text="$t('app.home.goods')">购货</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 会员模块 end -->

			<!-- 访客模块 start -->
			<div class="swiper-container" :style="resizeStyle" v-if="user_type === 0">
				<div class="swiper-wrapper">
					<div class="swiper-slide" v-for="banner in banner_list">
						<img :src="banner.BannerPictureUrl" />
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>
			<!-- 访客模块 end -->

			<!-- 楼层商品列表 start -->
			<div class="floor-list">
				<div class="floor-item" v-for="(category_item, category_index) in product_list">
					<div class="floor-item-title">
						<span class="left text-gradient">{{category_item.Category.LocalizationName}}</span>
						<span class="right text-gradient">{{(category_index + 1)}}F</span>
					</div>
					<div class="clear"></div>
					<div class="goods-list" v-for="(goods_item, goods_index) in category_item.SalesProduct">
						<div class="goods-item">
							<div @click="routeToGoodsDetails(goods_item.Id, goods_item.SalesArea)">
								<img :src="goods_item.Pictures" class="post lazy lazy-fadein" />
								<p class="title">{{goods_item.LocalizationHeadline}}</p>
							</div>
							<div class="bottom">
								<div class="bottom left" style="width: 50%; float: left;">
									<div class="price text-gradient">{{goods_item.CurrencyCode}}</div>
									<div v-if="user_type === 1" class="bv">{{goods_item.BV}}BV
										<!--<span style="font-size:12px;">BV</span>--></div>
								</div>
								<div class="bottom right" style="width: 50%; float: right;">
									<span @click="addCart(goods_item.Id)" class="cart icon icon-list-cart"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- 楼层商品列表 end -->
			<div class="clear "></div>
		</div>

		<!-- 底部菜单栏 start -->
		<div class="toolbar tabbar">
			<div class="toolbar-inner">
				<a href="javascript:void(0);" class="tab-link active">
					<i class="icon icon-tab-home"></i>
				</a>
				<a @click="routeToTab('order')" href="javascript:void(0);" class="tab-link">
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
		<!-- 底部菜单栏 end -->
	</div>
</template>

<style lang="less">
	@import "../assets/styles/mixins.less";
	.home-page {
		.navbar {
			.left {
				a {
					/*width: 0.6rem;
					padding-left: 0.2rem;*/
				}
			}
			.right {
				a {
					/*width: 0.4rem;
					padding-right: 0.2rem;*/
				}
			}
		}
		.page-content {
			padding-bottom: 44px;
			.member-home {
				margin-bottom: 0.2rem;
				width: 100%;
				height: auto;
				.member-detail {
					height: auto;
					.member-top {
						padding-top: 0.35rem;
						padding-bottom: 0.35rem;
						background: #000000;
						height: auto;
						text-align: center;
						margin: 0 auto;
						.member-name {
							font-size: 0.26rem;
							color: #CDB87B;
							letter-spacing: 0.93px;
							line-height: 0.4rme;
							text-shadow: 0 0 8px rgba(177, 125, 23, 0.50);
						}
						.member-num {
							padding-top: 0.03rem;
							font-size: 0.24rem;
							color: #CDB87B;
							letter-spacing: 0.86px;
							line-height: 0.4rem;
							text-shadow: 0 0 8px rgba(177, 125, 23, 0.50);
						}
						.circle {
							margin: 0 auto;
							margin-top: 0.88rem;
							text-align: center;
							background: url(../../static/icon/home_Round@3x.png);
							background-size: 100%;
							width: 3.13rem;
							height: 3.13rem;
							.circle-bv {
								padding-top: 0.78rem;
								font-size: 0.6rem;
								letter-spacing: 1.47px;
								min-width: 3.0rem;
								.bv-s {
									font-size: 0.24rem;
								}
							}
							.circle-text {
								padding-top: 0.15rem;
								width: 1.2rem;
								min-width: 3.0rem;
								.circle-title {
									font-size: 0.24rem;
									letter-spacing: 0.86px;
									text-shadow: 0 0 8px rgba(177, 125, 23, 0.50);
								}
								.circle-title-only {
									font-size: 0.24rem;
									letter-spacing: 0.86px;
									text-shadow: 0 0 8px rgba(177, 125, 23, 0.50);
									margin-top: 1.24rem;
								}
							}
						}
						.bonus-detail {
							margin-top: 0.7rem;
							height: 0.86rem;
							&.english {
								height: 1.86rem;
							}
							.bonus-item {
								width: 30%;
								vertical-align: top;
								height: 0.86rem;
								&.english {
									height: 1.86rem;
								}
								.bonus-num {
									font-size: 0.36rem;
									letter-spacing: 1.06px;
									height: 0.46rem;
									line-height: 150%;
								}
								.bonus-title {
									font-size: 0.24rem;
									letter-spacing: 0.86px;
									line-height: 0.4rem;
									height: 0.4rem;
									&.english {
										height: 1.4rem;
									}
								}
							}
						}
					}
					.member-center {
						width: 100%;
						height: 0.94rem;
						background-size: 100%;
						display: block;
					}
					.member-down {
						margin-top: -0.1rem;
						padding-top: 0.25rem;
						padding-bottom: 0.47rem;
						background: #FFFFFF;
						.member-category {
							.member-category-item {
								display: inline-block;
								text-align: center;
								width: 19%;
								.category-img {
									width: 0.8rem;
									height: 0.8rem;
								}
								.category-title {
									font-family: PingFangSC-Light;
									font-size: 0.24rem;
									color: #7A7A7A;
									letter-spacing: 0.71px;
									line-height: 0.34rem;
								}
							}
						}
					}
				}
			}
			.swiper-container {
				/*height: 160px;*/
				.swiper-slide {
					background: #fff;
					img {
						width: 100%;
						height: 100%;
					}
				}
				.swiper-slide span {
					text-align: center;
					display: block;
					margin: 20px;
					font-size: 21px;
				}
				.swiper-pagination-bullet {
					width: 40px;
					height: 1px;
					text-align: center;
					line-height: 1px;
					font-size: 12px;
					color: #000;
					opacity: 1;
					background: rgba(0, 0, 0, 0.2);
				}
				.swiper-pagination-bullet-active {
					color: #fff;
					background: #007aff;
				}
			}
			.floor-list {
				width: 100%;
				height: auto;
				background-color: #fff;
				.floor-item {
					width: 100%;
					margin-bottom: 0.2rem;
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
							min-height: 5.46rem;
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
								min-height: 0.46rem;
								line-height: 0.46rem;
								.price {
									height: 0.46rem;
									margin-left: 0.3rem;
									float: left;
									line-height: 0.46rem;
									min-width: 2.6rem;
								}
								.bv {
									border-radius: 100px;
									font-family: PingFangSC-Medium;
									font-size: 0.18rem;
									color: #FFFFFF;
									letter-spacing: 0.53px;
									padding: 0 0.1rem;
									text-align: center;
									position: relative;
									margin-left: 0.3rem;
									background-image: linear-gradient(-146deg, rgb(230, 207, 139) 0%, rgb(156, 123, 56) 100%);
									float: left;
									height: 0.36rem;
									line-height: 0.4rem;
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
			.menu-list {
				.menu-item {
					text-align: center;
					border: 0.5px solid #ccc;
					height: 40px;
					line-height: 40px;
					border-radius: 4px;
				}
			}
			.goods-group-list {
				.goods-group {
					.goods-item {
						.post-img {
							width: 60px;
							height: 60px;
						}
					}
				}
			}
		}
	}
</style>

<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	import tipCountModel from '../components/tips_count_modal.vue'
	export default {
		data() {
			return {
				resizeStyle: {
					//height: 160 / 375 * document.documentElement.clientWidth + 'px'
				},
				resume: false,
				product_list: [], //首页商品列表	
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user_type: state => state.user_type,
				user: state => state.user,
				isSetDetail: state => state.isSetDetail,
				confirmAgreement: state => state.confirmAgreement,
				lang: state => state.lang,
				branch_company_id: state => state.branch_company_id,
				home_info: state => state.home_info,
				home_info_direct: state => state.home_info_direct,
				home_info_rebate: state => state.home_info_rebate,
				home_info_retail: state => state.home_info_retail,
				banner_list: state => state.banner_list,
				showTermSettlementInfo: state => state.showTermSettlementInfo,
				hideTermSettlementDate: state => state.hideTermSettlementDate,
				tip_count: state => state.tip_count // 结算提醒信息
			}),
			resizeHeight() {
				return 160 / 375 * document.documentElement.clientWidth
			}
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				var payResult = 'yijia://?tradeId=2017090117414035764ICIW&linkTransactionId=SO20170901174140326SKEE&isPaySuccess=True&paymentStatus=2&CustomField=ReSaleArea&displayMessage=0x00000000%20-%20&paymentCode=0x00000000&paymentMessage=&isSync=True&GWCode=0x00000000&GWMessage=&Message=&linkTranIsSuccess=True&linkTranCode=0x0&linkTranDisplayMessage=0x0%20-%20Successful%20operation'
				//var payResult = 'yijia://?tradeId=2017090416384456959UDC1&linkTransactionId=SO20170904163844507M18T%2CSO20170904163844491HR2D%2CSO20170904163844522VEVI&isPaySuccess=False&paymentStatus=3&CustomField=ReSaleArea&displayMessage=69%20-%20Error%20Code%3A%2069&paymentCode=69&paymentMessage=Error%20Code%3A%2069&isSync=True&GWCode=69&GWMessage=Error%20Code%3A%2069&linkTranIsSuccess=True&linkTranCode=0x0&linkTranDisplayMessage=0x0%20-%20Successful%20operation'
				var parseResult = that.$$.parseUrlQuery(payResult)
				console.log('parseResult', parseResult)
				var linkTransactionIdArr = parseResult.linkTransactionId.split(',')
				console.log('linkTransactionIdArr', linkTransactionIdArr)
				console.log('linkTransactionIdArr length', linkTransactionIdArr.length)
				console.log('linkTransactionIdArr[0]', linkTransactionIdArr[0])
				//that.$f7.confirm('test')
				console.log('home plusReady = ' + that.plusReady)
				if(that.plusReady) {
					//window.plus.runtime.openURL('http://www.baidu.com')
					// 运行环境从前台切换到后台事件
					document.addEventListener('pause', function() {
						//that.$f7.alert('pause' + window.plus.runtime.arguments)
					}, false)
					// 运行环境从后台切换到前台事件，处理支付回调操作
					document.addEventListener('resume', function() {
						//that.$f7.alert('resume' + window.plus.runtime.arguments)
					}, false)
					// 处理从后台恢复
					document.addEventListener('newintent', function() {
						//that.$f7.alert('newintent' + window.plus.runtime.arguments)
					}, false)
					console.log('before register backbutton event')
					// 首先移除事件
					window.plus.key.removeEventListener('backbutton', function() {
						console.log('removeEventListener')
					}, false)
					window.plus.key.addEventListener('backbutton', function() {
						that.routeBack()
					}, false)
				}
				if(that.user_type === 0) {
					// 访客获取首页轮播图之后，再获取商品数据
					that.getBannerList()
				} else if(that.user_type === 1 && that.user !== null) {
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
					// 获取会员首页数据
					that.getHomeInfo()
				} else if(that.user_type === 3) {
					// 消费者，直接获取商品数据
					// 获取首页商品数据
					that.productList()
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
					that.$f7.confirm(that.$t('app.modal.sure_exit'), function() {
						window.plus.runtime.quit()
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onResume: function() {
				const that = this
				console.log('onResume')
				if(that.plusReady) {
					if(that.resume === false) {
						//						that.resume = true
						//						var args = window.plus.runtime.arguments
						//						if(args.trim().length > 0) {
						//							that.$f7.alert('resume args = ' + args)
						//						} else {
						//							that.$f7.alert(' resume 没有传入参数')
						//						}
					}
				}
			},
			// 跳转到哪个页面去
			onRouteTo: function(page) {
				const that = this
				console.log('routeTo', page)
				that.$f7.mainView.router.load({
					url: '/' + page + '/'
				})
			},
			onShowTermSettlement: function() {
				console.log('onShowTermSettlement')
				const that = this
				that.$f7.showPreloader(that.$t('app.home.loading_term_settle'))
				axios.get('Member/Member/GetTermSettlementInfo').then(res => {
					console.log('gettipcount:', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						var settlementInfo = res.Data
						var template1 = that.$t('app.home.template1')
						template1 = template1.format(settlementInfo.FinancialYear, settlementInfo.TermOfYear, settlementInfo.WeekOfTerm, settlementInfo.DayOfWeek)

						var template2 = that.$t('app.home.template2')
						template2 = template2.format(new Date(settlementInfo.TermRang.Start).format('yyyy-MM-dd'), new Date(settlementInfo.TermRang.End).format('yyyy-MM-dd'))

						var template3 = that.$t('app.home.template3')
						template3 = template3.format(new Date(settlementInfo.TermSettlementDate).format('yyyy-MM-dd'))

						var template4 = that.$t('app.home.template4')

						that.$f7.modal({
							title: '',
							text: `<div style="font-size: 0.3rem; text-align: left; padding: 0.4rem;">
										<p>` + template1 + `</p>
										<p>` + template2 + `</p>
										<p>` + template3 + `</p>
										<div style="text-align: center;">
										<label for="no_show_today">
										<input id="no_show_today" type="checkbox" />
										` + template4 + `
										</label>
										</div>
									</div>`,
							buttons: [{
								text: that.$t('app.home.ok'),
								onClick: function() {
									var isChecked = that.$$('#no_show_today').prop('checked')
									if(isChecked === true) {
										that.$store.dispatch('setShowTermSettlementInfo', {
											showTermSettlementInfo: isChecked
										}).then(() => {})
									}
									console.log('click', isChecked)
								}
							}, ]
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
				})
			},
			productList: function() {
				console.log('productList')
				const that = this
				var salesArea = 2
				var branchCompanyId = that.branch_company_id
				if(that.user_type === 0 || that.user_type === 3) {
					// 访客和消费者获取商品数据为 消费者零售区
					salesArea = 4
				}
				// 如果处于登录状态，则使用用户的所在国家窗口
				if(that.user !== null) {
					branchCompanyId = that.user.BranchCompanyId
				}
				console.log('salesArea', salesArea)
				console.log('branchCompanyId', branchCompanyId)
				that.$f7.showPreloader(that.$t('app.home.loading_goods_data'))
				axios.get('Deals/Product/GetHomeProductList', {
					params: {
						branchCompanyId: branchCompanyId,
						salesArea: salesArea
					}
				}).then(res => {
					console.log('homeProduct_list', res)
					if(res.IsSuccess === true) {
						setTimeout(function() {
							that.$f7.hidePreloader()
						}, 300)
						that.product_list = res.Data
						//that.$$('img.lazy').trigger('lazy')
						console.log('salesArea', salesArea)
						console.log('branchCompanyId', branchCompanyId)
						if(that.user !== null && that.user_type === 1 && that.showTermSettlementInfo === true && that.hideTermSettlementDate !== new Date().format('yyyy-MM-dd')) {
							that.onShowTermSettlement()
						}
					} else {
						that.$f7.hidePreloader()
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			addCart: function(id) {
				const that = this
				if(that.user_type !== 0 && that.user !== null) {
					let salesArea = 2
					if(that.user_type === 3) {
						// 消费者的销售区为消费者零售区
						salesArea = 4
					}
					axios.post('Deals/ShoppingCart/AddCartItem', {
						'ProductId': id,
						'SalesArea': salesArea,
						'Count': 1
					}).then(res => {
						console.log('addCart', res)
						if(res.IsSuccess === true) {
							that.$f7.showPreloader(that.$t('app.home.success_add_to_cart'))
							setTimeout(function() {
								that.$f7.hidePreloader()
							}, 800)
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
					})
				} else {
					that.$f7.mainView.router.load({
						url: '/login'
					})
				}
			},
			// 获取会员首页信息
			getHomeInfo: function() {
				const that = this
				axios.get('Member/Member/GetHomeInfo').then(res => {
					console.log('homeInfo', res)
					if(res.IsSuccess === true) {
						that.$store.dispatch('setHomeInfo', {
							homeInfo: res.Data
						}).then(() => {
							// 获取首页商品数据
							that.productList()
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
				})
			},
			// 获取首页banner
			getBannerList: function() {
				const that = this
				axios.get('Deals/Common/GetIndexBanner', {}).then(res => {
					console.log('bannerList', res)
					if(res.IsSuccess === true) {
						that.$store.dispatch('setBannerList', {
							bannerList: res.Data
						}).then(() => {
							setTimeout(function() {
								that.$f7.swiper('.swiper-container', {
									pagination: '.swiper-pagination',
									paginationType: 'bullets',
									direction: 'horizontal',
									loop: true,
									autoplay: 2000
								})
								// 获取首页商品数据
								that.productList()
							}, 100)
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			routeToGoodsDetails(id, salesArea) {
				const that = this
				console.log('routeToGoodsDetails id', id)
				console.log('routeToGoodsDetails salesArea', salesArea)
				let fromType = 'home'
				that.$f7.mainView.router.load({
					url: `/goods_details/?id=${id}&salesArea=${salesArea}&fromType=${fromType}`
				})
			},
			routeToCard() {
				this.$f7.mainView.router.load({
					url: '/card/'
				})
			},
			routeToScanQrCode() {
				const that = this
				console.log('routeToScanQrCode')
				if(that.plusReady) {
					that.$f7.mainView.router.load({
						url: '/scan_qrcode/'
					})
				} else {
					var result = 63773527
					that.$f7.mainView.router.load({
						url: `/select_join/?IntroducerLoginId=${result}`
					})
				}
			},
			routeToTab(tab) {
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
						that.$f7.mainView.router.load({
							url: '/' + tab
						})
					} else if(that.user_type === 3) {
						that.$f7.mainView.router.load({
							url: '/' + tab
						})
					}
				} else {
					that.$f7.mainView.router.load({
						url: '/login'
					})
				}
			}
		},
		components: {
			tipCountModel,
		}
	}
</script>