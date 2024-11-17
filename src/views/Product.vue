<template>
  <div>
    <Header :currentPage="'menu'"/>

    <div v-if="product" class="product-details-container">
      <div class="product-image-container">
        <img :src="'./../images/' + product.image" alt="Product Image" class="product-image" />
      </div>
      <div class="product-details">
        <h1 class="product-name">{{ product.name }}</h1>
        <div class="hr"></div>
        <p class="product-description">{{ product.description }}</p>
        <p class="product-price">
          <span v-if="product.old_price !== null">
            <span style="text-decoration: line-through; color: red; font-weight: bold;">{{ product.old_price + " €"}}</span>
            <br />
          </span>
          {{ product.price + " €"}}
        </p>
        <button @click="addToBasket(product)" class="btn btn-outline-dark">Adicionar ao Carrinho</button>
      </div>
    </div>

    <Footer :currentPage="'products'" />
  </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import { useProductsStore } from '../store/products'
import { useBasketStore } from '../store/basket'
import { useUserStore } from '../store/user'
import { useRouter } from 'vue-router';


export default {
  components: {
    Header,
    Footer,
  },
  setup() {
    const productsStore = useProductsStore()
    const basketStore = useBasketStore()
    const userStore = useUserStore()
    const router = useRouter();

    const addToBasket = (product) => {
      basketStore.addToBasket(product);
    };

    const productId = router.currentRoute.value.params.id
    const product = productsStore.getProduct(productId);

    return {
      product,
      basketStore,
      userStore,
      addToBasket,
    };
  }
}
</script>

<style scoped>
.product-details-container {
  display: flex;
  border: 1px solid #ddd;
  border-radius: 8px;
  justify-content: space-around;
  padding: 20px;
}

.product-image-container {
  width: 30%;
}

.product-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.product-details {
  flex: 1;
  text-align: center;
  padding: 10px;
}

.product-name {
  font-size: 1.5rem;
  margin-bottom: 20px;
}

.product-description {
  margin-bottom: 10px;
}

.product-price {
  font-weight: bold;
  margin-bottom: 10px;
}

.btn {
  cursor: pointer;
}

.hr {
  border: 1px solid #ccc;
  margin-top: 10px;
}
</style>
