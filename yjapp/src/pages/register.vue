<template>
	<div data-page="register" class="page register-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="userType === '1' ? $t('app.register.register_member') : $t('app.register.register_consumer')">注册</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="list-block">
				<ul>
					<li v-if="fromType == 'self'">
						<input type="number" pattern="\d{8}" class="register-input" :placeholder="$t('app.register.input_introducer_id')" v-model="inputLoginId" />
					</li>
					<li v-if="introducer != null">
						<a href="#" class="item-link item-content">
							<div class="item-content">
								<div class="item-title" v-text="$t('app.register.introducer')">推荐者编号(姓名)</div>
							</div>
							<div style="margin-right: 10px;">
								{{introducer.LoginId}}（{{introducer.FullName}}）
							</div>
						</a>
					</li>
					<li>
						<a @click="onSelectBranch" href="javascript:void(0);" class="item-link item-content">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.register.branch_company')">国家服务窗口</div>
								<div style="line-height: 28px;" class="item-after" v-text="register_branch.code === '' ? $t('app.register.select_branch_compay') : register_branch.name ">选择国家窗口</div>
							</div>
						</a>
					</li>
					<li>
						<a @click="onSelectCountry" href="javascript:void(0);" class="item-link item-content">
							<div class="item-inner">
								<div class="item-title" v-text="$t('app.register.id_card_country')">证件国籍</div>
								<div style="line-height: 28px;" class="item-after" v-text="register_country.code === '' ? $t('app.register.select_id_card_country') : register_country.name ">选择证件国籍</div>
							</div>
						</a>
					</li>
					<li v-if="userType === '3' || (userType === '1' && register_branch.code === '4')">
						<input type="text" class="register-input" :placeholder="$t('app.register.id_card_number')" v-model="idCardNumber" />
					</li>
					<li>
						<input type="text" class="register-input" :placeholder="$t('app.register.fullname')" v-model="fullName" />
					</li>
					<li v-show="userType === '1'">
						<input :id="birthdayId" readonly="readonly" type="text" class="register-input" :placeholder="$t('app.register.birthday')" v-model="birthday" />
					</li>
					<li>
						<input type="email" class="register-input" :placeholder="$t('app.register.email')" v-model="email" />
					</li>
					<li>
						<input type="tel" class="register-input" :placeholder="$t('app.register.telephone')" v-model="telephone" />
					</li>
					<li v-if="userType === '3'">
						<input type="password" class="register-input" :placeholder="$t('app.register.password')" v-model="password" />
					</li>
					<li v-if="userType === '3'">
						<input type="password" class="register-input" :placeholder="$t('app.register.confirm_password')" v-model="confirmPassword" />
					</li>
				</ul>
			</div>
		</div>
		<div @click="onRegister" class="toolbar tabbar register-footer" v-bind:class="{ active: canRegister }" v-text="$t('app.register.submit')">
			注册
		</div>
	</div>
</template>

<style lang="less">
	.register-page {
		.page-content {
			padding-bottom: 50px;
		}
		.list-block {
			margin: 0;
			>ul {
				>li {
					border-bottom: 1px solid #eee;
					.item-content {
						height: 0.88rem;
						line-height: 0.88rem;
						font-size: 0.26rem;
						padding-left: 0.15rem;
					}
					.item-inner {
						height: 0.88rem;
						line-height: 0.88rem;
						font-size: 0.26rem;
						padding-left: 0.15rem;
					}
					.item-inner:after {
						display: none;
					}
					.register-input {
						height: 0.88rem;
						line-height: 0.88rem;
						font-size: 0.26rem;
					}
					>input {
						padding-left: 0.3rem;
					}
				}
			}
		}
		.register-footer {
			width: 100%;
			height: 0.98rem;
			line-height: 0.98rem;
			font-size: 0.3rem;
			background: #B4B4B4;
			color: #FFFFFF;
			text-align: center;
		}
		.active.register-footer {
			background: url(../../static/icon/list_bg_content_sel@3x.png);
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
	import { isEmail } from '../utils/appFunc'
	export default {
		data() {
			return {
				introducerLoginId: '', //推荐者id
				createrLoginId: '',
				userType: null,
				fullName: '',
				idCardNumber: '',
				email: '',
				password: '',
				confirmPassword: '',
				telephone: '',
				birthday: '',
				certificateCountryCode: '',
				branchCompanyId: '',
				branchCompanyName: '',
				fromType: '',
				inputLoginId: '',
				introducer: null, // 推荐者信息
				birthdayCalendar: null, // 出生日期选择控件
				birthdayCalendarOpened: false // 日期控件是否打开
			}
		},
		watch: {
			inputLoginId: function(val) {
				const that = this
				console.log('watch inputLoginId', val)
				if(val.trim().length === 8) {
					that.getIntroducerInfo(val)
				}
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				register_branch_list: state => state.register_branch_list,
				register_branch: state => state.register_branch,
				register_country: state => state.register_country,
				opened_popup: state => state.opened_popup
			}),
			birthdayId: function() {
				var timestamp = Date.parse(new Date())
				timestamp = timestamp / 1000
				return 'birthday-' + timestamp
			},
			canRegister: function() {
				var that = this
				let canReg = true
				// 判断会员信息是否可以提交注册
				if(that.userType === '1') {
					// 台湾窗口，需要判断证件号码和出生日期
					if(that.register_branch.code === '4') {
						// 身份证号码不能为空
						if(that.idCardNumber.trim().length === 0) {
							canReg = false
						}
					}
					// 出生日期不能为空
					if(that.birthday.trim().length === 0) {
						canReg = false
					}
					// 会员全名不能为空
					if(that.fullName.trim().length === 0) {
						canReg = false
					}
					// 邮箱不能为空
					if(that.email.trim().length === 0) {
						canReg = false
					}
					// 联系号码不能为空
					if(that.telephone.trim().length === 0) {
						canReg = false
					}
					return canReg
				}
				// 判断消费者信息是否可以提交注册
				if(that.userType === '3') {
					// 注册消费者，不通过扫码，可以无推荐人
					if(that.fromType === 'qrcode' && that.introducer === null) {
						canReg = false
					}
					// 证件号码不能为空
					if(that.idCardNumber.trim().length === 0) {
						canReg = false
					}
					// 邮箱地址不能为空
					if(that.email.trim().length === 0) {
						canReg = false
					}
					// 会员全名不能为空
					if(that.fullName.trim().length === 0) {
						canReg = false
					}
					// 联系号码不能为空
					if(that.telephone.trim().length === 0) {
						canReg = false
					}
					// 登录密码不能为空
					if(that.password.trim().length === 0) {
						canReg = false
					}
					// 确认密码不能为空
					if(that.confirmPassword.trim().length === 0) {
						canReg = false
					}
					return canReg
				}
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
				let query = that.$route.query
				console.log('register query', query)
				console.log('register userType', query.userType)
				console.log('register IntroducerLoginId: ', query.IntroducerLoginId)
				that.userType = query.userType
				that.fromType = query.fromType
				that.introducerLoginId = query.IntroducerLoginId
				if(that.fromType === 'qrcode') {
					that.getIntroducerInfo(query.IntroducerLoginId)
				}
				if(that.userType === '1') {
					var today = new Date()
					var valueDay = new Date().setYear(today.getFullYear() - 20)
					var minDate = new Date().setYear(today.getFullYear() - 10)
					var maxDate = new Date().setYear(today.getFullYear() - 18)
					that.birthdayCalendar = that.$f7.calendar({
						input: '#' + that.birthdayId,
						weekHeader: true,
						closeOnSelect: true,
						dataFormat: 'yyyy-mm-dd',
						value: [valueDay],
						disabled: {
							from: maxDate
						},
						monthNames: that.$t('app.register.monthNames'),
						monthNamesShort: that.$t('app.register.monthNames'),
						dayNames: that.$t('app.register.dayNames'),
						dayNamesShort: that.$t('app.register.dayNames'),
						onDayClick: function(p, dayContainer, year, month, day) {
							that.birthday = year + '-' + (parseInt(month) + 1) + '-' + day
							that.birthdayCalendarOpened = false
						},
						onOpen: function(p) {
							that.birthdayCalendarOpened = true
						},
						onClose: function(p) {
							that.birthdayCalendarOpened = false
						}
					})
				}
				// 重置已选中的国家窗口
				that.$store.dispatch('setRegisterBranchCountry', {
					type: 'register_branch',
					code: '',
					name: ''
				}).then(() => {})
				// 重置已选中的证件国籍
				that.$store.dispatch('setRegisterBranchCountry', {
					type: 'register_country',
					code: '',
					name: ''
				}).then(() => {})
			})
		},
		methods: {
			routeBack: function() {
				const that = this
				if(that.birthdayCalendarOpened) {
					// 关闭日期控件
					that.birthdayCalendar.close()
				} else {
					// 当前弹出的层
					var modalIn = that.$$('.modal-in')
					console.log('modal_in', modalIn)
					if(modalIn.length === 0) {
						if(that.fromType === 'self') {
							that.$f7.mainView.router.load({
								url: '/login/'
							})
						} else {
							that.$f7.mainView.router.load({
								url: `/select_join/?IntroducerLoginId=${that.introducerLoginId}`
							})
						}
					} else {
						that.$f7.closeModal(modalIn[modalIn.length - 1])
					}
				}
			},
			onClear: function() {
				const that = this
				// 注册成功，清除推荐者缓存
				that.$store.dispatch('setRegisterBranchCountry', {
					type: 'register_branch',
					code: '',
					name: ''
				})
				that.$store.dispatch('setRegisterBranchCountry', {
					type: 'register_country',
					code: '',
					name: ''
				})
			},
			getIntroducerInfo: function(IntroducerLoginId) {
				const that = this
				console.log('getIntroducerInfo', IntroducerLoginId)
				that.$f7.showPreloader(that.$t('app.register.loading_introducer'))
				axios.get('Member/Account/GetAgentSimpleInfo', {
					params: {
						loginId: IntroducerLoginId
					}
				}).then(res => {
					console.log('introducer res', res)
					that.$f7.hidePreloader()
					if(res.IsSuccess === true) {
						if(res.Data.UserType === 1) {
							that.introducer = res.Data
						} else {
							that.$f7.alert('推荐者必须为会员')
							that.inputLoginId = ''
						}
					} else {
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onSelectBranch: function() {
				const that = this
				that.$f7.showPreloader(that.$t('app.register.loading_branch'))
				axios.get('Member/Common/GetBranchCompanyList').then(res => {
					if(res.IsSuccess === true) {
						setTimeout(function() {
							that.$f7.hidePreloader()
							that.$store.dispatch('setBranchCompanyList', {
								branchCompanyList: res.Data
							}).then(() => {
								that.$f7.popup('.register-branch-popup')
							})
						}, 500)
					} else {
						that.$f7.hidePreloader()
						that.$f7.alert(res.ErrorInfos[0].Message)
					}
				})
			},
			onSelectCountry: function() {
				const that = this
				if(that.register_branch.code === '') {
					that.$f7.alert(that.$t('app.register.select_branch_compay'))
				} else {
					that.$f7.popup('.register-country-popup')
				}
			},
			onRegister: function() {
				const that = this
				console.log('onRegister', that.userType)
				if(that.canRegister) {
					if(that.fromType === 'qrcode' && that.introducer === null) {
						that.$f7.alert(that.$t('app.register.introducer_required'))
						return false
					}
					if(that.register_branch.code === '') {
						that.$f7.alert(that.$t('app.register.select_branch_compay'))
						return false
					}
					if(that.register_country.code === '') {
						that.$f7.alert(that.$t('app.register.select_id_card_country'))
						return false
					}
					if(that.password !== that.confirmPassword) {
						that.$f7.alert(that.$t('app.register.password_mismatch'))
						return false
					}
					if(that.userType === '1') {
						console.log('onRegister member')
						// 注册非台湾窗口，身份证号码设置为null
						var idCardNumber = that.idCardNumber
						if(that.register_branch.code !== '4') {
							idCardNumber = null
						}
						that.$f7.showPreloader(that.$t('app.register.submitting_member'))
						// 注册新会员
						axios.post('Member/Member/CreateNew', {
							'CreaterLoginId': that.introducer.LoginId,
							'FullName': that.fullName,
							'Email': that.email,
							'Telephone': that.telephone,
							'BranchCompanyId': that.register_branch.code,
							'CertificateCountryCode': that.register_country.code,
							'IdCardNumber': idCardNumber,
							'Birthday': that.birthday
						}).then(res => {
							that.$f7.hidePreloader()
							console.log('register res', res)
							if(res.IsSuccess === true) {
								// 注册成功，清除注册过程中的一些缓存
								that.onClear()
								let defaultPassword = res.Data.DefaultLoginPassword
								let loginId = res.Data.LoginId
								let telephone = res.Data.Telephone
								that.$f7.mainView.router.load({
									url: `/register_success/?userType=${that.userType}&loginId=${loginId}&telephone=${telephone}&defaultPassword=${defaultPassword}`
								})
							} else {
								that.$f7.alert(res.ErrorInfos[0].Message)
							}
						})
					} else if(that.userType === '3') {
						console.log('onRegister consumer')
						let introducerLoginId = ''
						let introducerName = ''
						if(that.introducer !== null) {
							introducerLoginId = that.introducer.LoginId
							introducerName = that.introducer.FullName
						}
						// 注册消费者
						that.$f7.showPreloader(that.$t('app.register.submitting_consumer'))
						axios.post('Member/Consumer/CreateNew', {
							'BranchCompanyId': that.register_branch.code,
							'CertificateCountryCode': that.register_country.code,
							'IdCardNumber': that.idCardNumber,
							'Email': that.email,
							'FullName': that.fullName,
							'IntroducerLoginId': introducerLoginId,
							'IntroducerName': introducerName,
							'Telephone': that.telephone,
							'Password': that.password
						}).then(res => {
							that.$f7.hidePreloader()
							console.log('register res', res)
							if(res.IsSuccess === true) {
								// 注册成功，清除注册过程中的一些缓存
								that.onClear()
								let defaultPassword = ''
								let loginId = res.Data.LoginId
								let telephone = res.Data.Telephone
								that.$f7.mainView.router.load({
									url: `/register_success/?userType=${that.userType}&loginId=${loginId}&telephone=${telephone}&defaultPassword=${defaultPassword}`
								})
							} else {
								that.$f7.alert(res.ErrorInfos[0].Message)
							}
						})
					}
				}
			}
		},
		components: {}
	}
</script>