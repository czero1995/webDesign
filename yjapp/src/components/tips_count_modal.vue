<template>
	<!--提示结算日-->
	<div class="yj-modal tipCountModal" v-if="tip_count != null">
		<div class="modal-content tipCountModal-content">
			<div class="content-box">
				<p class="content-text">
					今日为億嘉國際{{tip_count.FinancialYear}}财政年度第{{tip_count.TermOfYear}}期第{{tip_count.WeekOfTerm}}周第{{tip_count.DayOfWeek}}天
				</p>
				<p class="content-text">
					本期时间：{{tip_count.WeekRang.Start}} (香港时间)
				</p>
				<p class="content-text">
					本期业绩将于{{tip_count.TermSettlementDate}}结算 (香港时间)
				</p>
				<div class="tip-show">
					<img class="tip-img" src="../../static/icon/list_Unselected_nor@3x.png" />
					<span class="tip-title">今日不再提醒</span>
				</div>
			</div>
			<div class="tip-bottom">
				确定
			</div>
		</div>
	</div>
</template>
<style lang="less">
	.tipCountModal {
		.tipCountModal-content {
			width: 5.5rem!important;
			height: 6.73rem!important;
			.content-box {
				padding-top: 0.94rem;
				.content-text {
					padding-left: 0.76rem;
					padding-right: 0.76rem;
					margin: 0;
					font-family: PingFangSC-Regular;
					font-size: 0.26rem;
					color: #696969;
					letter-spacing: 0.76px;
					line-height: 0.46rem;
					padding-bottom: 0.18rem;
				}
				.tip-show {
					margin-top: 0.7rem;
					text-align: center;
					.tip-img {
						width: 0.34rem;
						height: 0.34rem;
						margin-right: 0.1rem;
						vertical-align: middle;
					}
					.tip-title {
						font-family: PingFangSC-Medium;
						font-size: 0.28rem;
						color: #FF7D00;
						letter-spacing: 0.82px;
					}
				}
			}
			.tip-bottom {
				margin-top: 0.63rem;
				font-family: PingFangSC-Regular;
				font-size: 0.26rem;
				width: 100%;
				height: 0.88rem;
				color: #FFFFFF;
				text-align: center;
				letter-spacing: 0.76px;
				line-height: 0.88rem;
				background: url(../../static/icon/list_bg_content_sel@3x.png);
			}
		}
	}
</style>
<script>
	import { mapState } from 'vuex'
	export default {
		data() {
			return {

			}
		},
		computed: {
			...mapState({
				tip_count: state => state.tip_count
			})
		},
		mounted() {
			this.$nextTick(_ => {
				const that = this
				that.$store.dispatch('getTipCount').then(() => {})
			})
		},
		method: {}
	}
</script>