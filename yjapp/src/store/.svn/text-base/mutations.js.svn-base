import Vue from 'vue'
import axios from 'axios'
import * as types from './mutation-types'
import StoreCache from '../utils/storeCache'

let cache = new StoreCache('vuex')

export default {
	[types.SET_PLUS_READY](state, {
		isReady
	}) {
		Vue.set(state, 'plusReady', isReady)
	},
	[types.SET_AJAX_RESULT](state, {
		isSuccess,
		errorInfos
	}) {
		Vue.set(state, 'ajax_result', {
			isSuccess: isSuccess,
			errorInfos: errorInfos
		})
	},
	[types.SET_OPENED_POPUP](state, {
		popup
	}) {
		Vue.set(state, 'opened_popup', popup)
	},
	[types.SET_AGREEMENT](state, {
		agreementInfo
	}) {
		Vue.set(state, 'agreementInfo', agreementInfo)
	},
	[types.INIT_USER_INFO](state, {
		user
	}) {
		Vue.set(state, 'user', user)
		cache.set('user', user)
	},
	[types.LOGOUT](state) {
		// 退出登录，重置信息
		Vue.set(state, 'user_type', 0)
		cache.set('user_type', 0)
		Vue.set(state, 'user', null)
		cache.set('user', null)
		Vue.set(state, 'token', '')
		cache.set('token', '')
		Vue.set(state, 'qrcode', '')
		cache.set('qrcode', '')
		Vue.set(state, 'isSetDetail', false)
		cache.set('isSetDetail', false)
		Vue.set(state, 'confirmAgreement', false)
		cache.set('confirmAgreement', false)
	},
	[types.SET_INTRODUCER](state, {
		introducer
	}) {
		Vue.set(state, 'introducer', introducer)
	},
	[types.SET_ADDRESS_LIST](state, {
		address_list
	}) {
		console.log('mutation set address list', address_list)
		Vue.set(state, 'address_list', address_list)
	},
	[types.SET_TIP_COUNT](state, {
		tip_count
	}) {
		console.log('mutation set tip_count', tip_count)
		Vue.set(state, 'tip_count', tip_count)
	},
	[types.SET_SHOW_TERM_SETTLEMENT_INFO](state, {
		showTermSettlementInfo
	}) {
		console.log('showTermSettlementInfo', showTermSettlementInfo)
		Vue.set(state, 'showTermSettlementInfo', showTermSettlementInfo)
		cache.set('show_term_settlement', showTermSettlementInfo)
	},
	[types.SET_HIDE_TERM_SETTLEMENT_DATE](state, {
		hideTermSettlementDate
	}) {
		console.log('hideTermSettlementDate', hideTermSettlementDate)
		Vue.set(state, 'hideTermSettlementDate', hideTermSettlementDate)
		cache.set('hide_term_settlement_date', hideTermSettlementDate)
	},
	[types.SET_MY_BONUS](state, {
		my_bonus
	}) {
		console.log('mutation set my_bonus', my_bonus)
		my_bonus.BonusList.forEach(function(item) {
			item.showBonusDetails = false
			console.log('createDate before', item.CreateDate)
			// 格式化时间格式
			var createDate = new Date(item.CreateDate)
			item.CreateDate = createDate.getFullYear() + '-' + (createDate.getMonth() + 1) + '-' + createDate.getDate()
			console.log('createDate after', item.CreateDate)
		})
		Vue.set(state, 'my_bonus', my_bonus)
		Vue.set(state, 'agent_level_info', my_bonus.AgentLevelInfo)
		Vue.set(state, 'bonus_simple_summary', my_bonus.BonusSimpleSummary)
		Vue.set(state, 'bonus_list', my_bonus.BonusList)
	},
	[types.SET_MY_WALLET](state, {
		my_wallet
	}) {
		console.log('mutation set my_wallet', my_wallet)
		Vue.set(state, 'my_wallet', my_wallet)
	},
	[types.SET_PRODUCT_LIST](state, {
		product_list
	}) {
		console.log('mutation set product_list', product_list)
		Vue.set(state, 'product_list', product_list)
	},
	[types.SET_PRODUCT_DETAIL](state, {
		product_detail
	}) {
		console.log('mutation set product_detail', product_detail)
		Vue.set(state, 'product_detail', product_detail)
		Vue.set(state, 'product_detail_price', product_detail.Price)
	},
	[types.SET_GOODS_LIST](state, {
		goods_list
	}) {
		console.log('mutation set goods_list', goods_list)
		Vue.set(state, 'goods_list', goods_list)
	},
	[types.SET_PAYMENT_WAY](state, {
		paymentWay
	}) {
		Vue.set(state, 'paymentWay', paymentWay)
	},
	[types.SET_ORDER_CONFIRM](state, {
		order_confirm
	}) {
		console.log('mutation set order confirm', order_confirm)
		Vue.set(state, 'order_confirm', order_confirm)
	},
	[types.SET_INVOICE_TYPE](state, {
		invoiceType
	}) {
		console.log('mutation set invoice type', invoiceType)
		Vue.set(state, 'order_confirm_invoiceType', invoiceType)
	},
	[types.SET_ORDER_CONFIRM_ADDRESS](state, {
		address
	}) {
		console.log('mutation set order confirm address', address)
		Vue.set(state, 'order_confirm_address', address)
	},
	[types.SET_ORDER_LIST](state, {
		order_list
	}) {
		console.log('mutation set order_list', order_list)
		Vue.set(state, 'order_list', order_list)
	},
	[types.SET_ORDER_DETAILS](state, {
		order_details
	}) {
		console.log('mutation set order_details', order_details)
		Vue.set(state, 'order_details', order_details)
	},
	[types.SET_HOME_INFO](state, {
		homeInfo
	}) {
		console.log('mutation set home_info', homeInfo)
		Vue.set(state, 'home_info', homeInfo)
		if(homeInfo != null) {
			Vue.set(state, 'home_info_direct', homeInfo.DirectIntroducerBonus)
			Vue.set(state, 'home_info_rebate', homeInfo.RebateBonus)
			Vue.set(state, 'home_info_retail', homeInfo.RetailBonus)
		}
	},
	[types.SET_REGISTER_COUNTRY_LIST](state, {
		country_list
	}) {
		console.log('mutation set address country list', country_list)
		Vue.set(state, 'register_country_list', country_list)
	},
	[types.SET_REGISTER_INFO](state, {
		register_info
	}) {
		console.log('mutation set register_info', register_info)
		Vue.set(state, 'register_info', register_info)
	},
	[types.SET_FILL_INFO_TYPE](state, {
		fill_info_type
	}) {
		console.log('mutation set fill info type', fill_info_type)
		Vue.set(state, 'fill_info_type', fill_info_type)
	},
	[types.SET_PROVINCE_LIST](state, {
		province_list
	}) {
		console.log('mutation set province_list', province_list)
		Vue.set(state, 'province_list', province_list)
	},
	[types.SET_CITY_LIST](state, {
		city_list
	}) {
		console.log('mutation set city_list', city_list)
		Vue.set(state, 'city_list', city_list)
	},
	[types.SET_DISTRICT_LIST](state, {
		district_list
	}) {
		console.log('mutation set district_list', district_list)
		Vue.set(state, 'district_list', district_list)
	},
	[types.SET_FILL_INFO_ADDR](state, {
		type,
		code,
		name
	}) {
		console.log('mutation set ' + type, name)
		Vue.set(state, type, {
			code: code,
			name: name
		})
	},
	[types.SET_RACE_INFO](state, {
		type,
		code,
		name
	}) {
		console.log('mutation set ' + type, name)
		Vue.set(state, type, {
			code: code,
			name: name
		})
	},
	[types.SET_REGISTER_BRANCH_COUNTRY](state, {
		type,
		code,
		name
	}) {
		console.log('mutation set ' + type, name)
		Vue.set(state, type, {
			code: code,
			name: name
		})
	},
	[types.SET_BANNER_LIST](state, {
		bannerList
	}) {
		console.log('mutation set banner list', bannerList)
		Vue.set(state, 'banner_list', bannerList)
	},
	[types.SET_GET_CART](state, {
		get_cart
	}) {
		console.log('mutation set get_cart', get_cart)
		get_cart.forEach(function(item) {
			item.OrderMerchantProducts.forEach(function(product) {
				product.selected = true
			})
			item.selectAll = true // 是否全选，默认为true
			item.swipeout = false // 是否开启编辑，默认为false
		})
		Vue.set(state, 'get_cart', get_cart)
	},
	[types.UPDATE_LANG](state, lang) {
		Vue.set(state, 'lang', lang)
		cache.set('lang', lang)
		axios.defaults.headers.common['lang'] = lang
	},
	[types.SET_QRCODE](state, qrcode) {
		Vue.set(state, 'qrcode', qrcode)
		cache.set('qrcode', qrcode)
	},
	[types.SET_USER_TYPE](state, userType) {
		Vue.set(state, 'user_type', userType)
		cache.set('user_type', userType)
	},
	[types.SET_IS_SET_DETAIL](state, isSetDetail) {
		Vue.set(state, 'isSetDetail', isSetDetail)
		cache.set('isSetDetail', isSetDetail)
	},
	[types.SET_CONFIRM_AGREEMENT](state, confirmAgreement) {
		Vue.set(state, 'confirmAgreement', confirmAgreement)
		cache.set('confirmAgreement', confirmAgreement)
	},
	[types.SET_BRANCH_COMPANY](state, {
		id,
		name
	}) {
		console.log('mutations SET_BRANCH_COMPANY id', id)
		console.log('mutations SET_BRANCH_COMPANY name', name)
		Vue.set(state, 'branch_company_id', id)
		Vue.set(state, 'branch_company_name', name)
		cache.set('branch_company_id', id)
		cache.set('branch_company_name', name)
	},
	[types.SET_ACCESS_TOKEN](state, token) {
		console.log('set access token', token)
		Vue.set(state, 'token', token)
		axios.defaults.headers.common['Authorization'] = 'Basic ' + token
		cache.set('token', token)
		console.log('axios defaults', axios.defaults)
	},
	[types.SET_BRANCH_COMPANY_LIST](state, {
		branch_company_list
	}) {
		console.log('branch_company_list', branch_company_list)
		Vue.set(state, 'branch_company_list', branch_company_list)
		Vue.set(state, 'register_branch_list', branch_company_list)
	},
	[types.SET_MY_RACE_LIST](state, {
		my_race_list
	}) {
		console.log('my_race_list', my_race_list)
		Vue.set(state, 'my_race_list', my_race_list)
	},
	[types.SET_ADDRESS_COUNTRY_LIST](state, {
		country_list
	}) {
		console.log('mutation set address country list', country_list)
		Vue.set(state, 'address_country_list', country_list)
	},
	[types.SET_ADDRESS_PROVINCE_LIST](state, {
		province_list
	}) {
		console.log('mutation set address province list', province_list)
		Vue.set(state, 'address_province_list', province_list)
	},
	[types.SET_ADDRESS_CITY_LIST](state, {
		city_list
	}) {
		console.log('mutation set address city list', city_list)
		Vue.set(state, 'address_city_list', city_list)
	},
	[types.SET_ADDRESS_DISTRICT_LIST](state, {
		district_list
	}) {
		console.log('mutation set address district list', district_list)
		Vue.set(state, 'address_district_list', district_list)
	},
	[types.SET_ADDRESS_INFO](state, {
		type,
		code,
		name
	}) {
		console.log('mutation set address info', type + ' ' + code + ' ' + name)
		Vue.set(state, type, {
			code: code,
			name: name
		})
	}
}