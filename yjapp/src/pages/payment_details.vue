<template>
	<div data-page="payment-details" class="page payment-details-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left">
					<a href="/" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient">代付详情</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="pay-top">
				<div class="pay-top-box">
					<div class="pay-money">
						¥5,555.00
					</div>
					<div class="pay-declear">
						已申请代付
					</div>
				</div>
			</div>
			<div class="list-block">
				<ul>
					<li class="item-content">

						<div class="item-inner">
							<div class="item-title">申请人姓名</div>
							<div class="item-after">Haru</div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title pay-shop-left">申请人编号</div>
							<div class="item-after pay-shop-right">商品商品品商品</div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">创建时间</div>
							<div class="item-after">2017-06-13</div>
						</div>
					</li>
				</ul>
			</div>
			<div class="pay-warn">
				请先电话或当面核实申请人身份后再付款，代付商品或服务不归你所有
			</div>
			<!--<div class="bottom">
				<class class="bottom-l"></class>
				<class class="bottom-r">果断付款</class>
			</div>-->
		</div>

		<div class="toolbar">
			<div class="toolbar-inner row no-gutter bottom">
				<div class="col-50 bottom-l">残忍拒绝</div>
				<div class="col-50 bottom-r">果断付款</div>
			</div>
		</div>

	</div>
</template>

<style lang="less">
	.payment-details-page {
		.page-content {
			padding-bottom: 44px;
			.pay-top {
				width: 100%;
				height: 3.71rem;
				background: #FFFFFF;
				margin-bottom: 0.2rem;
				.pay-top-box {
					padding-top: 1.08rem;
					margin: 0 auto;
					text-align: center;
					.pay-money {
						font-family: PingFangSC-Medium;
						font-size: 0.8rem;
						text-align: center;
						color: #E6CF8B;
						letter-spacing: 0;
						line-height: 1.12rem;
					}
					.pay-declear {
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #696969;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
						padding-top: 0.22rem;
						text-align: center;
					}
				}
			}
			.list-block {
				.item-content {
					padding-left: 0;
					.item-inner {
						padding-left: 0.3rem;
						font-family: PingFangSC-Regular;
						font-size: 0.26REM;
						color: #696969;
						letter-spacing: 0.76px;
						line-height: 0.34REM;
						.pay-shop-left {
							margin-right: 0.4rem;
						}
					}
				}
			}
			.pay-warn {
				font-family: PingFangSC-Regular;
				font-size: 0.26rem;
				color: #A8A8A8;
				letter-spacing: 0.76px;
				line-height: 0.38rem;
				margin-top: 1.74rem;
				padding: 0 0.3rem;
			}
		}
		.toolbar {
			.bottom {
				padding: 0px;
				.bottom-l {
					background: #ffffff;
					font-family: PingFangSC-Regular;
					font-size: 0.3rem;
					color: #000;
					letter-spacing: 0;
					line-height: 44px;
					text-align: center;
				}
				.bottom-r {
					font-family: PingFangSC-Regular;
					font-size: 0.3rem;
					color: #FFFFFF;
					letter-spacing: 0;
					line-height: 44px;
					text-align: center;
					background: url(../../static/icon/list_bg_content_sel@3x.png);
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
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				resizeStyle: {}
			}
		},
		computed: {
			...mapState({
				user_type: state => state.user_type,
			})
		},
		mounted() {
			this.$nextTick(_ => {
				// 隐藏标题栏
				//  	this.$f7.mainView.hideNavbar()
			})
		},
		methods: {

		},
		components: {}
	}
</script>