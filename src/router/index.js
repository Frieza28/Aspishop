import { createRouter, createWebHistory } from 'vue-router'
import  Home from '@/views/Home.vue'
import  Menu from '@/views/Menu.vue'
import  Basket from '@/views/Basket.vue'
import  Register from '@/views/Register.vue'
import  Login from '@/views/Login.vue'
import  MyOrders from '@/views/MyOrders.vue'
import  Message from '@/views/Message.vue'
import  Logout from '@/views/Logout.vue' 
import  Product from '@/views/Product.vue'

const routes = [
  {
    path: '/',
    component: Home,
    name: 'home'
  },
  {
    path: '/menu/:id',
    component: Menu,
    name: 'menu'
  }, 
  {
    path: '/product/:id',
    component: Product,
    name: 'product'
  }, 
  {
    path: '/basket',
    component: Basket,
    name: 'basket'
  }, 
  {
    path: '/register',
    component: Register,
    name: 'register'
  },
  {
    path: '/login',
    component: Login,
    name: 'login'
  }, 
  {
    path: '/myorders',
    component: MyOrders,
    name: 'myorders'
  }, 
  {
    path: '/message/:id',
    component: Message,
    name: 'message'
  },  
  {
    path: '/logout',
    component: Logout,
    name: 'logout'
  },       
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
