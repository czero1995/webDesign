<template>
	<div data-page="friend-payment-details" class="page friend-payment-details-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left">
					<a href="/" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient">好友代付详情</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="topTitle">
				商品已成功锁定，请在24小时内通知好友完成支付，否则系统将自动取消本次交易。
			</div>
			<div class="content">
				<div class="content-box">
					<div class="content-item clearfloat">
						<span class="content-l">来自</span>
						<span class="content-r">億嘉國際</span>
					</div>
					<div class="content-item clearfloat">
						<span class="content-l">商品</span>
						<span class="content-r">MAIONE美容呵护套装</span>
					</div>
					<div class="content-item clearfloat">
						<span class="content-l">总价</span>
						<span class="content-r">
							<span class="money-s">¥</span> 65,500.
						<span class="money-s">00</span>
						</span>
					</div>
					<div class="content-item clearfloat">
						<span class="content-l">商品BV</span>
						<span class="content-r">500</span>
					</div>
					<div class="content-item clearfloat">
						<span class="content-l">代付申请人</span>
						<span class="content-r">恐*蛋（136****2333）</span>
					</div>
					<div class="content-item clearfloat">
						<span class="content-l">代付好友编号</span>
						<span class="content-r">23336666</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.friend-payment-details-page {
		.topTitle {
			padding: 0.33rem 0.4rem;
			font-family: PingFangSC-Regular;
			font-size: 0.26rem;
			color: #A8A8A8;
			letter-spacing: 0.2px;
		}
		.content {
			background: #FFFFFF;
			padding: 0.35rem 0.3rem;
			.content-item {
				width: 100%;
				padding-bottom: 0.2rem;
				
				
				.content-l {
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
				}
				.content-r {
					font-family: PingFangSC-Medium;
					font-size: 0.26rem;
					color: #8E8E8E;
					letter-spacing: 0.76px;
					float: right;
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
				timeline: state => state.timeline,
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