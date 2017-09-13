<template>
	<div data-page="bonus" class="page bonus-page">
		<!-- Top Navbar-->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="left" @click="routeBack">
					<a href="javascript:void(0);" class="back icon icon-back"></a>
				</div>
				<div class="center"><span class="text-gradient" v-text="$t('app.page.bonus')">我的奖金</span></div>
			</div>
		</div>
		<!-- /End of Top Navbar-->
		<div class="page-content">
			<div class="top">
				<div class="userImg">
					<img v-if="agent_level_info.LevelId === 1" src="../../static/icon/level_1.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 2" src="../../static/icon/level_2.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 3" src="../../static/icon/level_3.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 4" src="../../static/icon/level_4.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 5" src="../../static/icon/level_5.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 6" src="../../static/icon/level_6.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 7" src="../../static/icon/level_7.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 8" src="../../static/icon/level_8.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 9" src="../../static/icon/level_9.png" class="userPhoto" />
					<img v-if="agent_level_info.LevelId === 10" src="../../static/icon/level_10.png" class="userPhoto" />
				</div>
				<p class="userName">{{agent_level_info.BizLoginId}}</p>
				<div class="upText" v-if="agent_level_info.NextLevelRemainPV === 0">{{agent_level_info.CrownOrLevelName}}</div>
				<div class="upText" v-if="agent_level_info.NextLevelRemainPV > 0" v-text="$t('app.bonus.next_upgrade')">距离下次升级</div>
				<p class="bv" v-if="agent_level_info.NextLevelRemainPV > 0">{{agent_level_info.NextLevelRemainPV}}BV</p>
			</div>
			<div class="bonus-center">
				<p class="bonus-title text-gradient" v-text="$t('app.bonus.recent_bonus_income')">最近奖金收入</p>
				<div class="echarts">
					<IEcharts :option="bar" :loading="loading" @ready="onReady" @click="onClick"></IEcharts>
				</div>
			</div>
			<div style="padding: 10px; text-align: center;" v-if="bonus_list.length === 0">
				<p class="text-gradient" v-text="$t('app.bonus.have_no_data')">暂时没有奖金数据</p>
			</div>
			<div class="bottom">
				<div class="bottom-item" v-for="item in bonus_list">
					<div class="bonus-item clearfloat" @click="onShowBonusDetails(item)">
						<div class="bonus-l">
							<span class="bonus-date">{{item.CreateDate}}</span>
						</div>
						<div class="bonus-r">
							<span class="bonus-text" v-text="$t('app.bonus.total_bonus')">净值小计:</span>
							<span class="bonus-money text-gradient">${{item.TotalBonus}}<span class="money-s"></span></span>
							<img src="../../static/icon/list_btn_more_nor@3x.png" class="moreBtn" v-show="!item.showBonusDetails" />
							<img src="../../static/icon/list_btn_back_nor@3x.png" class="moreBtn" v-show="item.showBonusDetails" />
						</div>
					</div>
					<div class="bonus-detail" v-show="item.showBonusDetails">
						<ul>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.retail_bonus')">零售奖金</span>
								<span class="detail-r text-gradient">${{item.RetailBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.direct_introducer_bonus')">个人销售奖金</span>
								<span class="detail-r text-gradient">${{item.DirectIntroducerBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.team_bonus')">组织销售奖金</span>
								<span class="detail-r text-gradient">${{item.TeamBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.rebate_bonus')">回馈奖</span>
								<span class="detail-r text-gradient">${{item.RebateBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.reSales_bonus')">重消奖</span>
								<span class="detail-r text-gradient">${{item.ReSalesBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.elite_bonus')">精英奖</span>
								<span class="detail-r text-gradient">${{item.EliteBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.hereditary_bonus')">世袭奖</span>
								<span class="detail-r text-gradient">${{item.HereditaryBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.total_bonus_after_tax')">领导奖金</span>
								<span class="detail-r text-gradient">${{item.LeaderBonus}}<span class="money-s"></span></span>
							</li>
							<li class="clearfloat">
								<span class="detail-l" v-text="$t('app.bonus.bonus_tax')">代扣税</span>
								<span class="detail-r text-gradient">${{item.BonusTax}}<span class="money-s"></span></span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.bonus-page {
		.top {
			width: 100%;
			height: 3.8rem;
			background-image: linear-gradient(-136deg, #E6CF8B 0%, #D1B774 17%, #BA9E5A 36%, #6C4503 100%);
			padding-bottom: 0.59rem;
			padding-top: 0.59rem;
			.userImg {
				width: 1.24rem;
				height: 1.24rem;
				margin: 0 auto;
			}
			.userName {
				font-family: PingFangSC-Medium;
				font-size: 0.26rem;
				color: #FFFFFF;
				letter-spacing: 0.76px;
				line-height: 0.34rem;
				text-align: center;
				padding-top: 0.23rem;
				padding-bottom: 0.22rem;
			}
			.userPhoto {
				width: 1.19rem;
				height: 1.19rem;
			}
			.upText {
				font-family: PingFangSC-Light;
				font-size: 0.2rem;
				color: #FFFFFF;
				letter-spacing: 0.59px;
				line-height: 0.34rem;
				text-align: center;
				padding-bottom: 0.2rem;
			}
			.bv {
				width: 1.16rem;
				border: 1px solid #FFFFFF;
				border-radius: 1rem;
				font-family: PingFangSC-Medium;
				font-size: 0.18rem;
				color: #FFFFFF;
				letter-spacing: 0.53px;
				margin: 0 auto;
				text-align: center;
				padding: 4px;
			}
		}
		.bonus-center {
			height: 4.68rem;
			margin-top: 0.2rem;
			background: #FFFFFF;
			.bonus-title {
				font-family: PingFangSC-Medium;
				font-size: 0.26rem;
				letter-spacing: 0.76px;
				line-height: 0.34rem;
				padding-left: 0.3rem;
			}
			.echarts {
				width: 94%;
				height: 4.6rem;
				padding: 0 0 0 4%;
			}
		}
		.bottom {
			margin-top: 0.2rem;
			background: #FFFFFF;
			.bonus-item {
				width: 100%;
				height: 0.88rem;
				background: #ffffff;
				line-height: 0.88rem;
				border-bottom: 1px solid #eee;
				.bonus-l {
					float: left;
					padding-left: 0.3rem;
					.bonus-date {
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #B4B4B4;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
				}
				.bonus-r {
					float: right;
					padding-right: 0.3rem;
					.bonus-text {
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #696969;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
					.bonus-money {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #000000;
						letter-spacing: 0.76px;
						line-height: 0.28rem;
						padding: 0 0.1rem;
						.money-s {
							font-family: PingFangSC-Medium;
							font-size: 0.2rem;
							color: #000000;
							letter-spacing: 0.59px;
							line-height: 28px;
						}
					}
					.moreBtn {
						width: 0.3rem;
						height: 0.16rem;
						display: inline-block;
						vertical-align: middle;
					}
				}
			}
			.bonus-detail {
				background: #FFFFFF;
				>ul {
					margin: 0;
					list-style: none;
					padding: 0;
					>li {
						height: 0.88rem;
						border-bottom: 1px solid #eee;
					}
				}
				.detail-l {
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					padding-left: 0.3rem;
					line-height: 0.88rem;
				}
				.detail-r {
					font-family: PingFangSC-Medium;
					font-size: 0.26rem;
					color: #8E8E8E;
					float: right;
					padding-right: 0.3rem;
					letter-spacing: 0.59px;
					line-height: 0.88rem;
				}
			}
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
	import IEcharts from 'vue-echarts-v3/src/full.vue'
	//	import IEcharts from 'vue-echarts-v3/src/lite.vue'
	//	import 'echarts/lib/chart/line'
	//	import 'echarts/lib/component/title'
	export default {
		data() {
			return {
				loading: false,
				fromType: 'home', // 默认从首页进入奖金页面
				bar: {
					title: {
						left: 'left',
					},
					toooltip: {},
					legend: {},
					xAxis: {
						data: []
					},
					yAxis: {},
					series: [{
						name: 'Sales',
						type: 'line',
						data: []
					}]
				},
				my_bonus: {}, //我的奖金
				agent_level_info: {}, //我的奖金二级会员信息
				bonus_simple_summary: [], //我的奖金二级曲线信息
				bonus_list: [], //我的奖金二级详细信息
			}
		},
		computed: {
			...mapState({
				plusReady: state => state.plusReady,
				user: state => state.user
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
				that.fromType = query.fromType // 来源类型 home  member
				that.myBonus()
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
						url: '/' + that.fromType + '/'
					})
				} else {
					that.$f7.closeModal(modalIn[modalIn.length - 1])
				}
			},
			myBonus() {
				const that = this
				that.$f7.showPreloader(that.$t('app.bonus.loading'))
				axios.get('Member/Member/GetAgentBonusInfo?pageSize=10', {}).then(res => {
					console.log('myBonus:', res)
					if(res.IsSuccess === true) {
						that.$f7.hidePreloader()
						let myBonus = res.Data
						myBonus.BonusList.forEach(function(item) {
							item.showBonusDetails = false
							console.log('createDate before', item.CreateDate)
							item.CreateDate = new Date(item.CreateDate).format('yyyy-MM-dd')
							console.log('createDate after', item.CreateDate)
						})
						that.my_bonus = myBonus
						that.agent_level_info = myBonus.AgentLevelInfo
						that.bonus_simple_summary = myBonus.BonusSimpleSummary
						that.bonus_list = myBonus.BonusList
						that.doRandom(that.bonus_simple_summary)
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
			onShowBonusDetails(item) {
				console.log('onShowBonusDetail', item)
				const that = this
				that.bonus_list.forEach(function(bonusItem) {
					if(bonusItem !== item) {
						bonusItem.showBonusDetails = false
					}
				})
				item.showBonusDetails = !item.showBonusDetails
			},
			doRandom(list) {
				list.reverse()
				console.log(list)
				const that = this
				let data = []
				let dateList = []
				list.forEach(function(item, index) {
					console.log('doRandom item', item.TotalBonusAfterTax)
					console.log('index', index)
					if(index <= 4) {
						// 奖金单位用K表示
						data.push(item.TotalBonusAfterTax / 1000)
						dateList.push(new Date(item.CreateDate).format('MM-dd'))
					}
				})
				that.bar.series[0].data = data
				that.bar.xAxis.data = dateList
			},
			onReady(instance) {
				console.log('instance', instance)
			},
			onClick(event, instance, echarts) {
				console.log(arguments)
			}
		},
		components: {
			IEcharts
		}
	}
</script>