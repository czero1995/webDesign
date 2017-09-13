import Vue from 'vue'
import Router from 'vue-router'
import Index from '@/components/index'    //首页
import Model from '@/components/model/model.vue'    //模特页
import Message from '@/components/message/message.vue'    //信息页
import Wd from '@/components/wd/wd.vue'   //个人中心页
import Login from '@/components/wd/login.vue'   //个人中心-登录
import Signin from '@/components/wd/signin.vue'   //个人中-注册
import Xzsf from '@/components/wd/xzsf.vue'   //个人中-选择身份

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '*',
      component: Index
    },
    {
      path: '/index',
      component: Index
    },
    {
      path: '/model',
      component: Model
    },
    {
      path: '/message',
      component: Message
    },
    {
      path: '/wd',
      component: Wd,
      children:[
        {
          path: '*',
          component: Login
        },
        {
          path:'/',
          component: Login
        },
        {
          path:'/login',
          component: Login
        }         
      ]
    },
    {
      path:'/signin',
      component:Signin
    },
    {
      path:'/xzsf',
      component:Xzsf
    },
    {
      path:'/login',
      component: Login
    }   
  ]
})
