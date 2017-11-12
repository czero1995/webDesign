var WxParse = require('../../wxParse/wxParse.js');
Page({
  data: {
    id: '',
    Pro: [],
    indicatorDots: true,
    autoplay: false,
    interval: 500,
    duration: 100,
    maskVisual: "hidden",
    num:1
  },
  onShow: function () {
    var urlApi = getApp().data.urlApi;
    this.setData({
      urlApi: urlApi
    });
  },
  onLoad: function (options) {
    this.setData({
      id: options.id
    })
  },
  onReady: function () {
    this.ProDet()
  },
  //商品详情
  ProDet: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'goods/getGoodsById',
      data: {
        id: this.data.id,
      },
      success: function (res) {
        var article = res.data.data.goods_desc
        WxParse.wxParse('article', 'html', article, that, 5);
        that.setData({
          Pro: res.data.data
        })
        
      }
    })
  },
  //弹出购物车选项
  cascadePopup: function () {
    var animation = wx.createAnimation({
      duration: 100,
      timingFunction: 'ease-in-out'
    });
    this.animation = animation;
    animation.translateY(-536).step();
    this.setData({
      animationData: this.animation.export(),
      maskVisual: 'show'
    })
  },
  //点击遮区域关闭弹窗
  cascadeDismiss: function () {
    this.animation.translateY(536).step();
    this.setData({
      animationData: this.animation.export(),
      maskVisual: 'hidden'
    });
  },
  //加入购物车
  toast1Tap: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'cart/addGoodsInCart',
      data: {
        goods_id: this.data.Pro.id,
        goods_number: this.data.num
      },
      method: "post",
      success: function (res) {
        that.cascadeDismiss()
        
        wx.showToast({
          title: "成功加入购物车"
        })
      }
    })
    
  },
  //加
  addCount(e) {
    let num = this.data.num;
    num++;
    this.setData({
      num: num
    })
  },
  //减
  minusCount(e) {
    let num = this.data.num;
    if(num>1){
      this.setData({
        num: num - 1
      })
    }
  }
})