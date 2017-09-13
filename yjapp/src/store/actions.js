import axios from 'axios'
import * as types from './mutation-types'

export function plusReady({
	commit
}, {
	isReady
}) {
	commit(types.SET_PLUS_READY, {
		isReady: isReady
	})
}
// 设置调用接口返回结果
export function setAjaxResult({
	commit
}, {
	isSuccess,
	errorInfos
}) {
	commit(types.SET_AJAX_RESULT, {
		isSuccess: isSuccess,
		errorInfos: errorInfos
	})
}
// 登录
export function login({
	commit
}, {
	data
}) {
	if(data !== null) {
		commit(types.INIT_USER_INFO, {
			user: data.AgentInfo
		})
		commit(types.SET_ACCESS_TOKEN, data.AccessToken)
		commit(types.SET_USER_TYPE, data.AgentInfo.UserType)
		commit(types.SET_IS_SET_DETAIL, data.AgentInfo.IsSetDetail)
		commit(types.SET_CONFIRM_AGREEMENT, data.AgentInfo.ConfirmAgreement)
	} else {
		commit(types.INIT_USER_INFO, {
			user: null
		})
		commit(types.SET_ACCESS_TOKEN, null)
		commit(types.SET_USER_TYPE, 0)
		commit(types.SET_IS_SET_DETAIL, false)
		commit(types.SET_CONFIRM_AGREEMENT, false)
	}
}

// 获取登录协议
export function getAgreement({
	commit
}, {
	branchCompanyId
}) {
	axios.get('Member/Member/GetSignUpAgreement', {
		params: {
			branchCompanyId: branchCompanyId
		}
	}).then(res => {
		console.log('getRegisterCountry', res.Data)
		if(res.IsSuccess === true) {
			commit(types.SET_AGREEMENT, {
				agreementInfo: res.Data
			})
		}
	})
}

// 设置是否已经同意条款
export function setConfirmAgreement({
	commit
}, {
	confirmAgreement
}) {
	commit(types.SET_CONFIRM_AGREEMENT, confirmAgreement)
}

// 设置是否已经设置详情
export function setIsSetDetail({
	commit
}, {
	isSetDetail
}) {
	commit(types.SET_IS_SET_DETAIL, isSetDetail)
}

// 根据分公司获取证件国籍
export function getRegisterCountry({
	commit
}, {
	branchCompanyId
}) {
	axios.get('Member/Common/GetSupportCertificateCountryByBranchCompanyId', {
		params: {
			companyId: branchCompanyId
		}
	}).then(res => {
		console.log('getRegisterCountry', res)
		if(res.IsSuccess === true) {
			commit(types.SET_REGISTER_COUNTRY_LIST, {
				country_list: res.Data
			})
		}
	})
}

// 设置注册时选择的分公司证件国籍列表
export function setRegisterCountry({
	commit
}, {
	countryList
}) {
	commit(types.SET_REGISTER_COUNTRY_LIST, {
		country_list: countryList
	})
}

// 注册会员
export function registerMember({
	commit
}, {
	createrLoginId,
	fullName,
	email,
	telephone,
	branchCompanyId,
	certificateCountryCode,
	idCardNumber,
	birthday
}) {
	console.log('action registerMember', certificateCountryCode)
	axios.post('Member/Member/CreateNew', {
		'CreaterLoginId': createrLoginId,
		'FullName': fullName,
		'Email': email,
		'Telephone': telephone,
		'BranchCompanyId': branchCompanyId,
		'CertificateCountryCode': certificateCountryCode,
		'IdCardNumber': idCardNumber,
		'Birthday': birthday
	}).then(res => {
		console.log('register res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		if(res.IsSuccess === true) {
			commit(types.SET_REGISTER_INFO, {
				register_info: res.Data
			})
		} else {}
	})
}

// 注册消费者
export function registerConsumer({
	commit
}, {
	branchCompanyId,
	certificateCountryCode,
	idCardNumber,
	email,
	fullName,
	introducerLoginId,
	introducerName,
	telephone,
	password
}) {
	axios.post('Member/Consumer/CreateNew', {
		'BranchCompanyId': branchCompanyId,
		'CertificateCountryCode': certificateCountryCode,
		'IdCardNumber': idCardNumber,
		'Email': email,
		'FullName': fullName,
		'IntroducerLoginId': introducerLoginId,
		'IntroducerName': introducerName,
		'Telephone': telephone,
		'Password': password
	}).then(res => {
		console.log('register res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		if(res.IsSuccess === true) {
			commit(types.SET_REGISTER_INFO, {
				register_info: res.Data
			})
		} else {}
	})
}

// 获取推荐者信息
export function getIntroducerInfo({
	commit
}, {
	IntroducerLoginId
}) {
	axios.get('Member/Account/GetAgentSimpleInfo', {
		params: {
			loginId: IntroducerLoginId
		}
	}).then(res => {
		console.log('GetAgentSimpleInfo res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		commit(types.SET_INTRODUCER, {
			introducer: res.Data
		})
	})
}

export function setIntroducerInfo({
	commit
}, {
	introducerInfo
}) {
	commit(types.SET_INTRODUCER, {
		introducer: introducerInfo
	})
}

// 设置填写信息类型 personal  company
export function setFillInfoType({
	commit
}, {
	fill_info_type
}) {
	commit(types.SET_FILL_INFO_TYPE, {
		fill_info_type: fill_info_type
	})
}

// 填写资料时选择省市区
export function setFillInfoAddr({
	commit
}, {
	type,
	code,
	name
}) {
	commit(types.SET_FILL_INFO_ADDR, {
		type: type,
		code: code,
		name: name
	})
}

// 填写资料时选择种族
export function setRaceInfo({
	commit
}, {
	type,
	code,
	name
}) {
	commit(types.SET_RACE_INFO, {
		type: type,
		code: code,
		name: name
	})
}

// 设置注册时填写的国家窗口及证件国籍
export function setRegisterBranchCountry({
	commit
}, {
	type,
	code,
	name
}) {
	commit(types.SET_REGISTER_BRANCH_COUNTRY, {
		type: type,
		code: code,
		name: name
	})
}

// 设置会员个人信息 
export function setPersonalAgentDetail({
	commit
}, {
	personalInfo
}) {
	console.log('personalInfo', personalInfo)
	axios.post('Member/Member/SetPersonalAgentDetail', {
		'FullName': personalInfo.fullName,
		'IdCardNumber': personalInfo.idCardNumber,
		'NickName': personalInfo.nickName,
		'Birthday': personalInfo.birthday,
		'Telephone': personalInfo.telephone,
		'Email': personalInfo.email,
		'RaceId': personalInfo.raceId,
		'Gender': personalInfo.gender,
		'CountryCode': personalInfo.countryCode,
		'StateId': personalInfo.stateId,
		'CityId': personalInfo.cityId,
		'DistrictId': personalInfo.districtId,
		'Address': personalInfo.address,
		'PostCode': personalInfo.postCode,
		'Password': personalInfo.newPassword,
		'WalletPassword': personalInfo.walletPassword,
		'IsCompany': personalInfo.isCompany
	}).then(res => {
		console.log('SetPersonalAgentDetail res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}
// 设置会员企业信息 
export function setCompanyAgentDetail({
	commit
}, {
	companyInfo
}) {
	console.log('setCompanyAgentDetail companyInfo', companyInfo)
	axios.post('Member/Member/SetCompanyAgentDetail', {
		'LegalPerson': companyInfo.legalPerson,
		'CompanyName': companyInfo.companyName,
		'CompanyLicense': companyInfo.companyLicense,
		'IsCompany': companyInfo.isCompany,
		'NickName': companyInfo.nickName,
		'Password': companyInfo.newPassword,
		'WalletPassword': companyInfo.walletPassword,
		'FullName': companyInfo.fullName,
		'Birthday': companyInfo.birthday,
		'RaceId': companyInfo.raceId,
		'Gender': companyInfo.gender,
		'IdCardNumber': companyInfo.idCardNumber,
		'IdCardFileName': companyInfo.idCardFileName,
		'TaxIdForIDN': companyInfo.taxIdForIDN,
		'CountryCode': companyInfo.countryCode,
		'Address': companyInfo.address,
		'StateId': companyInfo.stateId,
		'CityId': companyInfo.cityId,
		'DistrictId': companyInfo.districtId,
		'Telephone': companyInfo.telephone,
		'PostCode': companyInfo.postCode,
		'Email': companyInfo.email
	}).then(res => {
		console.log('setCompanyAgentDetail res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}

//身份证认证信息
export function checkIdCard({
	commit
}, {
	idcard,
	countrycode,
	branchcompanyid
}) {
	axios.get('Member/Common/CheckIdCardNumberWithCountryCode', {
		params: {
			idCardNumber: idcard,
			countryCode: countrycode,
			branchCompanyId: branchcompanyid
		}
	}).then(res => {
		console.log('idcard res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}

// 登录协议
export function loginAgree({
	commit
}) {
	axios.post('Member/Member/ConfirmAgreement', {}).then(res => {
		console.log('loginArgee', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}
// 会员登录首页信息
export function getHomeInfo({
	commit
}) {
	axios.get('Member/Member/GetHomeInfo', {}).then(res => {
		console.log('homeInfo', res)
		commit(types.SET_HOME_INFO, {
			homeInfo: res.Data
		})
	})
}

// 会员登录首页信息
export function setHomeInfo({
	commit
}, {
	homeInfo
}) {
	commit(types.SET_HOME_INFO, {
		homeInfo: homeInfo
	})
}

// 获取首页轮播图
export function getBannerList({
	commit
}) {
	axios.get('Deals/Common/GetIndexBanner', {}).then(res => {
		console.log('bannerList', res)
		commit(types.SET_BANNER_LIST, {
			bannerList: res.Data
		})
	})
}

export function setBannerList({
	commit
}, {
	bannerList
}) {
	commit(types.SET_BANNER_LIST, {
		bannerList: bannerList
	})
}

// 忘记密码
export function forgetPassword({
	commit
}, {
	email,
	loginId
}) {
	axios.post('Member/Account/ForgotPassword', {
		'Email': email,
		'LoginId': loginId
	}).then(res => {
		console.log('forgetPassword', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}

// 修改登录密码
export function modeifyLogin({
	commit
}, {
	oldPassword,
	newPassword
}) {
	axios.post('Member/Account/ChangePassword', {
		'OldPassword': oldPassword,
		'NewPassword': newPassword
	}).then(res => {
		console.log('modifyPay res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}

// 修改钱包密码
export function modeifyPay({
	commit
}, {
	oldPassword,
	newPassword
}) {
	axios.post('Member/Member/ChangeWalletPassword', {
		'OldPassword': oldPassword,
		'NewPassword': newPassword
	}).then(res => {
		console.log('modifyPay res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		if(res.IsSuccess === true) {} else {}
	})
}

//管理收获地址
export function addressManager({
	commit
}) {
	axios.get('Member/Address/List', {}).then(res => {
		console.log('address res', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ADDRESS_LIST, {
				address_list: res.Data
			})
		}
	})
}

// 设置默认地址
export function addressDefault({
	commit
}, {
	addressId
}) {
	console.log('addressDefault', addressId)
	axios.get('Member/Address/SetDefault', {
		params: {
			addressId: addressId
		}
	}).then(res => {
		console.log('addressDefault', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		if(res.IsSuccess === true) {

		}
	})
}

// 删除地址
export function addressDelete({
	commit
}, {
	addressId
}) {
	axios.get('Member/Address/Delete', {
		params: {
			addressId: addressId
		}
	}).then(res => {
		console.log('isdelect', res)
		console.log('addressId', addressId)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		if(res.IsSuccess === true) {

		}
	})
}

//添加收获地址
export function addressAdd({
	commit
}, {
	addressInfo
}) {
	console.log('addressAdd', addressInfo)
	axios.post('Member/Address/AddAddress', {
		'Address': addressInfo.address,
		'StateId': addressInfo.stateId,
		'CityId': addressInfo.cityId,
		'DistrictId': addressInfo.districtId,
		'PostCode': addressInfo.postCode,
		'IsDefault': addressInfo.isDefault,
		'CountryCode': addressInfo.countryCode,
		'Telephone': addressInfo.telephone,
		'ContactName': addressInfo.contactName
	}).then(res => {
		console.log('res', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		if(res.IsSuccess === true) {

		} else {}
	})
}

// 获取期结算
export function getTipCount({
	commit
}) {
	axios.get('Member/Member/GetTermSettlementInfo', {}).then(res => {
		console.log('gettipcount:', res)
		if(res.IsSuccess === true) {
			commit(types.SET_TIP_COUNT, {
				tip_count: res.Data
			})
		}
	})
}

// 设置是否显示结算期提醒
export function setShowTermSettlementInfo({
	commit
}, {
	showTermSettlementInfo
}) {
	console.log('showTermSettlementInfo', showTermSettlementInfo)
	commit(types.SET_SHOW_TERM_SETTLEMENT_INFO, {
		showTermSettlementInfo: !showTermSettlementInfo
	})
	commit(types.SET_HIDE_TERM_SETTLEMENT_DATE, {
		hideTermSettlementDate: new Date().format('yyyy-MM-dd')
	})
}

// 我的奖金
export function myBonus({
	commit
}) {
	axios.get('Member/Member/GetAgentBonusInfo?pageSize=10', {}).then(res => {
		console.log('myBonus:', res)
		if(res.IsSuccess === true) {
			commit(types.SET_MY_BONUS, {
				my_bonus: res.Data
			})
		}
	})
}

//我的钱包
export function myWallet({
	commit
}) {
	axios.get('Member/Wallet/GetWalletList', {}).then(res => {
		console.log('myWallet:', res)
		if(res.IsSuccess === true) {
			commit(types.SET_MY_WALLET, {
				my_wallet: res.Data
			})
		}
	})
}

// 首页楼层商品(重消购物车)
export function productList({
	commit
}, {
	salesArea,
	branchCompanyId
}) {
	axios.get('Deals/Product/GetHomeProductList?branchCompanyId=' + branchCompanyId + '&salesArea=' + salesArea).then(res => {
		console.log('homeProduct_list', res)
		if(res.IsSuccess === true) {
			commit(types.SET_PRODUCT_LIST, {
				product_list: res.Data
			})
			commit(types.SET_GOODS_LIST, {
				goods_list: res.Data
			})
			console.log('salesArea', salesArea)
			console.log('branchCompanyId', branchCompanyId)
		}
	})
}

// 商品详情
export function goodsDetail({
	commit
}, {
	id,
	salesArea
}) {
	axios.get('Deals/Product/GetProductById', {
		params: {
			productId: id,
			salesArea: salesArea
		}
	}).then(res => {
		console.log('homeProduct_list', res)
		if(res.IsSuccess === true) {
			commit(types.SET_PRODUCT_DETAIL, {
				product_detail: res.Data
			})
		}
	})
}

//购物车列表
export function getCart({
	commit
}, {
	salesArea
}) {
	axios.get('Deals/ShoppingCart/GetCartProductInfo?salesArea=' + salesArea).then(res => {
		console.log('cart', res)
		console.log('salesArea', salesArea)
		if(res.IsSuccess === true) {
			commit(types.SET_GET_CART, {
				get_cart: res.Data
			})
		} else {
			commit(types.SET_GET_CART, {
				get_cart: []
			})
		}
	})
}

// 添加到购物车
export function addCart({
	commit
}, {
	productId,
	salesArea,
	count
}) {
	axios.post('Deals/ShoppingCart/AddCartItem', {
		'ProductId': productId,
		'SalesArea': salesArea,
		'Count': count
	}).then(res => {
		console.log('addCart', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
		console.log('productId', productId)
		console.log('salesArea', salesArea)
		return res
	})
}

// 删除购物车数目
export function removeCartItem({
	commit
}, {
	productId,
	salesArea,
	count
}) {
	axios.post('Deals/ShoppingCart/RemoveCartItem', {
		'ProductId': productId,
		'SalesArea': salesArea,
		'Count': count
	}).then(res => {
		console.log('removeCart', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}

// 手动编辑购物车数目
export function editCartItem({
	commit
}, {
	productId,
	salesArea,
	count
}) {
	axios.post('Deals/ShoppingCart/SetCartItem', {
		'ProductId': productId,
		'SalesArea': salesArea,
		'Count': count
	}).then(res => {
		console.log('editCartItem', res)
		commit(types.SET_AJAX_RESULT, {
			isSuccess: res.IsSuccess,
			errorInfos: res.ErrorInfos
		})
	})
}

// 根据购货区获取支付方式
export function getPaymentWay({
	commit
}, {
	salesArea
}) {
	axios.get('Deals/Common/GetPaymentWayBySalesArea', {
		params: {
			SalesArea: salesArea
		}
	}).then(res => {
		if(res.IsSuccess === true) {
			commit(types.SET_PAYMENT_WAY, {
				paymentWay: res.Data
			})
		} else {
			commit(types.SET_PAYMENT_WAY, {
				paymentWay: null
			})
		}
	})
}

export function orderConfirm({
	commit
}, {
	orderConfirm
}) {
	commit(types.SET_ORDER_CONFIRM, {
		order_confirm: orderConfirm
	})
}

export function setInvoiceType({
	commit
}, {
	invoiceType
}) {
	commit(types.SET_INVOICE_TYPE, {
		invoiceType: invoiceType
	})
}

// 设置订单结算页面选中的收货地址
export function setOrderConfirmAddress({
	commit
}, {
	address
}) {
	console.log('setOrderConfirmAddress', address)
	commit(types.SET_ORDER_CONFIRM_ADDRESS, {
		address: address
	})
}

//订单列表
export function orderList({
	commit
}, {
	currentPage,
	pageSize,
	queryModel
}) {
	axios.get('Deals/Order/GetOrderList', {
		params: {
			currentPage: currentPage,
			pageSize: pageSize,
			queryModel: queryModel
		}
	}).then(res => {
		console.log('orderList', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ORDER_LIST, {
				order_list: res.Data
			})
		}
	})
}

// 获取订单详情
export function orderDetails({
	commit
}, {
	orderNo
}) {
	axios.get('Deals/Order/GetOrderInfo', {
		params: {
			orderNo: orderNo
		}
	}).then(res => {
		console.log('orderDetails', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ORDER_DETAILS, {
				order_details: res.Data
			})
		}
	})
}

// 退出登录
export function logout({
	commit
}) {
	commit(types.LOGOUT)
}
// 获取用户基本信息 获取当前用户包含分公司信息和证件国籍信息
export function getAgentBasicInfo({
	commit
}) {
	axios.get('Member/Member/GetCurrentAgentForSetDetail').then(res => {
		console.log('getAgentBasicInfo', res)
		commit(types.INIT_USER_INFO, {
			user: res.Data
		})
	})
}

// 设置用户基本信息 获取当前用户包含分公司信息和证件国籍信息
export function setAgentBasicInfo({
	commit
}, {
	user
}) {
	commit(types.INIT_USER_INFO, {
		user: user
	})
}

// 获取会员的二维码
export function getMyQRCode({
	commit
}) {
	axios.get('Member/Member/GetMyQRCode').then(res => {
		console.log('GetMyQRCode res', res)
		if(res.IsSuccess === true) {
			commit(types.SET_QRCODE, res.Data)
		}
	})
}

// 设置语言
export function setLang({
	commit
}, {
	lang
}) {
	console.log('setLang', lang)
	commit(types.UPDATE_LANG, lang)
}

export function setBranchCompany({
	commit
}, {
	id,
	name
}) {
	console.log('setBranchCompany id', id)
	console.log('setBranchCompany name', name)
	commit(types.SET_BRANCH_COMPANY, {
		id: id,
		name: name
	})
}

// 获取支持的分公司国家窗口列表
export function getBranchCompanyList({
	commit
}) {
	axios.get('Member/Common/GetBranchCompanyList').then(res => {
		if(res.IsSuccess === true) {
			commit(types.SET_BRANCH_COMPANY_LIST, {
				branch_company_list: res.Data
			})
		}
	})
}

export function setBranchCompanyList({
	commit
}, {
	branchCompanyList
}) {
	commit(types.SET_BRANCH_COMPANY_LIST, {
		branch_company_list: branchCompanyList
	})
}

// 获取马来西亚种族列表
export function getMyRaceList({
	commit
}) {
	axios.get('Member/Common/GetMYRaceList').then(res => {
		if(res.IsSuccess === true) {
			commit(types.SET_MY_RACE_LIST, {
				my_race_list: res.Data
			})
		}
	})
}

// 设置马来西亚种族
export function setMyRaceList({
	commit
}, {
	my_race_list
}) {
	commit(types.SET_MY_RACE_LIST, {
		my_race_list: my_race_list
	})
}

//根据国家代码获取一级地区
export function getProvince({
	commit
}, {
	countryCode
}) {
	console.log('getProvince', countryCode)
	axios.get('Member/Common/GetFirstDistrictByCountryCode', {
		params: {
			'countryCode': countryCode
		}
	}).then(res => {
		console.log('getprovince', res)
		if(res.IsSuccess === true) {
			commit(types.SET_PROVINCE_LIST, {
				province_list: res.Data
			})
		}
	})
}

//根据国家代码获取一级地区
export function setProvince({
	commit
}, {
	provinceList
}) {
	console.log('setProvince', provinceList)
	commit(types.SET_PROVINCE_LIST, {
		province_list: provinceList
	})
}

//根据国家一级地区编码获取城市列表
export function getCity({
	commit
}, {
	provinceCode
}) {
	console.log('action getCity', provinceCode)
	axios.get('Member/Common/GetChildDistrictByParentId', {
		params: {
			'parentId': provinceCode
		}
	}).then(res => {
		console.log('getCity', res)
		if(res.IsSuccess === true) {
			commit(types.SET_CITY_LIST, {
				city_list: res.Data
			})
		}
	})
}

//根据国家一级地区编码获取城市列表
export function setCity({
	commit
}, {
	cityList
}) {
	console.log('action getCity', cityList)
	commit(types.SET_CITY_LIST, {
		city_list: cityList
	})
}

// 根据城市编码获取对应的地区列表
export function getDistrict({
	commit
}, {
	cityCode
}) {
	axios.get('Member/Common/GetChildDistrictByParentId?parentId=' + cityCode).then(res => {
		console.log('getdistrict', res)
		if(res.IsSuccess === true) {
			commit(types.SET_DISTRICT_LIST, {
				district_list: res.Data
			})
		}
	})
}

// 根据城市编码获取对应的地区列表
export function setDistrict({
	commit
}, {
	districtList
}) {
	commit(types.SET_DISTRICT_LIST, {
		district_list: districtList
	})
}

// 根据分公司编码获取支持的证件国籍列表
export function getAddressCountry({
	commit
}, {
	branchCompanyId
}) {
	axios.get('Member/Common/GetSupportCertificateCountryByBranchCompanyId', {
		params: {
			companyId: branchCompanyId
		}
	}).then(res => {
		console.log('getAddressCountry', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ADDRESS_COUNTRY_LIST, {
				country_list: res.Data
			})
		}
	})
}

// 根据分公司编码获取支持的证件国籍列表
export function setAddressCountry({
	commit
}, {
	country_list
}) {
	commit(types.SET_ADDRESS_COUNTRY_LIST, {
		country_list: country_list
	})
}

// 根据国家代码获取1级地区
export function getAddressProvince({
	commit
}, {
	countryCode
}) {
	console.log('getAddressProvince', countryCode)
	axios.get('Member/Common/GetFirstDistrictByCountryCode', {
		params: {
			countryCode: countryCode
		}
	}).then(res => {
		console.log('getAddressProvince', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ADDRESS_PROVINCE_LIST, {
				province_list: res.Data
			})
		}
	})
}

// 根据国家代码获取1级地区
export function setAddressProvince({
	commit
}, {
	province_list
}) {
	commit(types.SET_ADDRESS_PROVINCE_LIST, {
		province_list: province_list
	})
}

// 根据省份代码获取城市列表
export function getAddressCity({
	commit
}, {
	provinceCode
}) {
	console.log('getAddressCity')
	axios.get('Member/Common/GetChildDistrictByParentId', {
		params: {
			parentId: provinceCode
		}
	}).then(res => {
		console.log('getAddressCity', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ADDRESS_CITY_LIST, {
				city_list: res.Data
			})
		}
	})
}

// 根据省份代码获取城市列表
export function setAddressCity({
	commit
}, {
	city_list
}) {
	commit(types.SET_ADDRESS_CITY_LIST, {
		city_list: city_list
	})
}

// 根据城市代码获取地区列表
export function getAddressDistrict({
	commit
}, {
	cityCode
}) {
	console.log('getAddressDistrict')
	axios.get('Member/Common/GetChildDistrictByParentId', {
		params: {
			parentId: cityCode
		}
	}).then(res => {
		console.log('getAddressDistrict', res)
		if(res.IsSuccess === true) {
			commit(types.SET_ADDRESS_DISTRICT_LIST, {
				district_list: res.Data
			})
		}
	})
}

// 根据城市代码获取地区列表
export function setAddressDistrict({
	commit
}, {
	district_list
}) {
	commit(types.SET_ADDRESS_DISTRICT_LIST, {
		district_list: district_list
	})
}

// 设置新增地址是选择的国家、省市区信息
export function setAddressInfo({
	commit
}, {
	type,
	code,
	name
}) {
	console.log('setAddressInfo', type)
	commit(types.SET_ADDRESS_INFO, {
		type: type,
		code: code,
		name: name
	})
}