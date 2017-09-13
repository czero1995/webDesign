import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import * as getters from './getters'
import * as actions from './actions'
import mutations from './mutations'
import StoreCache from '../utils/storeCache'

Vue.use(Vuex)
let cache = new StoreCache('vuex')
const state = {
	plusReady: false,
	version: '1.6.0',
	needUpdate: false, // 是否需要更新
	downloadUrl: '', // 应用更新下载地址
	salesArea: {
		'purchaseArea': 1, // 购货区
		'reSaleArea': 2, // 重消区
		'retailArea': 4 // 消费者零售区
	},
	gender: {
		'male': 0, // 男
		'femal': 1, // 女
		'unknow': 2 // 未知
	},
	paymentWay: null, // 根据购货区获取支付方式
	merchantCartFee: {
		freight: '', // 运费
		tax: '' // 税费
	},
	get_cart: [], //购物车
	order_list: [], //订单列表
	order_details: null, // 订单详情
	order_confirm: null, // 订单结算确认
	order_confirm_address: null, // 物流输送地址详细信息
	order_confirm_invoiceType: 1, // 订单确认选择的发票类型
	agreementInfo: null, // 登录协议
	showTermSettlementInfo: cache.get('show_term_settlement') || true, // 是否显示结算日提醒
	hideTermSettlementDate: cache.get('hide_term_settlement_date') || '', // 不显示结算提醒的日期
	showModal: false, // 手动打开遮罩层
	loading: false, // 异步请求接口的时候，是否开启加载中的提示，默认不开启
	user: cache.get('user') || null, // 用户信息
	user_type: cache.get('user_type') || 0, // 用户类型，默认为访客(0)，其他的有会员(1)、消费者(3)
	isSetDetail: cache.get('isSetDetail') || false, // 会员是否填写详细信息
	confirmAgreement: cache.get('confirmAgreement') || false, // 会员是否已同意服务条款
	introducer: null, // 推荐者信息
	branch_company_id: cache.get('branch_company_id)') || 1, // 分公司窗口代码，默认为11
	branch_company_name: cache.get('branch_company_name') || '马来西亚国家窗口', // 分公司窗口名称，默认为YJW窗口
	branch_company_list: [], // 支持的分公司窗口列表
	country_list: [], // 获取分公司支持的证件国家列表
	province_list: [], //获取省列表
	city_list: [], // 获取城市列表
	district_list: [], //获取区域列表
	my_race_list: [], // 马来西亚种族列表
	personal_race: {
		name: '',
		code: ''
	},
	company_race: {
		name: '',
		code: ''
	},
	fill_info_type: 'personal', // 填写信息的类型 personal, company
	personal_province: {
		name: '',
		code: ''
	}, // 已经选中的国家一级地区
	personal_city: {
		name: '',
		code: ''
	}, // 已经选中的城市信息
	personal_district: {
		name: '',
		code: ''
	}, // 已经选中的地区信息
	company_province: {
		name: '',
		code: ''
	}, // 已经选中的国家一级地区
	company_city: {
		name: '',
		code: ''
	}, // 已经选中的城市信息
	company_district: {
		name: '',
		code: ''
	}, // 已经选中的地区信息
	address_country_list: [],
	address_province_list: [],
	address_city_list: [],
	address_district_list: [],
	address_country: {
		name: '',
		code: '',
	},
	address_province: {
		name: '',
		code: ''
	},
	address_city: {
		name: '',
		code: ''
	},
	address_district: {
		name: '',
		code: ''
	},
	register_branch_list: [], // 注册时的服务国家窗口列表,
	register_country_list: [], // 注册时的证件国籍列表
	register_branch: {
		name: '',
		code: ''
	},
	register_country: {
		name: '',
		code: ''
	},
	lang: cache.get('lang') || 'zh-CN', // 当前的语言版本，默认为简体中文
	token: cache.get('token') || '', // 登录状态调用接口的token
	qrcode: cache.get('qrcode') || '', // 会员的专属二维码
	register: {}, //注册
	register_info: {}, //注册信息
	address_list: null, //地址管理列表
	tip_count: null, //期结算提示
	my_wallet: null, //我的钱包
	product_list: [], //首页商品列表	
	goods_list: [], //购货商品列表	
	product_detail: {}, //首页产品详情页
	product_detail_price: {}, //产品详情价格
	home_info: {}, //首页会员信息
	home_info_direct: {}, //本周个人销售奖
	home_info_rebate: {}, //本周回馈奖
	home_info_retail: {}, //本期零售奖
	banner_list: [], // 首页轮播图
	ajax_result: {
		isSuccess: null, // null 表示没有调用， true 表示调用成功， false 表示调用出错
		errorInfos: null // 调用接口的错误信息
	}
}

if(cache.get('token')) {
	console.log('set axios token')
	axios.defaults.headers.common['Authorization'] = 'Basic ' + cache.get('token')
}
if(cache.get('lang')) {
	console.log('set axios lang')
	axios.defaults.headers.common['lang'] = cache.get('lang')
}

export default new Vuex.Store({
	state,
	getters,
	actions,
	mutations
})