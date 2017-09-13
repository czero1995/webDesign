<template>
	<div data-page="add-address" class="page add-address-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.add_address')">新增收货地址</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li>
						<input type="text" class="address-input" :placeholder="$t('app.add_address.contactName')" v-model="addressInfo.contactName" />
					</li>
					<li>
						<input type="text" class="address-input" :placeholder="$t('app.add_address.telephone')" v-model="addressInfo.telephone" />
					</li>
					<li>
						<a @click="onSelectCountry" href="javascript:void(0);" class="item-link item-content">
							<div class="item-inner choose-country">
								<div class="item-title"><span v-text="$t('app.add_address.choice_country')">请选择国家</span>
								</div>
							</div>
						</a>
					</li>
					<li v-if="address_country.code.trim().length > 0">
						<a class="item-content">
							<div class="item-inner choose-country">
								{{address_country.name}} {{address_province.name}} {{address_city.name}} {{address_district.name}}
							</div>
						</a>
					</li>
					<li>
						<textarea name="" rows="" cols="" class="address-detail" :placeholder="$t('app.add_address.address')" v-model="addressInfo.address"></textarea>
					</li>
					<li>
						<input type="text" class="address-input" :placeholder="$t('app.add_address.postCode')" v-model="addressInfo.postCode" />
					</li>
				</ul>
			</div>
		</div>
		<div class="toolbar address-save" @click="onSubmit" :class="{ active: canSubmit }">
			<p v-text="$t('app.add_address.submit')">保存收货地址</p>
		</div>
	</div>
</template>

<style lang="less">
	.add-address-page {
		.page-content {
			padding-bottom: 50px;
			margin-bottom: 50px;
		}
		.list-block {
			margin: 0;
			>ul {
				>li {
					border-bottom: 1px solid #eee;
					padding-left: 0.3rem;
					padding-right: 0.3rem;
				}
			}
			.address-input {
				width: 100%;
				height: 0.88rem;
				font-family: PingFangSC-Regular;
				font-size: 0.26rem;
				letter-spacing: 0.76px;
				line-height: 0.34rem;
				&::-webkit-input-placeholder {
					color: #B2B2B2;
				}
			}
			.choose-country {
				height: 0.88rem;
				font-family: PingFangSC-Regular;
				font-size: 0.26rem;
				color: #5A5A5A;
				letter-spacing: 0.76px;
				line-height: 0.34rem;
			}
			.choose-country:after {
				display: none;
			}
			.address-detail {
				width: 100%;
				height: 1.93rem;
				font-family: PingFangSC-Regular;
				font-size: 0.26rem;
				/*color: #B2B2B2;*/
				letter-spacing: 0.76px;
				line-height: 0.34rem;
				&::-webkit-input-placeholder {
					color: #B2B2B2;
				}
			}
		}
		.address-save {
			width: 100%;
			height: 0.98rem;
			position: absolute;
			bottom: 0;
			text-align: center;
			font-family: PingFangSC-Regular;
			font-size: 0.3rem;
			color: #FFFFFF;
			letter-spacing: 0;
			background-color: #B2B2B2;
			&.active {
				background-image: url(../../static/icon/list_bg_content_select_sel@3x.png);
			}
		}
		.list-block .item-link .item-inner,
		.list-block .list-button .item-inner {
			background-size: 0.16rem 0.3rem!important;
		}
		.list-block .item-content {
			padding-left: 0;
		}
		.clearfloat::after {
			display: block;
			content: '';
			height: 0;
			width: 0;
			clear: both
		}
	}
</style>
<script>
	import axios from 'axios'
	import { mapState } from 'vuex'
	export default {
		data() {
			return {
				addressInfo: {
					address: '',
					stateId: '',
					cityId: '',
					districtId: '',
					postCode: '',
					isDefault: false, // 这里要设置为false
					countryCode: '',
					telephone: '',
					contactName: '',
					fromType: 'member', // 来源页面，默认是从会员中心进入地址管理的，也可以从订单结算跳转过来
				}
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user,
				address_country: state => state.address_country,
				address_province: state => state.address_province,
				address_city: state => state.address_city,
				address_district: state => state.address_district,
			}),
			canSubmit: function() {
				const that = this
				var submittable = true
				if(that.addressInfo.contactName.trim().length === 0) {
					submittable = false
				}
				if(that.addressInfo.telephone.trim().length === 0) {
					submittable = false
				}
				if(that.addressInfo.address.trim().length === 0) {
					submittable = false
				}
				if(that.addressInfo.postCode.trim().length === 0) {
					submittable = false
				}
				return submittable
			}
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
				// 默认清除已经选择过的地区信息
				that.$store.dispatch('setAddressInfo', {
					type: 'address_country',
					code: '',
					name: ''
				})
				that.$store.dispatch('setAddressInfo', {
					type: 'address_province',
					code: '',
					name: ''
				})
				that.$store.dispatch('setAddressInfo', {
					type: 'address_city',
					code: '',
					name: ''
				})
				that.$store.dispatch('setAddressInfo', {
					type: 'address_district',
					code: '',
					name: ''
				})
				let query = that.$route.query
				that.fromType = query.fromType
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
						url: `/address/?fromType=${that.fromType}`
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			onSelectCountry: function() {
				console.log('onSelectCountry')
				const that = this
				that.$f7.showPreloader('正在加载证件国籍数据...')
				axios.get('Member/Common/GetSupportCertificateCountryByBranchCompanyId', {
					params: {
						companyId: that.user.BranchCompanyId
					}
				}).then(res => {
					console.log('getAddressCountry', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.$store.dispatch('setAddressCountry', {
							country_list: res.Data
						}).then(() => {
							that.$f7.popup('.address-country-popup')
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onSubmit: function() {
				const that = this
				if(that.canSubmit) {
					if(that.address_country.code.trim().length === 0) {
						that.$f7.alert(that.$t('app.add_address.require_choice_country'))
					} else {
						that.$f7.showPreloader(that.$t('app.add_address.loading'))
						that.addressInfo.countryCode = that.address_country.code
						that.addressInfo.stateId = that.address_province.code
						that.addressInfo.cityId = that.address_city.code
						that.addressInfo.districtId = that.address_district.code
						axios.post('Member/Address/AddAddress', {
							'Address': that.addressInfo.address,
							'StateId': that.addressInfo.stateId,
							'CityId': that.addressInfo.cityId,
							'DistrictId': that.addressInfo.districtId,
							'PostCode': that.addressInfo.postCode,
							'IsDefault': that.addressInfo.isDefault,
							'CountryCode': that.addressInfo.countryCode,
							'Telephone': that.addressInfo.telephone,
							'ContactName': that.addressInfo.contactName
						}).then(res => {
							console.log('res', res)
							that.$f7.hidePreloader()
							if(res.IsSuccess === true) {
								// 新增地址成功
								that.routeBack()
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
					}
				}
			}
		},
		components: {}
	}
</script>