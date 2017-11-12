// pages/car/car.js
Page({

  /**
   * 页面的初始数据
   */
  data: {
    CarList: [],
    hasList: false,          // 列表是否有数据
    totalPrice: 0,           // 总价，初始为0
    selectAllStatus: false,
    urlApi: "",
    ProListId: [],
    ProList: '',
    payId: ''
  },
  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {
  },
  toast1Tap: function () {
    var that = this;
    wx.request({
      url: that.data.urlApi + 'cart/getCartList',
      success: function (res) {
        
        that.setData({
          CarList: res.data.data.data
        })
        var CarLists = that.data.CarList;
        var i;
        for (i in CarLists) {
          CarLists[i]["selected"] = false;
        }
      }
    })

  },
  selectList(e) {
    const index = e.currentTarget.dataset.index;
    let CarList = this.data.CarList;
    const selected = CarList[index].selected;
    CarList[index].selected = !selected;
    if (selected == true){
      this.setData({
        selectAllStatus: false
      });
    }
    this.setData({
      CarList: CarList
    });
    this.getTotalPrice();
  },
  onShow: function () {
    var urlApi = getApp().data.urlApi;
    this.setData({
      urlApi: urlApi
    });
    this.toast1Tap()
  },

  /**
   * 删除购物车当前商品
   */
  deleteList(e) {
    const index = e.currentTarget.dataset.index;
    let CarList = this.data.CarList;
    CarList.splice(index, 1);
    this.setData({
      CarList: CarList
    });
    if (!CarList.length) {
      this.setData({
        hasList: false
      });
    } else {
      this.getTotalPrice();
    }
  },

  /**
   * 购物车全选事件
   */
  selectAll(e) {
    let selectAllStatus = this.data.selectAllStatus;
    selectAllStatus = !selectAllStatus;
    let CarList = this.data.CarList;

    for (let i = 0; i < CarList.length; i++) {
      CarList[i].selected = selectAllStatus;
    }
    this.setData({
      selectAllStatus: selectAllStatus,
      CarList: CarList
    });
    this.getTotalPrice();
  },

  /**
   * 绑定加数量事件
   */
  addCount(e) {
    const index = e.currentTarget.dataset.index;
    let CarList = this.data.CarList;
    let goods_number = CarList[index].goods_number;
    goods_number = goods_number + 1;
    CarList[index].goods_number = goods_number;
    this.setData({
      CarList: CarList
    });
    this.getTotalPrice();
  },

  /**
   * 绑定减数量事件
   */
  minusCount(e) {
    const index = e.currentTarget.dataset.index;
    const obj = e.currentTarget.dataset.obj;
    let CarList = this.data.CarList;
    let goods_number = CarList[index].goods_number;
    if (goods_number <= 1) {
      return false;
    }
    goods_number = goods_number - 1;
    CarList[index].goods_number = goods_number;
    this.setData({
      CarList: CarList
    });
    this.getTotalPrice();
  },

  /**
   * 计算总价
   */
  getTotalPrice() {
    let CarList = this.data.CarList;                  // 获取购物车列表
    let total = 0;
    for (let i = 0; i < CarList.length; i++) {         // 循环列表得到每个数据
      if (CarList[i].selected) {                     // 判断选中才会计算价格
        total += CarList[i].goods_number * CarList[i].present_price;   // 所有价格加起来
      }
    }
    this.setData({                                // 最后赋值到data中渲染到页面
      CarList: CarList,
      totalPrice: total.toFixed(2)
    });
  },
  GenerateOrders: function () {
    var that = this;
    var CarLists = that.data.CarList;
    var i;
    for (i in CarLists) {
      if (CarLists[i].selected == true){
        that.data.ProListId.push(CarLists[i].id)
      }
    }
    that.data.ProList = that.data.ProListId.join(',')

    wx.request({
      url: that.data.urlApi + 'order/createOrder',
      data: {
        cart: that.data.ProList
      },
      method: "post",
      success: function (res) {
        that.setData({
          payId: res.data.data
        })
        console.log(2,that.data.payId)
        var id = that.data.payId;
        wx.navigateTo({
          url: '/pages/pay/pay?id=' + id
        })
      }
    })
    
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  
  }
})