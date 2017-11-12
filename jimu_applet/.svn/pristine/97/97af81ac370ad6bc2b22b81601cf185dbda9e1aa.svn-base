// pages/ProductList/ProductList.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    categoryList: [],
    ProList: [],
    categoryId: '',
    urlApi: '',
    page: 1,
    loading: true,
    msg: true,
    curIndex: 0

  },
  category: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'category/getCategoryList',
      success: function (res) {
          that.setData({
            categoryList: res.data.data.data,
            categoryId: res.data.data.data[0].id
          });
          that.ProductList();
      }
    })
  },
  swithtab: function(e){
    var that = this;

    that.setData({
      categoryId: e.target.dataset.id,
      curIndex: e.target.dataset.index,
      page: 1
    })
    console.log("categoryId1", that.data.categoryId)
    console.log("page1", that.data.page)
    that.ProductList();
  },
  ProductList: function () {
    var that = this; 
    wx.request({
      url: that.data.urlApi + 'goods/getGoodsList',
      data: {
        cat_id: that.data.categoryId,
        page: that.data.page
      },
      success: function (res) {

        var list = that.data.ProList
        console.log()
        if (res.data.data.data.length > 0) {
          if (that.data.page == 1){
            that.setData({
              ProList: res.data.data.data,
              loading: true
            });
            console.log("page2", that.data.ProList)
          }else{
            for (var i = 0; i < res.data.data.data.length; i++) {
              list.push(res.data.data.data[i])
            }
            that.setData({
              ProList: list,
              loading: true
            });
            console.log("page2", 2)
          }
          
          that.data.page++;
        } else {
          that.setData({
            msg: false
          });
        }

      }
    })
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
  
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  
  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {
    var urlApi = getApp().data.urlApi;
    this.setData({
      urlApi: urlApi
    });
    this.category();
  },


  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    var that = this;
    that.setData({
      loading: false
    });
    that.ProductList();
  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  }
})