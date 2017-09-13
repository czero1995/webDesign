<template>
	<div class="popup register-country-popup">
		<div class="view navbar-fixed">
			<div class="pages">
				<div class="page">
					<div class="navbar">
						<div class="navbar-inner">
							<div class="left">
								<a @click="onClosePopup" href="javascript:void(0);" class="back icon icon-back"></a>
							</div>
							<div class="center text-gradient" v-text="$t('app.register_country.id_card_country')">选择证件国籍</div>
							<div class="right" style="padding-right: 0.2rem;">
								<a @click="next" href="javascript:void(0);" class="text-gradient" v-text="$t('app.register_country.next')">下一步</a>
							</div>
						</div>
					</div>
					<div class="page-content">
						<div class="list-block">
							<ul>
								<li :class="{ active: country.Value === selected_country.Value }" @click="onSelectCountry(country)" v-for="country in register_country_list">
									<a href="#" class="item-link item-content">
										<div class="item-content">
											<div class="item-title" v-text="country.Text"></div>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style lang="less">
	.register-country-popup {
		.list-block {
			margin: 0;
			.choose-top {
				background: #FFFFFF;
				width: 100%;
				height: 0.88rem;
				line-height: 0.88rem;
				margin-bottom: 0.2rem;
				.choose-top-box {
					padding: 0 0.3rem;
					position: relative;
					.top-l {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
					}
					.top-c {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						width: 1.2rem;
						height: 0.34rem;
						letter-spacing: 0.76px;
						line-height: 0.34rem;
						position: absolute;
						left: 0;
						right: 0;
						top: 0;
						bottom: 0;
						margin: auto;
						display: inline-block;
					}
					.top-r {
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #FF7699;
						letter-spacing: 0.76px;
						line-height: 0.88rem;
						float: right;
					}
				}
			}
			.local {
				height: 1.8rem;
				width: 100%;
				margin-bottom: 0.2rem;
				.local-box {
					height: 1.8rem;
					.item-content {
						width: 100%;
						padding-left: 0;
					}
					width:100%;
					.local-this {
						height: 0.8rem;
						padding-left: 0.3rem;
						width: 100%;
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #BFBFBF;
						width: 100%;
						/*padding-bottom: 0.1rem;*/
						display: block;
						letter-spacing: 0.76px;
						line-height: 0.8rem;
						border-bottom: 1px solid #eee;
					}
					.local-address {
						padding: 0 0.3rem;
						font-family: PingFangSC-Regular;
						font-size: 0.26rem;
						color: #595959;
						letter-spacing: 0.76px;
						line-height: 0.8rem;
					}
				}
			}
			>ul {
				>li {
					border-bottom: 1px solid #eee;
					padding-left: 0.3rem;
					.local-this {
						width: 100%;
						font-family: PingFangSC-Medium;
						font-size: 0.26rem;
						color: #BFBFBF!important;
						width: 100%;
						display: block;
						letter-spacing: 0.76px;
						vertical-align: middle;
					}
					.item-content {
						height: 0.88rem;
						line-height: 0.88rem;
						font-size: 0.26rem;
						padding-left: 0;
						.item-title {
							font-family: PingFangSC-Regular;
							font-size: 0.26rem;
							color: #5A5A5A;
							letter-spacing: 0.76px;
							line-height: 0.34rem;
						}
					}
					&.active {
						background-color: #CDB87B;
						.item-title {
							color: #fff;
						}
					}
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
	export default {
		data() {
			return {
				selected_country: {
					Text: '',
					Value: ''
				}
			}
		},
		computed: {
			...mapState({
				register_country_list: state => state.register_country_list
			})
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {
				console.log('register_country_popup')
			})
		},
		methods: {
			onClosePopup: function() {
				//this.$f7.closeModal('.register-branch-popup')
				this.$f7.closeModal('.register-country-popup')
			},
			onFinishSelect: function() {
				//				this.$f7.closeModal('.register-branch-popup')
				//				this.$f7.closeModal('.register-country-popup')
				this.$f7.closeModal()
			},
			onSelectCountry(country) {
				console.log('onSelectCountry', country)
				const that = this
				that.selected_country = country
			},
			next: function() {
				const that = this
				if(that.selected_country.Value.trim().length === 0) {
					that.$f7.alert(that.$t('app.register_country.select_id_card_country'))
				} else {
					console.log('selected_country', that.selected_country)
					// 设置选中国家信息
					that.$store.dispatch('setRegisterBranchCountry', {
						type: 'register_country',
						code: that.selected_country.Value,
						name: that.selected_country.Text
					}).then(() => {
						that.onFinishSelect()
					})
				}
			}
		},
		components: {}
	}
</script>