<template>
  <div v-if="currentPage === 'home'">
    <div class="sticky-footer">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'login'">
    <div class="footer-login">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'register'">
    <div class="footer">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'logout'">
    <div class="footer-logout">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'message'">
    <div class="footer-message">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'products'">
    <div class="footer-products">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'basket'">
    <div class="footer-basket">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

  <div v-if="currentPage === 'orders'">
    <div class="footer-orders">
      <div class="footer-content">
        © 2023, AspiShop - Aspiradores, S.A.
        <p>Realizado por Ricardo Frieza (a71483)</p>
      </div>
    </div>
  </div>

</template>

<script>
import { useUserStore } from '@/store/user';

export default {
  props: ['currentPage'],
  setup() {
    const userStore = useUserStore();

    return {
      userStore
    };
  }
}
</script>