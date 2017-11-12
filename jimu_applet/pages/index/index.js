//index.js
Page({
  data: {
    imgUrls: [],
    ProList: [],
    indicatorDots: true,
    autoplay: false,
    interval: 500,
    duration: 100,
    page: 1,
    loading: true,
    msg:true
  },
  onShow: function () {
    var urlApi = getApp().data.urlApi;
    this.setData({
      urlApi: urlApi
    });
    this.Banner();
    this.indexList()
  },
  onReachBottom: function () {
    var that = this;
    that.setData({
      loading: false
    }); 
    that.indexList();
  },
  Banner: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'banner/getBannerList',
      success: function (res) {
        that.setData({
          imgUrls: res.data.data.data
        })
      }
    })
  },
  indexList: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'goods/getGoodsList',
      data: {
        page: that.data.page,
        
      },
      success: function (res) {
        
        var list = that.data.ProList
        if (res.data.data.data.length>0){
          for (var i = 0; i < res.data.data.data.length; i++) {
            list.push(res.data.data.data[i])
          }
          that.setData({
            ProList: list,
            loading: true
          });
          that.data.page++;
        }else{
          that.setData({
            ProList: list,
            msg: false,
            loading: true
          });
        }
        
      }
    })
  }
})