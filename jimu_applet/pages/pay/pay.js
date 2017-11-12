// page/component/orders/orders.js
Page({
  data: {
    address: {},
    hasAddress: false,
    total: 0,
    orders: [],
    urlApi: '',
    id:''
  },

  onReady() {
  },
  onLoad: function (options) {
    
    const that = this;
    that.setData({
      id: options.id
    })

    console.log(1, that.data.id)
  },

  onShow: function () {
    const that = this;
    var urlApi = getApp().data.urlApi;
    that.setData({
      urlApi: urlApi
    });

    that.OrderList();
    // wx.getStorage({
    //   key: 'address',
    //   success(res) {
    //     that.setData({
    //       address: res.data,
    //       hasAddress: true
    //     })
    //   }
    // })

    
  },
  OrderList: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'order/getOrderById',
      data:{
        id:that.data.id
      },
      success: function (res) {
        that.setData({
          orders: res.data.data
        });
        
        console.log(res.data);
      }
    })

  }
})