<template>
	<div data-page="profile" class="page profile-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.profile')">个人资料</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.profile.nickname')">姓名</div>
							<div class="item-after" v-text="user.DisplayName">Koolodan</div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.profile.member_id')">编号</div>
							<div class="item-after" v-text="user.LoginId">623462342</div>
						</div>
					</li>
					<li class="item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.profile.email')">邮箱</div>
							<div class="item-after" v-text="user.Email">test@yijiaguoji.com</div>
						</div>
					</li>
					<!--<li class="item-content">
						<div class="item-inner">
							<div class="item-title" v-text="$t('app.profile.telephone')">手机号</div>
							<div class="item-after" v-text="">13800138000</div>
						</div>
					</li>-->
				</ul>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.profile-page {
		.list-block {
			.item-content {
				padding-left: 0px;
			}
			.item-inner {
				padding-left: 15px;
			}
			.item-title,
			.item-after {
				font-size: 0.26rem;
			}
			margin: 0;
		}
	}
</style>

<script>
	import { mapState } from 'vuex'
	export default {
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
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
						url: '/member/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			}
		}
	}
</script>