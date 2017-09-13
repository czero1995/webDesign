<template>
	<div data-page="card" class="page card-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.card')">我的名片</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="card-page">
				<div class="card-content" v-if="user !== null">
					<div class="card-title text-gradient" v-text="$t('app.card.my_card')">个人名片</div>
					<div class="card-declare" v-text="user.DisplayName">会员昵称</div>
					<div class="card-img">
						<img v-bind:src="qrcode" alt="" />
					</div>
				</div>
			</div>

		</div>
	</div>
</template>

<style lang="less">
	.card-page {
		background-image: linear-gradient(-136deg, #E6CF8B 0%, #D1B774 17%, #BA9E5A 36%, #6C4503 100%);
		background-size: 100%;
		height: 100%;
		width: 100%;
		.card-content {
			position: absolute;
			text-align: center;
			width: 6.6rem;
			height: 7.68rem;
			top: 1.79rem;
			left: 0.45rem;
			background: #ffffff;
			border-radius: 10px;
			.card-title {
				margin-top: 0.93rem;
				font-family: PingFangSC-Medium;
				font-size: 0.3rem;
				letter-spacing: 0.88px;
				line-height: 0.34rem;
			}
			.card-declare {
				font-family: PingFangSC-Regular;
				font-size: 0.24rem;
				color: #929292;
				letter-spacing: 0.71px;
				line-height: 34px;
			}
			.card-img {
				margin: 0 auto;
				width: 4.3rem;
				background: bisque;
				height: 4.3rem;
				img {
					width: 100%;
					height: 100%;
				}
			}
		}
	}
</style>
<script>
	import { mapState } from 'vuex'
	export default {
		data() {
			return {}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				qrcode: state => state.qrcode
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
			}
		},
		components: {}
	}
</script>