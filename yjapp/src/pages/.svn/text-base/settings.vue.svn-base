<template>
	<div class="page settings-page" data-page="settings">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.settings')">设置</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li v-bind:class="{ active: selected == 'language' }" v-on:click="onSelect('language')">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.settings.language')"></div>
								<div class="item-after">
									<span class="icon icon-msg-selected"></span>
								</div>
							</div>
						</div>
					</li>
					<li v-show="user_type === 0" v-bind:class="{ active: selected == 'branch_company_list' }" v-on:click="onSelect('branch_company_list')">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.settings.branch_company')"></div>
								<div class="item-after">
									<span class="icon icon-msg-selected"></span>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

</template>

<style lang="less">
	.settings-page {
		.page-content {
			background-color: rgba(0, 0, 0, 0.7);
			.list-block {
				margin: 0px;
				border: none;
				.item-title {
					font-size: 0.26rem;
				}
				li {
					&.active {
						background-color: #CDB87B;
						color: #fff;
					}
					.item-link {
						border: none;
						.item-content {
							border: none;
							.item-inner {
								border: none;
								.item-title {
									font-size: 0.26rem;
								}
							}
						}
					}
				}
			}
		}
	}
</style>

<script>
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				selected: ''
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user_type: state => state.user_type,
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
			},
			onSelect: function(type) {
				console.log('type', type)
				const that = this
				that.selected = type
				if(type === 'language') {
					that.$f7.mainView.router.load({
						url: '/language/'
					})
				} else if(type === 'branch_company_list') {
					that.$f7.mainView.router.load({
						url: '/branch_company_list/'
					})
				}
			},
			onLanguage: function() {}
		}
	}
</script>