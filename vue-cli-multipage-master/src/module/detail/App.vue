<template>
  <div id="app">
    <div class="header clearfloat">
				<a href="javascript:history.back(-1)">
					<img src="../../common/img/icon/arrowBack.png" />
				</a>
				<p>商品详情</p>
			</div>
			<div class="container">
					<div class="goods-img">
						<img :src="goodsDetail.goods_thumb" />
					</div>			
				<div class="goodsBox">
					
					<p class="goods-name">{{goodsDetail.goods_name}}</p>
					<div class="goods-coachBox inlinkFlex">
						<p class="goods-coachNew">¥{{goodsDetail.present_price}}</p>
						<p class="goods-coachOld">¥{{goodsDetail.original_price}}</p>
					</div>

				</div>
				<div class="goodsDetail">
					<p>商品详情</p>
					<div v-html="goodsDetail.goods_desc">
						
					</div>
				</div>

				<div class="bottom inlinkFlex-spacebetween">
					<a href="cart.html" class=" cartImg">
						<img src="../../common/img/icon/shop_addCart.png" />
					</a>
					<div class="external addCart" @click="addCartModel=true">

						<span class="tabbar-label">加入购物车</span>
					</div>
					<div class="external addPay" @click="payModel=true">
						<span class="tabbar-label">立即购买</span>
					</div>
				</div>
			</div>
			<!--加入购物车-->
			<div class="model" v-show="addCartModel">
				<div class="addCart-content" @click.stop="addCartModel=true">
					<div class="cartModel-box inlinkFlex">
						<div class="cartModel-img">
							<img :src="goodsDetail.goods_thumb" />
						</div>
						<div class="cartModel-text">
							<div class="inlinkFlex-spacebetween">
								<p>{{goodsDetail.goods_name}}</p>
								<img src="../../common/img/icon/close.png" class="cartClose" @click.stop="addCartModel=false" />
							</div>

							<p class="cartModel-coach">¥{{goodsDetail.present_price}}</p>
						</div>

					</div>
					<div class="cartModel-bottom inlinkFlex-spacebetween">
						<p>购买数量</p>
						<div class="cartModel-op">
							<img src="../../common/img/icon/shop_cut.png" @click="onCutGoods()" />
							<input type="text" :value="goodsNum" readonly=""/>
							<img src="../../common/img/icon/shop_add.png" @click="onAddGoods()" />
						</div>
					</div>
					<div class="cartModel-addCart" @click.stop="onAddCart()">
						加入购物车
					</div>
				</div>
			</div>

			<!--立即购买-->
			<div class="model" v-show="payModel" >
				<div class="addCart-content" @click.stop="payModel=true">
					<div class="cartModel-box inlinkFlex">
						<div class="cartModel-img">
							<img :src="goodsDetail.goods_thumb" />
						</div>
						<div class="cartModel-text">
							<div class="inlinkFlex-spacebetween">
								<p>{{goodsDetail.goods_name}}</p>
									<img src="../../common/img/icon/close.png" class="cartClose" @click.stop="payModel=false" />
							</div>
							<p class="cartModel-coach">¥{{goodsDetail.present_price}}</p>
						</div>
					</div>
					<div class="cartModel-bottom inlinkFlex-spacebetween">
						<p>购买数量</p>
						<div class="cartModel-op">
							<img src="../../common/img/icon/shop_cut.png" @click="onCutGoods()" />
							<input type="text" :value="goodsNum" readonly=""/>
							<img src="../../common/img/icon/shop_add.png" @click="onAddGoods()" />
						</div>
					</div>
					<a href="orderwaitDetail.html">
						<div class="cartModel-pay">
							下一步
						</div>
					</a>
				</div>
			</div>
			
			<!--提示成功弹窗-->
			<div class="model" v-show="successModel">
				<div class="model-content tip-content">
					<p>添加成功</p>
					<p @click="successModel=false">确定</p>
				</div>
			</div>
			
			<!--提示失败弹窗-->
			<div class="model" v-show="failModel">
				<div class="model-content tip-content">
					<p>添加失败</p>
					<p @click="failModel=false">确定</p>
				</div>
			</div>
  </div>
</template>

<script>
	import axios from 'axios';
	import bases from 'components/Base/Base'  
  import 'common/less/detail.less'  	 
  export default {
    name: 'app',
  	data() {
					return {
						addCartModel: false, /*添加购物车*/
						payModel: false,   /*支付*/
						successModel:false,/*添加成功*/
						failModel:false,/*添加失败*/
						aid:'', /*获取地址传值*/
						goodsDetail:{}, /*获取商品详情信息*/
						goodsNum:1 /*商品数量*/
					}
				},
				components: {
			     bases
			   },
				mounted: function() {			
					this.getUrlParam('id');
					this.getGoodsDetail();
				},
				methods: {
					/*获取商品详情*/
					getGoodsDetail: function() {
						const that = this;
						axios.post('http://api.jimuapi.com/wx/goods/getGoodsById/?id='+that.aid, {
						}).then(function(res) {
								that.goodsDetail = res.data.data;
								console.log('goodsDetail',that.goodsDetail);
							})
							.catch(function(error) {
								console.log(error);
							});
					},
					/*获取地址传值*/
					getUrlParam(name) {
						const that = this;
						var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
						var r = window.location.search.substr(1).match(reg);
						if(r != null) {
							that.aid = r[2];
							return(r[2]);
						}
					},
					/*添加商品数量*/
					onAddGoods(){
						const that = this;
						that.goodsNum ++ ;
					},
					/*减少商品数量*/
					onCutGoods(){
						const that = this;
						if(that.goodsNum > 1){
							that.goodsNum -- ;
						}
					},
					/*添加到购物车*/
					onAddCart(){
						const that = this;
						that.addCartModel=false;
						axios.post('http://api.jimuapi.com/wx/cart/addGoodsInCart/', {
							'goods_id': that.goodsDetail.id,
							'goods_number': that.goodsNum,
						}).then(function(res) {
							if(res.data.errcode == 200){
								that.successModel = true;
							}else{
								that.failModel = true;
							}
								console.log('addcartData',res.data)
							})
							.catch(function(error) {
								console.log(error);
							});
					}
				}
  }
</script>

