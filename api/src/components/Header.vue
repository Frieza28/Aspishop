<template>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark navbar-top">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand">
          <div class="brand-container">
            <img src="../assets/images/robot.png" alt="" width="330" class="navbar-logo">
            <h1 class="brand-title">AspiShop</h1>
          </div>
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto text-right">
              <a class="nav-link disabled">Welcome User</a>
              <router-link to="/" class="button" style="margin-right: 10px;">Home</router-link>
              <router-link to="/login" class="button" style="margin-right: 10px;">Login</router-link>
              <router-link to="/register" class="button" style="margin-right: 10px;">Register</router-link>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Navbar Secundária -->
    <nav class="navbar navbar-expand-lg navbar-bottom">
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav-2" style="margin-left: 85px;">
              <router-link to="/" class="button" style="margin-right: 30px;">Home</router-link>
              <router-link to="/menu" class="button" style="margin-right: 30px;">Products</router-link>
              <router-link to="/menu" class="button" style="margin-right: 30px;">Promo</router-link>
              <router-link to="/menu" class="button" style="margin-right: 30px;">IRobot</router-link>
              <router-link to="/menu" class="button" style="margin-right: 30px;">Rowenta</router-link>
          </ul>
      </div>
    </nav>
</template>

<script>

import { useBasketStore } from '@/store/basket'
import { useUserStore } from '@/store/user'

export default {
	setup() {
		const basketStore = useBasketStore()
		const userStore = 	useUserStore()	
		return { basketStore, userStore }
  	},    
    methods: {	

    },
    computed: {
        
    },
}

</script>  
