<template>
	<div>
    <Header :currentPage="'home'"/>
    <Carrossel/>

    <section class="section-products">
      <div class="container">

        <div class="row justify-content-center text-center">
          <div class="col-md-8 col-lg-6">
              <div class="header">
                <h2>Produtos Populares</h2>
                <h3>CONSELHOS DOS NOSSOS EXPERTS</h3>
              </div>
          </div>
        </div>

        <div class="row">
          <div v-for="product in products" :key="product.id" class="col-md-6 col-lg-4 col-xl-3">
            <div id="product-1" class="single-product" @mouseover="applyHoverEffect" @mouseleave="removeHoverEffect">
              <div class="part-1" :style="{ 'background-image': 'url(./images/' + product.image + ')' }" style="background-size: 300px;"></div>
              <div class="part-2">
                <h3 class="product-title">{{ product.name }}</h3>
                <h4 class="product-old-price" v-if="product.old_price !== null">{{ product.old_price + " €" }}</h4>
                <h4 class="product-price">{{ product.price + " €" }}</h4>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

  <Footer :currentPage="'home'" />
	</div>
</template>

<script>
import Header from '@/components/Header.vue'
import Carrossel from '@/components/Carrossel.vue'
import Footer from '@/components/Footer.vue'

import { useProductsStore } from '../store/products'
import { useBasketStore } from '../store/basket'
import { useUserStore } from '../store/user'

export default {
  components: {
    Header,
    Carrossel,
    Footer,
  },
  setup() {
    const productsStore = useProductsStore()
    const basketStore = useBasketStore()
    const userStore = useUserStore()

    return {productsStore,
      basketStore,
      userStore,};
  },

  data() {
    return {
      products: [],
    };
  },
  mounted() {
    this.loadProducts();
  },
  methods: {
    async loadProducts() {
      try {
        await this.productsStore.getProductsDB();
        this.products = this.productsStore.getProducts;
      } catch (error) {
        console.error('Erro ao carregar os produtos:', error);
      }
    },

    applyHoverEffect(event) {
      const productElement = event.currentTarget
      if (productElement) {
        productElement.style.transform = 'scale(1.2) rotate(5deg)'
      }
    },

    removeHoverEffect(event) {
      const productElement = event.currentTarget
      if (productElement) {
        productElement.style.transform = 'none'
      }
    },
  },
};
</script>

<style scoped>
.section-products {
    padding: 80px 0 54px;
}

.section-products .header {
    margin-bottom: 50px;
}
.section-products .header h2 {
    font-size: 2.2rem;
    font-weight: 400;
    color: #444444; 
}

.section-products .header h3 {
    font-size: 1rem;
    color: #fe302f;
    font-weight: 500;
}

.section-products .single-product {
    margin-bottom: 26px;
}

.section-products .single-product .part-1 {
  position: relative;
  height: 290px;
  max-height: 290px;
  margin-bottom: 20px;
}

.section-products .single-product .part-2 .product-title {
    font-size: 1rem;
}

.section-products .single-product .part-2 h4 {
    display: inline-block;
    font-size: 1rem;
}

.section-products .single-product .part-2 .product-old-price {
    position: relative;
    padding: 0 7px;
    margin-right: 2px;
    color: red;
}

.section-products .single-product .part-2 .product-old-price::after {
    position: absolute;
    content: "";
    top: 50%;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: red;
    transform: translateY(-50%);
}
</style>
