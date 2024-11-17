<template>
  <div>
    <Header :currentPage="'menu'"/>

     <div class="dropdown-container">
      <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ordenar por
      </button>
      <div class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" @click="sortBy('price')">Preço mais baixo</a>
        <a class="dropdown-item" @click="sortBy('priceDesc')">Preço mais alto</a>
        <a class="dropdown-item" @click="sortBy('name')">Ordem alfabética</a>
      </div>
    </div>

    <div class="product-container">
      <div v-for="product in products" :key="product.id" class="product-card">
        <div class="product-image-container">
          <img :src="'./../images/' + product.image" alt="Product Image" class="product-image" />
        </div>
        <div class="product-details">
          <h2 class="product-name" style="color: black; margin-top: 15px;">{{ product.name }}</h2>
          <p class="product-description">{{ product.description }}</p>
          <p class="product-price">
						<span v-if="product.old_price !== null">
							<span style="text-decoration: line-through; color: red; font-weight: bold;">{{ product.old_price + " €"}}</span>
							<br />
						</span>
					{{ product.price + " €"}}</p>
          <button @click="addToBasket(product)" class="btn btn-outline-dark" style="margin: 10px;">Adicionar ao Carrinho</button>

          <router-link :to="{ name: 'product', params: { id: product.id } }">
            <button class="btn btn-outline-dark">Ver Produto</button>
          </router-link>
        </div>
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
import { watch } from 'vue'

export default {
  components: {
    Header,
    Footer,
  },
  setup() {
    const productsStore = useProductsStore()
    const basketStore = useBasketStore()
    const userStore = useUserStore()

    const addToBasket = (product) => {
      basketStore.addToBasket(product);
    };

    const sortOptions = {
      price: (a, b) => a.price - b.price,
      priceDesc: (a, b) => b.price - a.price,
      name: (a, b) => a.name.localeCompare(b.name),
    };

    let sortOption = 'name';

    const sortBy = (option) => {
      sortOption = option;
      productsStore.sortProducts(sortOptions[option]);
    };

    return {
      productsStore,
      basketStore,
      userStore,
      addToBasket,
      sortOption,
      sortBy,
    };
  },
  data() {
    return {
      products: [],
    };
  },
  mounted() {
    const categoryId = this.$router.currentRoute.value.params.id
    this.loadProducts_2(categoryId);
    watch(() => this.$router.currentRoute.value.params.id, (newId, oldId) => {
        const categoryId_2 = this.$router.currentRoute.value.params.id
        this.loadProducts_2(categoryId_2);
      });
  },

  methods: {
    async loadProducts_2(categoryId) {
      if (categoryId === '1') {
        await this.loadProductsByCategory(1)
      } else if (categoryId === '2') {
        await this.loadProductsByCategory(2)
      } else if (categoryId === '3') {
        await this.loadProductsByOldPrice(3)
      } else {
        await this.loadProducts()
      }
    },
    async loadProducts() {
      try {
        await this.productsStore.getProductsDB();
        this.products = this.productsStore.getProducts;
      } catch (error) {
        console.error('Erro ao carregar os produtos:', error);
      }
    },
    async loadProductsByCategory(categoryId) {
      try {
        const products = await this.productsStore.getProductsByCat(categoryId);
        this.products = products;
      } catch (error) {
        console.error('Erro ao carregar produtos por categoria:', error);
      }
    },
    async loadProductsByOldPrice(categoryId) {
      try {
        const products = await this.productsStore.getProductsByOldPrice(categoryId);
        this.products = products;
      } catch (error) {
        console.error('Erro ao carregar produtos por categoria:', error);
      }
    }
  },
};
</script>


<style scoped>
.dropdown-container {
    position: flex;
    margin: 10px;
    margin-left: 1360px;
}

.dropdown-menu {
    position: absolute;
    left: 100%
}

.product-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  padding: 20px;
}

.product-card {
  width: 100%; 
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  display: flex;
  align-items: center;
}

.product-image-container {
  width: 30%;
}

.product-image {
  width: 50%;
	margin-left: 80px;
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
  margin-bottom: 10px;
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

@media (max-width: 990px) {
  .product-image {
    width: 100%;
    margin-left: 20px;
    height: auto;
    border-radius: 8px;
  }

  .dropdown-container {
    position: flex;
    margin: 10px;
    margin-left: 340px;
  }
}
</style>
