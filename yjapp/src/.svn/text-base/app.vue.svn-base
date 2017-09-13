<template>
	<!-- App -->
	<div id="app">
		<!-- Statusbar -->
		<f7-statusbar></f7-statusbar>
		<!-- Main Views -->
		<f7-views>
			<f7-view id="main-view" main :domCache='false'>
				<f7-pages>
					<home-view></home-view>
				</f7-pages>
			</f7-view>
		</f7-views>
		<!-- setting, language Popup -->
		<!--<language-popup></language-popup>-->
		<!--提交成功-->
		<!--<success-modal></success-modal>-->
		<!--注册失败-->
		<!--<fail-modal></fail-modal>-->
		<!--提示结算日-->
		<!--<tips-count-modal></tips-count-modal>-->
		<!--残忍拒绝-->
		<!--<refuse-modal></refuse-modal>-->
		<!--果断支付-->
		<!--<pay-modal></pay-modal>-->
		<!--果断支付EP2-->
		<!--<pay-ep2-modal></pay-ep2-modal>-->
		<!--等待好友支付-->
		<!--<wait-friend-pay-modal></wait-friend-pay-modal>-->
		<!--确定收货-->
		<!--<insure-take-delivery-modal></insure-take-delivery-modal>-->
		<!--系统提示具体地址-->
		<!--<tips-addr-modal></tips-addr-modal>-->
		<!--服务中心自提-->
		<!--<service-delivery-modal></service-delivery-modal>-->
		<!--柜台领取-->
		<!--<counter-delivery-modal></counter-delivery-modal>-->
		<!--<tips-count-modal></tips-count-modal>-->
		<!--<div id="customer-modal" class="customer-modal" style="display: none;"></div>-->
		<select-province-popup></select-province-popup>
		<select-city-popup></select-city-popup>
		<select-district-popup></select-district-popup>
		<select-race-popup></select-race-popup>
		<address-country-popup></address-country-popup>
		<address-province-popup></address-province-popup>
		<address-city-popup></address-city-popup>
		<address-district-popup></address-district-popup>
		<register-branch-popup></register-branch-popup>
		<register-country-popup></register-country-popup>
	</div>
</template>

<style lang="less">
	.app-page {
		.page-content {
			padding-bottom: 44px;
		}
	}
</style>

<script>
	import { mapState } from 'vuex'
	import TabbarView from './pages/tabbar.vue'
	import HomeView from './pages/home.vue'
	import CartView from './pages/cart.vue'
	import OrderView from './pages/order.vue'
	import MemberView from './pages/member.vue'
	import SuccessModal from './components/success_modal.vue'
	import FailModal from './components/fail_modal.vue'
	import TipsCountModal from './components/tips_count_modal.vue'
	import RefuseModal from './components/refuse_modal.vue'
	import PayModal from './components/pay_modal.vue'
	import PayEp2Modal from './components/pay_ep2_modal.vue'
	import WaitFriendPayModal from './components/wait_friend_pay_modal.vue'
	import InsureTakeDeliveryModal from './components/insure_take_delivery_modal.vue'
	import TipsAddrModal from './components/tips_addr_modal.vue'
	import ServiceDeliveryModal from './components/service_delivery_modal.vue'
	import CounterDeliveryModal from './components/counter_delivery_modal.vue'
	import SelectProvincePopup from './popups/select_province_popup.vue'
	import SelectCityPopup from './popups/select_city_popup.vue'
	import SelectDistrictPopup from './popups/select_district_popup.vue'
	import SelectRacePopup from './popups/select_race_popup.vue'
	import AddressCountryPopup from './popups/address_country_popup.vue'
	import AddressProvincePopup from './popups/address_province_popup.vue'
	import AddressCityPopup from './popups/address_city_popup.vue'
	import AddressDistrictPopup from './popups/address_district_popup.vue'
	import RegisterBranchPopup from './popups/register_branch_popup.vue'
	import RegisterCountryPopup from './popups/register_country_popup.vue'

	export default {
		data() {
			return {
				activedTab: 'home'
			}
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				console.log('app vue mouted')
				console.log('app vue plusReady = ' + that.plusReady)
			})
		},
		computed: {
			...mapState({}),
		},
		methods: {},
		components: {
			TabbarView,
			HomeView,
			CartView,
			OrderView,
			MemberView,
			SuccessModal,
			FailModal,
			TipsCountModal,
			RefuseModal,
			PayModal,
			PayEp2Modal,
			WaitFriendPayModal,
			InsureTakeDeliveryModal,
			TipsAddrModal,
			ServiceDeliveryModal,
			CounterDeliveryModal,
			SelectProvincePopup,
			SelectCityPopup,
			SelectDistrictPopup,
			SelectRacePopup,
			AddressCountryPopup,
			AddressProvincePopup,
			AddressCityPopup,
			AddressDistrictPopup,
			RegisterBranchPopup,
			RegisterCountryPopup
		}
	}
</script>