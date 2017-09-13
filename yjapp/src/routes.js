export default [{
		path: '/app',
		component: require('./pages/tabbar.vue'),
		tabs: [{
				path: '/home/',
				tabId: 'home',
				component: require('./pages/home.vue')
			},
			{
				path: '/cart/',
				tabId: 'cart',
				component: require('./pages/cart.vue')
			},
			{
				path: '/order/',
				tabId: 'order',
				component: require('./pages/order.vue')
			},
			{
				path: '/member/',
				tabId: 'member',
				component: require('./pages/member.vue')
			}
		]
	},
	{
		path: '/home/',
		component: require('./pages/home.vue')
	},
	{
		path: '/scan_qrcode/',
		component: require('./pages/scan_qrcode.vue')
	},
	{
		path: '/select_join/',
		component: require('./pages/select_join.vue')
	},
	{
		path: '/order/',
		component: require('./pages/order.vue')
	},
	{
		path: '/cart/',
		component: require('./pages/cart.vue')
	},
	{
		path: '/member/',
		component: require('./pages/member.vue')
	},
	{
		path: '/profile/',
		component: require('./pages/profile.vue')
	},
	{
		path: '/language/',
		component: require('./pages/language.vue')
	},
	{
		path: '/branch_company_list/',
		component: require('./pages/branch_company_list.vue')
	},
	{
		path: '/settings/',
		component: require('./pages/settings.vue')
	},
	{
		path: '/login/',
		component: require('./pages/login.vue')
	},
	{
		path: '/login_agreement/',
		component: require('./pages/login_agreement.vue')
	},
	{
		path: '/login_fill_info/',
		component: require('./pages/login_fill_info.vue')
	},
	{
		path: '/register/',
		component: require('./pages/register.vue')
	},
	{
		path: '/register_success/',
		component: require('./pages/register_success.vue')
	},
	{
		path: '/address/',
		component: require('./pages/address.vue')
	},
	{
		path: '/add_address/',
		component: require('./pages/add_address.vue')
	},
	{
		path: '/bonus/',
		component: require('./pages/bonus.vue')
	},
	{
		path: '/card/',
		component: require('./pages/card.vue')
	},
	{
		path: '/delivery/',
		component: require('./pages/delivery.vue')
	},
	{
		path: '/score/',
		component: require('./pages/score.vue')
	},
	{
		path: '/modify_login_password/',
		component: require('./pages/modify_login_password.vue')
	},
	{
		path: '/modify_pay_password/',
		component: require('./pages/modify_pay_password.vue')
	},
	{
		path: '/payment/',
		component: require('./pages/payment.vue')
	},
	{
		path: '/payment_details/',
		component: require('./pages/payment_details.vue')
	},
	{
		path: '/goods_list/',
		component: require('./pages/goods_list.vue')
	},
	{
		path: '/goods_details/',
		component: require('./pages/goods_details.vue')
	},
	{
		path: '/wallet/',
		component: require('./pages/wallet.vue')
	},
	{
		path: '/order/',
		component: require('./pages/order.vue')
	},
	{
		path: '/order_confirm/',
		component: require('./pages/order_confirm.vue')
	},
	{
		path: '/order_details/',
		component: require('./pages/order_details.vue')
	},
	{
		path: '/member/',
		component: require('./pages/member.vue')
	},
	{
		path: '/cart/',
		component: require('./pages/cart.vue')
	},
	{
		path: '/retrieve_password/',
		component: require('./pages/retrieve_password.vue')
	},
	{
		path: '/friend_payment/',
		component: require('./pages/friend_payment.vue')
	},
	{
		path: '/friend_payment_details/',
		component: require('./pages/friend_payment_details.vue')
	}
]