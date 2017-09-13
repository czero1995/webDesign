<template>
	<div class="popup select-city-popup">
		<div class="view navbar-fixed">
			<div class="pages">
				<div class="page">
					<div class="navbar">
						<div class="navbar-inner">
							<div class="left">
								<a @click="onClosePopup" href="javascript:void(0);" class="back icon icon-back"></a>
							</div>
							<div class="center text-gradient" v-text="$t('app.page.select_city')">选择城市</div>
							<div class="right" style="padding-right: 0.2rem;">
								<a @click="next" href="javascript:void(0);" class="text-gradient" v-text="$t('app.select_city.next')">下一步</a>
							</div>
						</div>
					</div>
					<div class="page-content">
						<div class="list-block">
							<ul>
								<li :class="{ active: city.Value === selected_city.Value }" @click="onSelectCity(city)" v-for="city in city_list">
									<a href="#" class="item-link item-content">
										<div class="item-content">
											<div class="item-title" v-text="city.Text">
											</div>
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
	.select-city-popup {
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
				selected_city: {
					Text: '',
					Value: ''
				}
			}
		},
		computed: {
			...mapState({
				city_list: state => state.city_list,
				district_list: state => state.district_list,
				fill_info_type: state => state.fill_info_type
			})
		},
		mounted() {
			const that = this
			that.$nextTick(_ => {})
		},
		methods: {
			onClosePopup: function() {
				this.$f7.closeModal('.select-city-popup')
			},
			onFinishSelect: function() {
				//				this.$f7.closeModal('.select-province-popup')
				//				this.$f7.closeModal('.select-city-popup')
				this.$f7.closeModal()
			},
			onSelectCity(city) {
				console.log('onSelectCity', city)
				const that = this
				that.selected_city = city
			},
			next: function() {
				const that = this
				if(that.selected_city.Value.trim().length === 0) {
					that.$f7.alert(that.$t('app.select_city.please_select_city'))
				} else {
					// 设置选中省份信息
					that.$store.dispatch('setFillInfoAddr', {
						type: that.fill_info_type + '_city',
						code: that.selected_city.Value,
						name: that.selected_city.Text
					}).then(() => {
						// 重置省市区
						that.$store.dispatch('setFillInfoAddr', {
							type: that.fill_info_type + '_district',
							code: '',
							name: ''
						}).then(() => {})
						that.$f7.showPreloader(that.$t('app.select_city.loading_district_data'))
						axios.get('Member/Common/GetChildDistrictByParentId?parentId=' + that.selected_city.Value).then(res => {
							console.log('getdistrict', res)
							that.$f7.hidePreloader()
							if(res.IsSuccess === true) {
								that.$store.dispatch('setDistrict', {
									districtList: res.Data
								}).then(() => {
									if(that.district_list.length === 0) {
										that.onFinishSelect()
									} else {
										that.$f7.popup('.select-district-popup')
									}
								})
							} else {
								that.$f7.alert(res.ErrorInfos[0].Message)
							}
						})
					})
				}
			}
		},
		components: {}
	}
</script>