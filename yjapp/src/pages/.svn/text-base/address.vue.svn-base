<template>
	<div data-page='address' class='page address-page'>
		<!-- Top Navbar-->
		<div class='navbar'>
			<div class='navbar-inner'>
				<div class='left' @click="routeBack">
					<a href='javascript:void(0);' class='back icon icon-back'></a>
				</div>
				<div class='center'><span class='text-gradient' v-text="$t('app.page.address')">管理收货地址</span></div>
				<div class='right' style='margin-right: 10px;'>
					<a @click="routeToAddAddress" href='javascript:void(0);' class='text-gradient' style='font-size: 0.26rem;' v-text="$t('app.address.add_address')">管理</a>
				</div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class='page-content'>
			<div class='list-block'>
				<div class='address' v-if="address_list != null">
					<div v-text="$t('app.address.empty_address_tips')" style="text-align: center; width: 100%; margin-top: 1rem;" class="text-gradient" v-if="address_list.length === 0">
						点击右上角管理新增收货地址
					</div>
					<div class='address-box' v-for='(address, index) in address_list'>
						<div @click="onChoiceAddr(address)">
							<div class='userContact clearfloat'>
								<span class='userName'>{{address.ContactName}}</span>
								<span class='userPhone'>{{address.Telephone}}</span>
							</div>
							<div class='userAddress'>{{address.DistrictSummary}} {{address.Address}}</div>
							<div class='userPost'>{{address.PostCode}}</div>
						</div>
						<div class='userDefault clearfloat'>
							<img @click='onDefault(address)' src="../../static/icon/list_Unselected_nor@3x.png" class='default-img' v-show="!address.IsDefault" />
							<img @click='onDefault(address)' src="../../static/icon/list_selected_sel@3x.png" class='default-img' v-show="address.IsDefault" />
							<span @click='onDefault(address)' class='defaule-title text-gradient' v-text="$t('app.address.set_default')">设为默认</span>
							<span @click='onDelete(address, index, address_list)' class='address-delete' v-text="$t('app.address.delete')">删除</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang='less'>
	.address-page {
		.page-content {
			.list-block {
				margin: 0;
				.address {
					.address-box {
						background: #FFFFFF;
						padding-top: 0.32rem;
						margin-bottom: 0.2rem;
						.userContact {
							padding: 0 0.3rem;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #696969;
							letter-spacing: 0.76px;
							line-height: 34px;
							.userPhone {
								float: right;
							}
						}
						.userAddress {
							padding: 0 0.3rem;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #8F8F8F;
							letter-spacing: 0.76px;
							line-height: 0.4rem;
						}
						.userPost {
							padding: 0 0.3rem;
							padding-top: 0.1rem;
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #8F8F8F;
							letter-spacing: 0.76px;
							line-height: 0.4rem;
						}
						.userDefault {
							border-top: 1px solid #eee;
							width: 100%;
							height: 0.8rem;
							margin-top: 0.24rem;
							.default-img {
								padding-left: 0.3rem;
								width: 0.27rem;
								height: 0.27rem;
								line-height: 0.8rem;
								vertical-align: middle;
								margin-right: 0.15rem;
							}
							.defaule-title {
								margin-top: 0.23rem;
								font-family: PingFangSC-Regular;
								font-family: PingFangSC-Medium;
								font-size: 0.26rem;
								letter-spacing: 0.76px;
							}
							.address-delete {
								padding: 0.3rem;
								float: right;
								font-family: PingFangSC-Regular;
								font-size: 0.26rem;
								color: #FF4B4B;
								letter-spacing: 0.76px;
								padding-top: 0.2rem;
							}
						}
					}
				}
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
				address_list: null, //地址管理列表
				fromType: 'member', // 来源页面，默认为member，也可以从订单结算页面跳转过来 order_confirm
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				order_confirm: state => state.order_confirm // 订单结算确认
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
				let query = that.$route.query
				console.log('address query', query)
				that.fromType = query.fromType
				that.getAddressList()
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
						url: '/' + that.fromType + '/?fromType=address'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onChoiceAddr: function(address) {
				const that = this
				console.log('onChoiceAddr', address)
				if(that.fromType === 'order_confirm') {
					// 设置选中的地址信息
					that.$store.dispatch('setOrderConfirmAddress', {
						address: address
					}).then(() => {
						that.routeBack()
					})
				}
			},
			routeToAddAddress: function() {
				const that = this
				if(that.address_list.length < 5) {
					that.$f7.mainView.router.load({
						url: `/add_address/?fromType=${that.fromType}`
					})
				} else {
					that.$f7.alert(that.$t('app.address.limited_add_address'))
				}
			},
			getAddressList: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.address.loading'))
				axios.get('Member/Address/List', {}).then(res => {
					console.log('address res', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.address_list = res.Data
					} else {
						// 判断token是否已过期
						if(res.ErrorInfos[0].ErrorCode === 33555457) {
							that.$f7.alert('登录状态过期，请重新登录', '', function() {
								that.$f7.mainView.router.load({
									url: '/login/'
								})
							})
						} else {
							that.$f7.alert(res.ErrorInfos[0].Message)
						}
					}
				})
			},
			onDefault: function(address) {
				console.log('address onDefault', address)
				const that = this
				axios.get('Member/Address/SetDefault', {
					params: {
						addressId: address.Id
					}
				}).then(res => {
					console.log('addressDefault', res)
					if(res.IsSuccess === true) {
						that.$f7.alert(that.$t('app.address.set_default_success'), '', function() {
							that.getAddressList()
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onDelete: function(address, index, addressList) {
				const that = this
				that.$f7.confirm(that.$t('app.address.sure_delete'), '', function() {
					axios.get('Member/Address/Delete', {
						params: {
							addressId: address.Id
						}
					}).then(res => {
						console.log('isdelect', res)
						if(res.IsSuccess === true) {
							that.$f7.alert(that.$t('app.address.delete_success'), '', function() {
								addressList.splice(index, 1)
							})
						} else {
							that.$f7.alert(res.ErrorInfos[0].Message)
						}
					})
				})
			}
		},
		components: {}
	}
</script>