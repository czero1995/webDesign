<template>
	<div data-page="language" class="page language-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.language')">语言</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li :class="{ active: currentLang === 'zh-CN' }" @click="setLang('zh-CN')">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">简体中文</div>
								<div class="item-after">
									<span class="icon icon-msg-selected"></span>
								</div>
							</div>
						</div>
					</li>
					<li :class="{ active: currentLang === 'zh-HK' }" @click="setLang('zh-HK')">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">繁体中文</div>
								<div class="item-after">
									<span class="icon icon-msg-selected"></span>
								</div>
							</div>
						</div>
					</li>
					<li :class="{ active: currentLang === 'en-US' }" @click="setLang('en-US')">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title">English</div>
								<div class="item-after">
									<span class="icon icon-msg-selected"></span>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="toolbar">
			<div class="toolbar-inner">
				<div class="onSubmit" @click="onSubmit" v-text="$t('app.language.ok')">确 定</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.language-page {
		.page-content {
			background-color: rgba(0, 0, 0, 0.7);
			.list-block {
				margin: 0px;
				border: none;
				.item-content {
					padding-left: 0px;
				}
				.item-inner {
					padding-left: 15px;
				}
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
									font-size: 16px;
								}
							}
						}
					}
				}
			}
		}
		.toolbar {
			width: 100%;
			height: 0.98rem;
			text-align: center;
			font-family: PingFangSC-Regular;
			font-size: 0.3rem;
			color: #FFFFFF;
			letter-spacing: 0;
			background-color: #B2B2B2;
			background-image: url(../../static/icon/list_bg_content_select_sel@3x.png);
			.onSubmit {
				width: 100%;
				text-align: center;
			}
		}
	}
</style>

<script>
	import Vue from 'vue'
	import { mapState } from 'vuex'
	export default {
		data: function() {
			return {
				currentLang: ''
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				lang: state => state.lang,
			})
		},
		mounted: function() {
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
				console.log('lang', that.lang)
				that.currentLang = that.lang
				console.log('currentLang', that.currentLang)
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
						url: '/settings/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			setLang(lang) {
				//let lang = this.$$('input[name="language-radio"]:checked').val()
				console.log('lang', lang)
				this.currentLang = lang
			},
			onSubmit: function() {
				const that = this
				Vue.config.lang = that.currentLang
				that.$store.dispatch('setLang', {
					'lang': that.currentLang
				}).then(() => {
					// 动态修改全局的模态配置
					//that.$f7.params.modalTitle = that.$t('app.modal.title')
					that.$f7.params.modalButtonOk = that.$t('app.modal.button_ok')
					that.$f7.params.modalButtonCancel = that.$t('app.modal.button_cancel')
					that.$f7.params.modalPasswordPlaceholder = that.$t('app.modal.password_placeholder')
					that.$f7.alert(that.$t('app.language.language_change'), '', function() {
						console.log('that.$f7', that.$f7)
						console.log('that.$f7 params', that.$f7.params)
						that.$f7.mainView.router.load({
							url: 'home'
						})
					})
				})
			}
		}
	}
</script>