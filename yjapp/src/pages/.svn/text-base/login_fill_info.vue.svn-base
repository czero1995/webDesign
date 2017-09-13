<template>
	<div data-page="login-fill-info" class="page login-fill-info-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<!--<div class="left">
					<a href="/" class="back icon icon-back"></a>
				</div>-->
				<div class="center"><span class="text-gradient" v-text="$t('app.page.fill_info')">填写信息</span></div>
				<div @click="onLogout" class='right' style='margin-right: 10px;'>
					<a href='javascript:void(0);' class='text-gradient' style='font-size: 0.26rem;' v-text="$t('app.fill_info.logout')">退出</a>
				</div>
				<!-- Sub navbar -->
				<div class="subnavbar">
					<div class="buttons-row">
						<a href="javascript:void(0);" class="button tab-link" @click="onSelect('personal')" v-bind:class="{ active: selected === 'personal', 'text-gradient': selected === 'personal' }" v-text="$t('app.fill_info.personal_fill')">个人注册</a>
						<!-- 台湾窗口不显示企业注册 -->
						<a v-show="user !== null && user.BranchCompanyId !== 4" href="javascript:void(0);" class="button tab-link" @click="onSelect('company')" v-bind:class="{ active: selected === 'company', 'text-gradient': selected === 'company' }" v-text="$t('app.fill_info.company_fill')">企业注册</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<!-- 个人首次登录填写更多信息 -->
				<ul v-show="selected === 'personal'">
					<li>
						<a href="javascript:void(0);" class="item-link item-content">
							<div class="item-content">
								<div class="item-title" v-text="$t('app.fill_info.branch_company')">服务国家窗口</div>
							</div>
							<div style="padding-right: 20px;" class="item-content">
								{{branch_company_name}}
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);" class="item-link item-content">
							<div class="item-content">
								<div class="item-title" v-text="$t('app.fill_info.idCard_country')">证件国籍</div>
							</div>
							<div style="padding-right: 20px;" class="item-content" v-if="user != null && user.CertificateCountry != null">
								{{user.CertificateCountry.Name}}
							</div>
						</a>
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.fullname')" v-model="personalInfo.fullName" />
					</li>
					<li v-if="user !== null && user.BranchCompanyId !== 10">
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.idCard_number')" v-model="personalInfo.idCardNumber" />
					</li>
					<li v-if="user !== null && user.BranchCompanyId === 10">
						<input type="text" class="register-input" placeholder="SIN" v-model="personalInfo.idCardNumber" />
					</li>
					<!-- 印尼窗口才需要填写印尼税务编号 -->
					<li v-if="user !== null && user.BranchCompanyId === 7">
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.taxIdForIDN')" v-model="personalInfo.taxIdForIDN" />
					</li>
					<!-- 香港窗口才需要上传身份证 -->
					<div class="login_fill-hr" v-if="user !== null && user.BranchCompanyId === 8"></div>
					<li class="useragent-li" v-if="user !== null && user.BranchCompanyId === 8">
						<p class="useragent-text" v-text="$t('app.fill_info.idCard_tips_title')">身份证文件（正面）</p>
						<p class="useragent-warn" v-text="$t('app.fill_info.idCard_tips_1')">1. 只支持JPG或PNG文件格式</p>
						<p class="useragent-warn" v-text="$t('app.fill_info.idCard_tips_2')">2. 上传文件不能超过2048KB</p>
						<img @click="uploadByGallery" class="useragent-img" v-if="personalInfo.idCardFileName !== ''" :src="personalInfo.idCardFilePath" />
						<img @click="uploadByGallery" class="useragent-img" v-if="personalInfo.idCardFileName === ''" src="../../static/icon/list_Upload_nor@3x.png" />
					</li>
					<div class="login_fill-hr" v-if="user !== null && user.BranchCompanyId === 8"></div>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.nickname')" v-model="personalInfo.nickName" />
					</li>
					<li>
						<input type="text" :id="personalBirthday" readonly="readonly" class="register-input" :placeholder="$t('app.fill_info.birthday')" v-model="personalInfo.birthday" />
					</li>
					<li class="clearfloat sex">
						<span class="sex-l" v-text="$t('app.fill_info.gender')">性别</span>
						<span class="sex-r">
							<div style="display: inline-block; margin-right: 0.2rem; font-size: 0.28rem;"	>
								<label for="boy" v-text="$t('app.fill_info.male')">男</label>
								<input type="radio" value="0" v-model="personalInfo.gender" />
							</div>
							<div style="display: inline-block;font-size: 0.28rem;">
								<label for="girl" v-text="$t('app.fill_info.female')">女</label>
								<input type="radio" value="1" v-model="personalInfo.gender" />
							</div>
				    	</span>
					</li>
					<!-- 马来西亚窗口才需要选择种族 -->
					<li v-if="user !== null && user.BranchCompanyId === 1">
						<a @click="onSelectRace" href="javascript:void(0);" class="item-link">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.fill_info.race')">种族</div>
								<div style="line-height: 28px;" class="item-after" v-text="personal_race.code === '' ? $t('app.fill_info.select_race') : personal_race.name">请选择种族</div>
							</div>
						</a>
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.telephone')" v-model="personalInfo.telephone" />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.email')" v-model="personalInfo.email" />
					</li>
					<li>
						<a @click="onSelectProvince" href="javascript:void(0);" class="item-link item-content">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.fill_info.select_country')">所在国家区域</div>
							</div>
						</a>
					</li>
					<li v-if="personal_province.code.trim().length > 0">
						<div class="register-input">{{personal_province.name}} {{personal_city.name}} {{personal_district.name}}</div>
					</li>
					<li class="contact-address">
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.address')" v-model="personalInfo.address" />
						<!--<textarea class="register-input" placeholder="联系地址" v-model="personalInfo.address"></textarea>-->
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.postcode')" v-model="personalInfo.postCode" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.login_password')" v-model="personalInfo.newPassword" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.confirm_login_password')" v-model="personalInfo.confirmPassword" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.wallet_password')" v-model="personalInfo.walletPassword" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.confirm_wallet_password')" v-model="personalInfo.confirmWalletPassword" />
					</li>
				</ul>
				<!-- 企业首次登录填写更多信息 -->
				<ul v-if="selected === 'company'">
					<li>
						<a href="javascript:void(0);" class="item-link item-content">
							<div class="item-content">
								<div class="item-title" v-text="$t('app.fill_info.branch_company')">服务国家窗口</div>
							</div>
							<div style="padding-right: 20px;" class="item-content">
								{{branch_company_name}}
							</div>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);" class="item-link item-content">
							<div class="item-content">
								<div class="item-title" v-text="$t('app.fill_info.idCard_country')">证件国籍</div>
							</div>
							<div style="padding-right: 20px;" class="item-content" v-if="user != null && user.CertificateCountry != null">
								{{user.CertificateCountry.Name}}
							</div>
						</a>
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.conpany_name')" v-model="companyInfo.companyName" />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.legal_person')" v-model="companyInfo.legalPerson" />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.company_license')" v-model="companyInfo.companyLicense" />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.fullname')" v-model="companyInfo.fullName" />
					</li>
					<li v-if="user !== null && user.BranchCompanyId !== 10">
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.idCard_number')" v-model="companyInfo.idCardNumber" />
					</li>
					<li v-if="user !== null && user.BranchCompanyId === 10">
						<input type="text" class="register-input" placeholder="SIN" v-model="companyInfo.idCardNumber" />
					</li>
					<!-- 印尼窗口才需要填写印尼税务编号 -->
					<li v-if="user !== null && user.BranchCompanyId === 7">
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.taxIdForIDN')" v-model="companyInfo.taxIdForIDN" />
					</li>
					<div class="login_fill-hr" v-if="user !== null && user.BranchCompanyId === 8"></div>
					<li class="useragent-li" v-if="user !== null && user.BranchCompanyId === 8">
						<p class="useragent-text" v-text="$t('app.fill_info.idCard_tips_title')">身份证文件（正面）</p>
						<p class="useragent-warn" v-text="$t('app.fill_info.idCard_tips_1')">1. 只支持JPG或PNG文件格式</p>
						<p class="useragent-warn" v-text="$t('app.fill_info.idCard_tips_2')">2. 上传文件不能超过2048KB</p>
						<img @click="uploadByGallery" class="useragent-img" v-if="companyInfo.idCardFileName !== ''" :src="companyInfo.idCardFilePath" />
						<img @click="uploadByGallery" class="useragent-img" v-if="companyInfo.idCardFileName === ''" src="../../static/icon/list_Upload_nor@3x.png" />
					</li>
					<div class="login_fill-hr" v-if="user !== null && user.BranchCompanyId === 8"></div>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.nickname')" v-model="companyInfo.nickName" />
					</li>
					<li>
						<input type="text" :id="companyBirthday" readonly="readonly" class="register-input" :placeholder="$t('app.fill_info.birthday')" v-model="companyInfo.birthday" />
					</li>
					<li class="clearfloat sex">
						<span class="sex-l" v-text="$t('app.fill_info.gender')">性别</span>
						<span class="sex-r">
							<div style="display: inline-block; margin-right: 0.2rem; font-size: 0.28rem;">
								<label for="boy" v-text="$t('app.fill_info.male')">男</label>
								<input type="radio" value="0" v-model="companyInfo.gender" />
							</div>
							<div style="display: inline-block;font-size: 0.28rem;">
								<label for="girl" v-text="$t('app.fill_info.female')">女</label>
								<input type="radio" value="1" v-model="companyInfo.gender" />
							</div>							 
				    	</span>
					</li>
					<!-- 马来西亚窗口才需要选择种族 -->
					<li v-if="user !== null && user.BranchCompanyId === 1">
						<a @click="onSelectRace" href="javascript:void(0);" class="item-link">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.fill_info.race')">种族</div>
								<div style="line-height: 28px;" class="item-after" v-text="company_race.code === '' ? $t('app.fill_info.select_race') : company_race.name">请选择种族</div>
							</div>
						</a>
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.telephone')" v-model='companyInfo.telephone' />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.email')" v-model="companyInfo.email" />
					</li>
					<li>
						<a @click="onSelectProvince" href="javascript:void(0);" class="item-link item-content">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.fill_info.select_country')">所在国家区域
								</div>
							</div>
						</a>
					</li>
					<li v-if="company_province.code.trim().length > 0">
						<div class="register-input">{{company_province.name}} {{company_city.name}} {{company_district.name}}</div>
					</li>
					<li class="contact-address">
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.address')" v-model="companyInfo.address" />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.fill_info.postcode')" v-model="companyInfo.postCode" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.login_password')" v-model="companyInfo.newPassword" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.confirm_login_password')" v-model="companyInfo.confirmPassword" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.wallet_password')" v-model="companyInfo.walletPassword" />
					</li>
					<li>
						<input type="password" class="register-input" :placeholder="$t('app.fill_info.confirm_wallet_password')" v-model="companyInfo.confirmWalletPassword" />
					</li>
				</ul>
			</div>
		</div>
		<div @click="onSubmit()" class="toolbar tabbar login_fill_info-footer" v-bind:class="{ actives: canSubmit }">
			<div class="toolbar-inner">
				<a href="javascript:void(0);" class="tab-link" v-text="$t('app.fill_info.submit')">
					提交
				</a>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.login-fill-info-page {
		.subnavbar {
			padding: 0px;
			.buttons-row {
				height: 44px;
				.button {
					height: 44px;
					line-height: 44px;
					color: #000;
					border: none;
					border-radius: 0px;
					&.active {
						border-bottom: 3px solid #E6CF8B;
					}
				}
			}
		}
		.page-content {
			padding-top: 88px;
			padding-bottom: 50px;
			.list-block {
				margin: 0;
				.fill-top {
					width: 100%;
					height: 0.998rem;
					background: #FFFFFF;
					.fill-top-tab {
						&.active {
							border-bottom: 1px solid #D67D00;
						}
					}
					.fill-top-l {
						text-align: center;
						width: 48%;
						font-family: PingFangSC-Medium;
						font-size: 0.28rem;
						color: #595959;
						letter-spacing: 0.82px;
						line-height: 0.98rem;
						display: inline-block;
					}
					.fill-top-r {
						font-family: PingFangSC-Medium;
						font-size: 0.28rem;
						color: #595959;
						letter-spacing: 0.72px;
						line-height: 0.98rem;
						width: 48%;
						display: inline-block;
						text-align: center;
					}
				}
				>ul {
					>li {
						border-bottom: 1px solid #eee;
						padding-left: 0.3rem;
						.item-content {
							height: 0.88rem;
							line-height: 0.88rem;
							font-size: 0.26rem;
							padding-left: 0;
						}
						.item-inner {
							height: 0.88rem;
							line-height: 0.88rem;
							font-size: 0.26rem;
						}
						.item-inner:after {
							display: none;
						}
						.register-input {
							height: 0.88rem;
							line-height: 0.88rem;
							font-size: 0.26rem;
						}
					}
					.sex {
						height: 0.88rem;
						line-height: 0.88rem;
						display: block;
						.sex-img {
							width: 0.3rem;
							height: 0.3rem;
							display: inline-block;
							margin-left: 0.2rem;
							margin-right: 0.3rem;
						}
						.sex-l {
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #595959;
							letter-spacing: 0.76px;
							line-height: 0.34rem;
						}
						.sex-r {
							float: right;
							margin-right: 0.7rem;
						}
					}
					.contact-address {
						height: 1.58rem;
					}
					.login_fill-hr {
						width: 100%;
						height: 0.2rem;
						background: #EEEEEE;
					}
					.useragent-li {
						width: 100%;
						height: 3.8rem;
						background: #FFFFFF;
						.useragent-text {
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #5A5A5A;
							letter-spacing: 0.76px;
							line-height: 0.34rem;
						}
						.useragent-warn {
							font-family: PingFangSC-Regular;
							font-size: 0.22rem;
							color: #ACACAC;
							letter-spacing: 0.65px;
							line-height: 0.34rem;
						}
						.useragent-img {
							margin-top: 0.1rem;
							width: 2.15rem;
							height: 1.58rem;
						}
					}
				}
			}
		}
		.login_fill_info-footer {
			font-size: 0.3rem;
			background: #B4B4B4;
			color: #FFFFFF;
			position: fixed;
			bottom: 0;
		}
		.active.login_fill_info-footer {
			background-image: url(../../static/icon/tab_bg_content_nor@3x.png);
			color: #FFFFFF;
		}
		.actives.login_fill_info-footer {
			background-image: url(../../static/icon/tab_bg_content_nor@3x.png);
			color: #FFFFFF;
		}
		.tabbar a {
			color: #FFFFFF;
		}
	}
	
	input[type=radio] {
		position: relative;
		width: 18px;
		height: 1px;
	}
	
	input[type=radio]::before,
	input[type=radio]::after {
		position: absolute;
		display: block;
		content: '';
		border-radius: 50%;
		transition: .3s all esae;
	}
	
	input[type=radio]::before {
		top: -0.28rem;
		left: 0;
		width: 15px;
		height: 15px;
		border: 3px solid #ccc;
	}
	
	input[type=radio]::after {
		top: -0.18rem;
		left: 5px;
		width: 11px;
		height: 11px;
		background-color: #fff;
	}
	
	input[type=radio]:checked::before {
		border-color: #E6CF8B;
	}
	
	input[type=radio]:checked::after {
		background-color: #E6CF8B;
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
				selected: 'personal',
				personalInfo: {
					nickName: '', // 昵称
					fullName: '', // 会员全名
					newPassword: '', // 登录密码
					confirmPassword: '', // 确认登录密码
					walletPassword: '', // 钱包密码
					confirmWalletPassword: '', // 确认钱包密码
					birthday: '', // 出生日期
					raceId: 0, // 种族id
					gender: 0, // 性别
					idCardNumber: '', // 身份证号码 
					idCardFileName: '', // 身份证文件名
					idCardFilePath: '', // 身份证图片路径，用于本地显示
					taxIdForIDN: '', // 印尼税务号
					countryCode: '', // 会员地址国籍
					stateId: '', // 省id
					cityId: '', // 城市id
					districtId: '', // 地区id
					address: '', // 地址
					postCode: '', // 邮政编码
					telephone: '', // 电话
					email: '', // 邮箱地址
					isCompany: false
				},
				companyInfo: {
					legalPerson: '', // 法人代表名称
					companyName: '', // 公司名称
					companyLicense: '', // 营业执照编号
					nickName: '', // 昵称
					fullName: '', // 会员全称
					newPassword: '', // 登录密码
					confirmPassword: '', // 确认登录密码
					walletPassword: '', // 钱包密码
					confirmWalletPassword: '', // 确认钱包密码
					birthday: '', // 出生日期
					raceId: 0, // 种族id
					gender: 0, // 性别
					idCardNumber: '', // 身份证号码
					idCardFileName: '', // 身份证文件名
					idCardFilePath: '', // 身份证图片路径，用于本地显示
					taxIdForIDN: '', // 印尼税务号
					countryCode: '', // 会员地址国籍
					stateId: '', // 省id
					cityId: '', // 城市id
					districtId: '', // 地区id
					address: '', // 地址
					postCode: '', // 邮政编码
					telephone: '', // 电话
					email: '', // 邮箱地址
					isCompany: true
				},
				personalBirthdayCalendar: null, // 出生日期选择控件
				personalBirthdayCalendarOpened: false, // 日期控件是否打开
				companyBirthdayCalendar: null, // 出生日期选择控件
				companyBirthdayCalendarOpened: false, // 日期控件是否打开
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				gender: state => state.gender,
				user: state => state.user,
				personal_province: state => state.personal_province,
				personal_city: state => state.personal_city,
				personal_district: state => state.personal_district,
				personal_race: state => state.personal_race,
				company_province: state => state.company_province,
				company_city: state => state.company_city,
				company_district: state => state.company_district,
				company_race: state => state.company_race,
				branch_company_list: state => state.branch_company_list,
				branch_company_id: state => state.branch_company_id,
				branch_company_name: state => state.branch_company_name,
				ajax_result: state => state.ajax_result
			}),
			personalBirthday: function() {
				var timestamp = Date.parse(new Date())
				timestamp = timestamp / 1000
				return 'personalBirthday-' + timestamp
			},
			companyBirthday: function() {
				var timestamp = Date.parse(new Date())
				timestamp = timestamp / 1000
				return 'companyBirthday-' + timestamp
			},
			canSubmit: function() {
				const that = this
				console.log('canSubmit', that.selected)
				if(that.selected === 'personal') {
					// 判断个人注册信息是否已经全部填写
					let personalSubmittable = true
					if(that.personalInfo.fullName.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.idCardNumber.trim().length === 0) {
						personalSubmittable = false
					}
					//					if(that.user.CertificateCountryCode === 'TW' && that.personalInfo.idCardFileName.trim().length === 0) {
					//						personalSubmittable = false
					//					}
					if(that.personalInfo.nickName.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.birthday.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.telephone.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.email.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.address.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.postCode.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.newPassword.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.confirmPassword.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.walletPassword.trim().length === 0) {
						personalSubmittable = false
					}
					if(that.personalInfo.confirmWalletPassword.trim().length === 0) {
						personalSubmittable = false
					}
					return personalSubmittable
				}
				if(that.selected === 'company') {
					let companySubmittable = true
					// 判断企业注册信息是否全部填写
					if(that.companyInfo.companyName.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.legalPerson.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.companyLicense.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.fullName.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.nickName.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.idCardNumber.trim().length === 0) {
						companySubmittable = false
					}
					//					if(that.user.CertificateCountryCode === 'TW' && that.companyInfo.idCardFileName.trim().length === 0) {
					//						companySubmittable = false
					//					}
					if(that.companyInfo.birthday.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.telephone.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.email.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.address.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.postCode.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.newPassword.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.confirmPassword.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.walletPassword.trim().length === 0) {
						companySubmittable = false
					}
					if(that.companyInfo.confirmWalletPassword.trim().length === 0) {
						companySubmittable = false
					}
					return companySubmittable
				}
			}
		},
		mounted() {
			const that = this
			console.log('baseURL', axios.defaults.baseURL)
			that.$nextTick(_ => {
				if(that.plusReady) {
					// 首先移除事件
					window.plus.key.removeEventListener('backbutton', function() {
						console.log('removeEventListener')
					}, false)
					window.plus.key.addEventListener('backbutton', function() {
						that.routeBack()
					}, false)
				}
				console.log('$nextTick login_fill_info')
				var today = new Date()
				var valueDay = new Date().setYear(today.getFullYear() - 20)
				var minDate = new Date().setYear(today.getFullYear() - 10)
				var maxDate = new Date().setYear(today.getFullYear() - 18)
				that.personalBirthdayCalendar = that.$f7.calendar({
					input: '#' + that.personalBirthday,
					weekHeader: true,
					closeOnSelect: true,
					dataFormat: 'yyyy-mm-dd',
					value: [valueDay],
					disabled: {
						from: maxDate
					},
					monthNames: that.$t('app.fill_info.monthNames'),
					monthNamesShort: that.$t('app.fill_info.monthNames'),
					dayNames: that.$t('app.fill_info.dayNames'),
					dayNamesShort: that.$t('app.fill_info.dayNames'),
					onDayClick: function(p, dayContainer, year, month, day) {
						that.personalInfo.birthday = year + '-' + (parseInt(month) + 1) + '-' + day
						that.personalBirthdayCalendarOpened = false
					},
					onOpen: function(p) {
						that.personalBirthdayCalendarOpened = true
					},
					onClose: function(p) {
						that.personalBirthdayCalendarOpened = false
					}
				})

				//  初始化选中的省市区信息
				that.$store.dispatch('setFillInfoAddr', {
					type: 'personal_province',
					code: '',
					name: ''
				}).then(() => {})
				that.$store.dispatch('setFillInfoAddr', {
					type: 'personal_city',
					code: '',
					name: ''
				}).then(() => {})
				that.$store.dispatch('setFillInfoAddr', {
					type: 'personal_district',
					code: '',
					name: ''
				}).then(() => {})
				that.$store.dispatch('setFillInfoAddr', {
					type: 'company_province',
					code: '',
					name: ''
				}).then(() => {})
				that.$store.dispatch('setFillInfoAddr', {
					type: 'company_city',
					code: '',
					name: ''
				}).then(() => {})
				that.$store.dispatch('setFillInfoAddr', {
					type: 'company_district',
					code: '',
					name: ''
				}).then(() => {})
				// 身份证号码，需要初始化
				that.personalInfo.fullName = that.user.FullName
				that.personalInfo.idCardNumber = that.user.IdCardNumber
				that.personalInfo.email = that.user.Email
				that.companyInfo.fullName = that.user.FullName
				that.companyInfo.idCardNumber = that.user.IdCardNumber
				that.companyInfo.email = that.user.Email
			})
		},
		methods: {
			routeBack: function() {
				const that = this
				if(that.personalBirthdayCalendarOpened === true || that.companyBirthdayCalendarOpened === true) {
					if(that.personalBirthdayCalendar !== null) {
						that.personalBirthdayCalendar.close()
					}
					if(that.companyBirthdayCalendar !== null) {
						that.companyBirthdayCalendar.close()
					}
				} else {
					// 当前弹出的层
					var modalIn = that.$$('.modal-in')
					console.log('modal_in', modalIn)
					if(modalIn.length === 0) {
						that.$f7.confirm(that.$t('app.modal.sure_exit'), function() {
							window.plus.runtime.quit()
						})
					} else {
						that.$f7.closeModal(modalIn[modalIn.length - 1])
					}
				}
			},
			onLogout: function() {
				console.log('onLogout')
				const that = this
				that.$f7.confirm(that.$t('app.fill_info.sure_logout'), '', function() {
					that.$store.dispatch('logout')
					that.$f7.mainView.router.load({
						url: '/home/'
					})
				})
			},
			onSelectRace: function() {
				const that = this
				// 马来西亚需要选择种族，获取种族列表
				axios.get('Member/Common/GetMYRaceList').then(res => {
					if(res.IsSuccess === true) {
						that.$store.dispatch('setMyRaceList', {
							my_race_list: res.Data
						}).then(() => {
							that.$f7.popup('.select-race-popup')
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onSelectProvince: function() {
				const that = this
				if(that.user !== null) {
					console.log('onSelectProvince', that.user.CertificateCountryCode)
					that.$f7.showPreloader(that.$t('app.fill_info.loading_province'))
					axios.get('Member/Common/GetFirstDistrictByCountryCode', {
						params: {
							'countryCode': that.user.CertificateCountryCode
						}
					}).then(res => {
						console.log('getprovince', res)
						that.$f7.hidePreloader()
						if(res.IsSuccess === true) {
							that.$store.dispatch('setProvince', {
								provinceList: res.Data
							}).then(() => {
								that.$f7.popup('.select-province-popup')
							})
						} else {
							that.$f7.alert(res.ErrorInfos[0].Message)
						}
					})
				}
			},
			uploadByGallery: function() {
				var that = this
				if(that.plusReady) {
					window.plus.gallery.pick(function(p) {
							console.log('gallery ' + p)
							that.onUpload(p)
						},
						function(error) {
							console.log('gallery error', JSON.parse(error))
							that.$f7.alert(that.$t('app.fill_info.pick_image_error'))
						}, {
							filter: 'image'
						})
				} else {
					console.log('请在真机上使用此功能')
				}
			},
			onUpload: function(path) {
				const that = this
				console.log('onUpload ' + path)
				// 读取文件信息，判断文件大小及格式
				window.plus.io.resolveLocalFileSystemURL(path, function(entry) {
					// 可以通过entry对象操作文件
					entry.file(function(file) {
						console.log('entry file')
						console.log(JSON.stringify(file))
						// 判断文件大小不超过，单位为字节B
						var fileSizeLimit = 2 * 1024 * 1024
						if(file.size > fileSizeLimit) {
							that.$f7.alert('文件大小不能超过2M')
						} else {
							var server = axios.defaults.baseURL + 'Member/Member/UploadIdCardFile'
							that.$f7.showPreloader(that.$t('app.fill_info.uploading_image'))
							var task = window.plus.uploader.createUpload(server, {
									method: 'POST',
									priority: 100
								},
								function(t, status) {
									that.$f7.hidePreloader()
									console.log('upload result ' + JSON.stringify(t))
									console.log('upload result ' + JSON.stringify(status))
									// 上传完成
									if(status === 200) {
										var result = JSON.parse(t.responseText)
										if(that.selected === 'personal') {
											that.personalInfo.idCardFileName = result.Data
											that.personalInfo.idCardFilePath = path
										}
										if(that.selected === 'company') {
											that.companyInfo.idCardFileName = result.Data
											that.companyInfo.idCardFilePath = path
										}
										console.log('fileName:' + result.Data)
										console.log('Upload success: ' + t.responseText)
									} else {
										console.log('Upload failed: ' + status)
									}
								}
							)
							task.addFile(path, {
								key: 'tmp_name'
							})
							//task.addData( "string_key", "string_value" );
							//task.addEventListener( "statechanged", onStateChanged, false );
							task.start()
						}
					})
				})
			},
			fillPersonalInfo: function(personalInfo) {
				const that = this
				that.$f7.showPreloader(that.$t('app.fill_info.submitting_personal'))
				axios.post('Member/Member/SetPersonalAgentDetail', {
					'FullName': personalInfo.fullName,
					'IdCardNumber': personalInfo.idCardNumber,
					'IdCardFileName': personalInfo.idCardFileName,
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
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.$store.dispatch('setIsSetDetail', {
							isSetDetail: true
						}).then(() => {
							that.$f7.mainView.router.load({
								url: '/home/'
							})
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			fillCompanyInfo: function(companyInfo) {
				const that = this
				that.$f7.showPreloader(that.$t('app.fill_info.submitting_company'))

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
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						that.$store.dispatch('setIsSetDetail', {
							isSetDetail: true
						}).then(() => {
							that.$f7.mainView.router.load({
								url: '/home/'
							})
						})
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onSubmit() {
				const that = this
				console.log('onSubmit', that.canSubmit)
				if(that.canSubmit) {
					if(that.selected === 'personal') {
						// 马来西亚窗口需要选择种族
						if(that.user.BranchCompanyId === 1 && that.personal_race.code === '') {
							that.$f7.alert(that.$t('app.fill_info.select_race'))
							return false
						} else if(that.user.BranchCompanyId === 1) {
							that.personalInfo.raceId = that.personal_race.code
						}
						// 必须选择国家地区
						if(that.personal_province.code.trim().length === 0) {
							that.$f7.alert(that.$t('app.fill_info.select_country'))
							return false
						}
						// 香港窗口需要上传证件图片
						if(that.user.BranchCompanyId === 8) {
							if(that.plusReady && that.personalInfo.idCardFileName === '') {
								that.$f7.alert('请上传身份证件')
							} else {
								that.personalInfo.idCardFileName = 'e84a90ef209c4d9a8fb6eecf34ba05e1.jpeg'
							}
						}
						//						if(that.personalInfo.newPassword.trim().length < 6) {
						//							that.$f7.alert('登录密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						//						if(that.personalInfo.confirmPassword.trim().length < 6) {
						//							that.$f7.alert('确认登录密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						//						if(that.personalInfo.walletPassword.trim().length < 6) {
						//							that.$f7.alert('安全密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						//						if(that.personalInfo.confirmWalletPassword.trim().length < 6) {
						//							that.$f7.alert('确认安全密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						if(that.personalInfo.newPassword !== that.personalInfo.confirmPassword) {
							that.$f7.alert(that.$t('app.fill_info.login_password_mismatch'))
							return false
						}
						if(that.personalInfo.walletPassword !== that.personalInfo.confirmWalletPassword) {
							that.$f7.alert(that.$t('app.fill_info.wallet_password_mismatch'))
							return false
						}
						that.personalInfo.countryCode = that.user.CertificateCountryCode
						that.personalInfo.stateId = that.personal_province.code
						that.personalInfo.cityId = that.personal_city.code
						that.personalInfo.districtId = that.personal_district.code
						that.fillPersonalInfo(that.personalInfo)
					} else if(that.selected === 'company') {
						// 马来西亚需要选择种族
						if(that.user.BranchCompanyId === 1 && that.company_race.code === '') {
							that.$f7.alert(that.$t('app.fill_info.select_race'))
							return false
						} else if(that.user.BranchCompanyId === 1) {
							that.companyInfo.raceId = that.company_race.code
						}
						if(that.company_province.code.trim().length === 0) {
							that.$f7.alert(that.$t('app.fill_info.select_country'))
							return false
						}
						// 香港窗口需要上传证件图片
						if(that.user.BranchCompanyId === 8) {
							if(that.plusReady && that.companyInfo.idCardFileName === '') {
								that.$f7.alert('请上传身份证件')
							} else {
								that.companyInfo.idCardFileName = 'e84a90ef209c4d9a8fb6eecf34ba05e1.jpeg'
							}
						}
						//						if(that.companyInfo.newPassword.trim().length < 6) {
						//							that.$f7.alert('登录密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						//						if(that.companyInfo.confirmPassword.trim().length < 6) {
						//							that.$f7.alert('确认登录密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						//						if(that.companyInfo.walletPassword.trim().length < 6) {
						//							that.$f7.alert('安全密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						//						if(that.companyInfo.confirmWalletPassword.trim().length < 6) {
						//							that.$f7.alert('确认安全密码至少包含6位字符', that.$t('app.app_name'))
						//							return false
						//						}
						if(that.companyInfo.newPassword !== that.companyInfo.confirmPassword) {
							that.$f7.alert(that.$t('app.fill_info.login_password_mismatch'))
							return false
						}
						if(that.companyInfo.walletPassword !== that.companyInfo.confirmWalletPassword) {
							that.$f7.alert(that.$t('app.fill_info.wallet_password_mismatch'))
							return false
						}
						that.companyInfo.countryCode = that.user.CertificateCountryCode
						that.companyInfo.stateId = that.company_province.code
						that.companyInfo.cityId = that.company_city.code
						that.companyInfo.districtId = that.company_district.code
						that.fillCompanyInfo(that.companyInfo)
					}
				}
			},
			onSelect(selected) {
				const that = this
				var today = new Date()
				var valueDay = new Date().setYear(today.getFullYear() - 20)
				var minDate = new Date().setYear(today.getFullYear() - 10)
				var maxDate = new Date().setYear(today.getFullYear() - 18)
				that.selected = selected
				that.$store.dispatch('setFillInfoType', {
					fill_info_type: selected
				}).then(() => {
					if(selected === 'personal') {
						that.personalBirthdayCalendar = that.$f7.calendar({
							input: '#' + that.personalBirthday,
							weekHeader: true,
							closeOnSelect: true,
							dataFormat: 'yyyy-mm-dd',
							value: [valueDay],
							disabled: {
								from: maxDate
							},
							monthNames: that.$t('app.fill_info.monthNames'),
							monthNamesShort: that.$t('app.fill_info.monthNames'),
							dayNames: that.$t('app.fill_info.dayNames'),
							dayNamesShort: that.$t('app.fill_info.dayNames'),
							onDayClick: function(p, dayContainer, year, month, day) {
								that.personalInfo.birthday = year + '-' + (parseInt(month) + 1) + '-' + day
								that.personalBirthdayCalendarOpened = false
							},
							onOpen: function(p) {
								that.personalBirthdayCalendarOpened = true
							},
							onClose: function(p) {
								that.personalBirthdayCalendarOpened = false
							}
						})
					} else {
						that.companyBirthdayCalendar = that.$f7.calendar({
							input: '#' + that.companyBirthday,
							weekHeader: true,
							closeOnSelect: true,
							dataFormat: 'yyyy-mm-dd',
							value: [valueDay],
							disabled: {
								from: maxDate
							},
							monthNames: that.$t('app.fill_info.monthNames'),
							monthNamesShort: that.$t('app.fill_info.monthNames'),
							dayNames: that.$t('app.fill_info.dayNames'),
							dayNamesShort: that.$t('app.fill_info.dayNames'),
							onDayClick: function(p, dayContainer, year, month, day) {
								that.companyInfo.birthday = year + '-' + (parseInt(month) + 1) + '-' + day
								that.companyBirthdayCalendarOpened = false
							},
							onOpen: function(p) {
								that.companyBirthdayCalendarOpened = true
							},
							onClose: function(p) {
								that.companyBirthdayCalendarOpened = false
							}
						})
					}
				})
			}
		},
		components: {}
	}
</script>