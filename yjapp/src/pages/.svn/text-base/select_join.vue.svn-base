<template>
	<div data-page="join" class="page join-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.select_join')">选择加入身份</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div @click="onJoin(1)" class="join-member" v-text="$t('app.select_join.member')">会员</div>
			<div @click="onJoin(3)" class="join-customer" v-text="$t('app.select_join.consumer')">消费者</div>
		</div>
	</div>
</template>

<style lang="less">
	.join-page {
		.join-member {
			width: 2.73rem;
			height: 2.73rem;
			line-height: 2.73rem;
			margin: 0 auto;
			margin-top: 2.1rem;
			background-image: url('../../static/icon/btn_Join_members_sel@3x.png');
			background-repeat: no-repeat;
			background-size: 100% 100%;
			text-align: center;
			color: #fff;
		}
		.join-customer {
			width: 2.73rem;
			height: 2.73rem;
			line-height: 2.73rem;
			margin: 0 auto;
			margin-top: 1.3rem;
			background-image: url('../../static/icon/btn_Join_the_consumer_nor@3x.png');
			background-repeat: no-repeat;
			background-size: 100% 100%;
			text-align: center;
			color: #E6CF8B;
		}
	}
</style>
<script>
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				resizeStyle: {},
				IntroducerLoginId: ''
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user
			}),
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
				console.log('register query', query)
				console.log('register IntroducerLoginId: ' + query.IntroducerLoginId)
				that.IntroducerLoginId = query.IntroducerLoginId
			})
		},
		methods: {
			routeBack: function() {
				var that = this
				// 当前弹出的层
				var modalIn = that.$$('.modal-in')
				console.log('modal_in', modalIn)
				if(modalIn.length === 0) {
					that.$f7.mainView.router.load({
						url: '/scan_qrcode'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onJoin: function(type) {
				var that = this
				that.$f7.mainView.router.load({
					url: `/register/?fromType=qrcode&userType=${type}&IntroducerLoginId=${that.IntroducerLoginId}`
				})
			}
		},
		components: {}
	}
</script>