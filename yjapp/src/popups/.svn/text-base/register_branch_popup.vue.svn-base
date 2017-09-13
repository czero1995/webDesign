<template>
	<div class="popup register-branch-popup">
		<div class="view navbar-fixed">
			<div class="pages">
				<div class="page">
					<div class="navbar">
						<div class="navbar-inner">
							<div class="left" @click="onClosePopup">
								<a href="javascript:void(0);" class="back icon icon-back"></a>
							</div>
							<div class="center text-gradient" v-text="$t('app.register_branch.select_branch_compay')">选择服务国家窗口</div>
							<div class="right" style="padding-right: 0.2rem;">
								<a @click="next" href="javascript:void(0);" class="text-gradient" v-text="$t('app.register_branch.next')">下一步</a>
							</div>
						</div>
					</div>
					<div class="page-content">
						<div class="list-block">
							<ul>
								<li :class="{ active: branch.Value === selected_branch.Value }" @click="onSelectBranch(branch)" v-for="branch in register_branch_list">
									<a href="#" class="item-link item-content">
										<div class="item-content">
											<div class="item-title" v-text="branch.Text"></div>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.register-branch-popup {
		.list-block {
			margin: 0;
			.choose-top {
				background: #FFFFFF;
				width: 100%;
				height: 0.88rem;
				line-height: 0.88rem;
				margin-bottom: 0.2rem;
				.choose-top-box {
					padding: 0 0.3rem;
					position: relative;
					.top-l {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
					.top-c {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						width: 1.2rem;
						height: 0.34rem;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
						position: absolute;
						left: 0;
						right: 0;
						top: 0;
						bottom: 0;
						margin: auto;
						display: inline-block;
					}
					.top-r {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #FF7699;
						letter-spacing: 0.76px;
						line-height: 0.88rem;
						float: right;
					}
				}
			}
			.local {
				height: 1.8rem;
				width: 100%;
				margin-bottom: 0.2rem;
				.local-box {
					height: 1.8rem;
					.item-content {
						width: 100%;
						padding-left: 0;
					}
					width:100%;
					.local-this {
						height: 0.8rem;
						padding-left: 0.3rem;
						width: 100%;
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #BFBFBF;
						width: 100%;
						/*padding-bottom: 0.1rem;*/
						display: block;
						letter-spacing: 0.76px;
						line-height: 0.8rem;
						border-bottom: 1px solid #eee;
					}
					.local-address {
						padding: 0 0.3rem;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #595959;
						letter-spacing: 0.76px;
						line-height: 0.8rem;
					}
				}
			}
			>ul {
				>li {
					border-bottom: 1px solid #eee;
					padding-left: 0.3rem;
					.local-this {
						width: 100%;
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #BFBFBF!important;
						width: 100%;
						display: block;
						letter-spacing: 0.76px;
						vertical-align: middle;
					}
					.item-content {
						height: 0.88rem;
						line-height: 0.88rem;
						font-size: 0.26rem;
						padding-left: 0;
						.item-title {
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #5A5A5A;
							letter-spacing: 0.76px;
							line-height: 0.34rem;
						}
					}
					&.active {
						background-color: #CDB87B;
						.item-title {
							color: #fff;
						}
					}
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
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				selected_branch: {
					Text: '',
					Value: ''
				}
			}
		},
		computed: {
			...mapState({
				register_branch: state => state.register_branch,
				register_branch_list: state => state.register_branch_list
			})
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				console.log('register_branch_popup')
			})
		},
		methods: {
			onClosePopup: function() {
				this.$f7.closeModal('.register-branch-popup')
			},
			onFinishSelect: function() {
				//this.$f7.closeModal('.register-branch-popup')
				this.$f7.closeModal()
			},
			onSelectBranch(branch) {
				console.log('onSelectBranch', branch)
				const that = this
				that.selected_branch = branch
			},
			next: function() {
				const that = this
				if(that.selected_branch.Value.trim().length === 0) {
					that.$f7.alert(that.$t('app.register_branch.select_branch_compay'))
				} else {
					console.log('selected_branch', that.selected_branch)
					// 设置选中国家信息
					that.$store.dispatch('setRegisterBranchCountry', {
						type: 'register_branch',
						code: that.selected_branch.Value,
						name: that.selected_branch.Text
					}).then(() => {
						// 重置已选中的证件国籍
						that.$store.dispatch('setRegisterBranchCountry', {
							type: 'register_country',
							code: '',
							name: ''
						}).then(() => {
							that.$f7.showPreloader(that.$t('app.register_branch.loading_register_country'))
							axios.get('Member/Common/GetSupportCertificateCountryByBranchCompanyId', {
								params: {
									companyId: that.register_branch.code
								}
							}).then(res => {
								console.log('getRegisterCountry', res)
								that.$f7.hidePreloader()
								if(res.IsSuccess === true) {
									that.$store.dispatch('setRegisterCountry', {
										countryList: res.Data
									}).then(() => {
										that.$f7.popup('.register-country-popup')
									})
								} else {
									that.$f7.alert(res.ErrorInfos[0].Message)
								}
							})
						})
					})
				}
			}
		},
		components: {}
	}
</script>