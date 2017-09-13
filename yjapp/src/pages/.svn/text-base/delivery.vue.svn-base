<template>
	<div data-page="delivery" class="page delivery-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left">
					<a href="/" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient">物流信息</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">物流状态</div>
							<div class="item-after">快件已签收</div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">承运公司</div>
							<div class="item-after">顺丰快递</div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title">运单编号</div>
							<div class="item-after">024 222 333</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.delivery-page {
		.list-block{
			margin: 0;
		}
		.item-content {
			height: 0.88rem;
			width: 100%;
			padding: 0 0.3rem;
			font-size: 0.26rem;
			border-bottom: 1px solid #eee;
			.item-inner:after {
				display: none;
				.item-after {
					max-height: 100%!important;
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