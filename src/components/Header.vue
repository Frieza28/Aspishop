<template>
  <div v-if="currentPage === 'home'">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark navbarTop">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand">
          <div class="brand-container">
            <img :src="'./images/robot.png'" alt="" width="330" class="navbar-logo"/>
            <h1 class="brand-title">AspiShop</h1>
          </div>
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTop">
          <ul class="navbar-nav ms-auto text-right">
              <li v-if="userStore.isAuthenticated">
                <a class="nav-link disabled">{{ `Bem-vindo ${userStore.getUser.name}` }}</a>
              </li>
              <li v-else>
                <a class="nav-link disabled">Bem-vindo</a>
              </li>
              <router-link to="/" style="margin-right: 10px;">
                <img :src="'./images/home.png'" alt="Home" class="button-image" style="margin-left: 0px"/>
              </router-link>
              <li v-if="userStore.isAuthenticated">
                <button class="btn btn-outline-light" style="margin-right: 10px;" @click="redirectToMyOrders">Encomendas</button>
              </li>
              <li v-if="userStore.isAuthenticated">
                <router-link to="/logout" type="button" class="btn btn-outline-light" style="margin-right: 10px;">Logout</router-link>
              </li>
              <li v-if="userStore.isAuthenticated == false">
                <router-link to="/login" type="button" class="btn btn-outline-light" style="margin-right: 10px;">Login</router-link>
              </li>
              <li v-if="userStore.isAuthenticated == false">
                <router-link to="/register" type="button" class="btn btn-outline-light" style="margin-right: 10px;">Register</router-link>
              </li>
          </ul>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbarTop" style="background-color: #d4d4d4; border-bottom: 1px solid black;">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarTop">
          <ul class="navbar-nav">
            <router-link :to="{ name: 'menu', params: { id: '0' }, key: 'menu-0' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Produtos</router-link>
            <router-link :to="{ name: 'menu', params: { id: '3' }, key: 'menu-3' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Promo</router-link>
            <router-link :to="{ name: 'menu', params: { id: '1' }, key: 'menu-1' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Aspiradores Robot</router-link>
            <router-link :to="{ name: 'menu', params: { id: '2' }, key: 'menu-2' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Aspiradores Verticais</router-link>
            <router-link to="/basket">
              <img :src="'./images/shop.png'" alt="Basket" class="button-image btn-sm btn-sm-margin"/>
              <span class="badge bg-light text-dark" v-if="basketStore.getProducts.length > 0">
                {{ getTotalQuantity(basketStore.getProducts) }}
              </span></router-link>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <div v-if="currentPage === 'menu'">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark navbarTop">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand">
          <div class="brand-container">
            <img :src="'../images/robot.png'" alt="" width="330" class="navbar-logo"/>
            <h1 class="brand-title">AspiShop</h1>
          </div>
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTop">
          <ul class="navbar-nav ms-auto text-right">
              <li v-if="userStore.isAuthenticated">
                <a class="nav-link disabled">{{ `Bem-vindo ${userStore.getUser.name}` }}</a>
              </li>
              <li v-else>
                <a class="nav-link disabled">Bem-vindo</a>
              </li>
              <router-link to="/" style="margin-right: 10px;">
                <img :src="'../images/home.png'" alt="Home" class="button-image" style="margin-left: 0px"/>
              </router-link>
              <li v-if="userStore.isAuthenticated">
                <button class="btn btn-outline-light" style="margin-right: 10px;" @click="redirectToMyOrders">Encomendas</button>
              </li>
              <li v-if="userStore.isAuthenticated">
                <router-link to="/logout" type="button" class="btn btn-outline-light" style="margin-right: 10px;">Logout</router-link>
              </li>
              <li v-if="userStore.isAuthenticated == false">
                <router-link to="/login" type="button" class="btn btn-outline-light" style="margin-right: 10px;">Login</router-link>
              </li>
              <li v-if="userStore.isAuthenticated == false">
                <router-link to="/register" type="button" class="btn btn-outline-light" style="margin-right: 10px;">Register</router-link>
              </li>
          </ul>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbarTop" style="background-color: #d4d4d4; border-bottom: 1px solid black;">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarTop">
          <ul class="navbar-nav">
            <router-link :to="{ name: 'menu', params: { id: '0' }, key: 'menu-0' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Produtos</router-link>
            <router-link :to="{ name: 'menu', params: { id: '3' }, key: 'menu-3' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Promo</router-link>
            <router-link :to="{ name: 'menu', params: { id: '1' }, key: 'menu-1' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Aspiradores Robot</router-link>
            <router-link :to="{ name: 'menu', params: { id: '2' }, key: 'menu-2' }" class="btn btn-outline-dark btn-sm btn-sm-margin">Aspiradores Verticais</router-link>
            <router-link to="/basket">
              <img :src="'../images/shop.png'" alt="Basket" class="button-image btn-sm btn-sm-margin"/>
              <span class="badge bg-light text-dark" v-if="basketStore.getProducts.length > 0">
                {{ getTotalQuantity(basketStore.getProducts) }}
              </span></router-link>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>

import { useBasketStore } from '../store/basket'
import { useUserStore } from '../store/user'
import { useRouter } from 'vue-router'

export default {
  props: ['currentPage'],
	setup() {
		const basketStore = useBasketStore()
		const userStore = 	useUserStore()	
    const router =      useRouter(); 

		return { basketStore, userStore , router}
  },    
    
  methods: {	
    getTotalQuantity(products) {
      let totalQuantity = 0;
      for (const product of products) {
        totalQuantity += product.quantity || 1;
      }
      return totalQuantity;
    },

    redirectToMyOrders() {
      const userId = this.userStore.getUser.id;
      this.router.push({ name: 'myorders', params: { userId } });
    },
  },
  computed: {
  },
}
</script>  

<style scoped>
.btn-sm-margin {
  margin-right: 40px;
}
</style>