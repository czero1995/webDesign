<template>
	<div data-page="country-list" class="page country-list-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.branch_list')">国家窗口</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li v-for="branch in branch_company_list" v-bind:class="{ active: currentBranch.Value === branch.Value }" @click="setBranch(branch)">
						<div class="item-content">
							<div class="item-inner">
								<div class="item-title" v-text="branch.Text">国家窗口名称</div>
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
	.country-list-page {
		.page-content {
			padding-bottom: 50px;
			background-color: rgba(0, 0, 0, 0.7);
			.list-block {
				margin: 0px;
				border: none;
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
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				currentBranch: {
					Text: '',
					Value: ''
				}
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				branch_company_list: state => state.branch_company_list, // 支持的分公司列表
				branch_company_id: state => state.branch_company_id, // 当前选中的分公司id
				branch_company_name: state => state.branch_company_name // 当前选中的分公司名称
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
				that.currentBranch = {
					'Text': that.branch_company_name,
					'Value': that.branch_company_id + ''
				}
				that.getBranchCompanyList()
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
			getBranchCompanyList: function() {
				const that = this
				axios.get('Member/Common/GetBranchCompanyList').then(res => {
					if(res.IsSuccess === true) {
						that.$store.dispatch('setBranchCompanyList', {
							branchCompanyList: res.Data
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			setBranch(branch) {
				console.log('branch', branch)
				const that = this
				that.currentBranch = {
					'Text': branch.Text,
					'Value': branch.Value
				}
			},
			onSubmit: function() {
				const that = this
				console.log('currentBranch', that.currentBranch)
				that.$store.dispatch('setBranchCompany', {
					id: that.currentBranch.Value,
					name: that.currentBranch.Text
				}).then(() => {
					that.$f7.alert(that.$t('app.branch_company.branch_change'), '', function() {
						console.log('that.$f7', that.$f7.params)
						that.$f7.mainView.router.load({
							url: 'home'
						})
					})
				})
			}
		},
		components: {}
	}
</script>