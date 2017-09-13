<template>
	<div data-page="friend-payment" class="page friend-payment-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left">
					<a href="/" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient">好友代付申请</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
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

				</div>

			</div>
			<div class="content-post">
				<div class="content-post-box">
					<input type="text" placeholder="代付人编号" class="content-input" />
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.friend-payment-page {
		.content {
			background: #FFFFFF;
			padding: 0.35rem 0.3rem;
			.content-item {
				width: 100%;
				padding-bottom: 0.2rem;
				height: 0.4rem;
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
		.content-post {
			background: #FFFFFF;
			margin-top: 0.2rem;
			width: 100%;
			height: 0.88rem;
			line-height: 0.88rem;
			.content-post-box {
				padding-left: 0.3rem;
				>input {
					width: 100%;
					border: none;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #B2B2B2;
					letter-spacing: 0.76px;
					line-height: 0.34rem;
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