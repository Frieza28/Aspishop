<template>
  <div>
    <Header :currentPage="'home'"/>

    <div class="row justify-content-center text-center">
      <div class="col-md-8 col-lg-6">
          <div class="header">
            <h2>MyOrders</h2>
          </div>
      </div>
    </div>
    
    <div class="dropdown-container">
      <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ordenar por
      </button>
      <div class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" @click="sortBy('total')">Preço mais baixo</a>
        <a class="dropdown-item" @click="sortBy('totalDesc')">Preço mais alto</a>
        <a class="dropdown-item" @click="sortBy('createdAt')">Data Ascendente</a>
        <a class="dropdown-item" @click="sortBy('createdAtDesc')">Data Decrescente</a>
      </div>
    </div>

    <div v-for="order in orders" :key="order.id" class="order-card">
      <div class="order-details">
        <p><strong>Order ID:</strong> {{ order.id }}</p>
        <p><strong>Created_At:</strong> {{ order.created_at }}</p>
        <p><strong>Status:</strong> {{ order.status_id }}</p>
        <p><strong>Total:</strong> {{ order.total }}</p>

        <ul class="order-items">
          <li v-for="item in order.items" :key="item.product_id">
            <strong>Produto:</strong> {{ item.name }}<br>
            <strong>Quantidade:</strong> {{ item.quantity }}<br>
            <strong>Preço:</strong> {{ item.price }}<br><br>
          </li>
        </ul>
      </div>
    </div>

    <Footer :currentPage="'orders'" />
  </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import { useProductsStore } from '../store/products'
import { useBasketStore } from '../store/basket'
import { useOrdersStore } from '../store/orders'
import { useUserStore } from '../store/user'

export default {
  components: {
    Header,
    Footer,
  },
  setup() {
    const productsStore = useProductsStore()
    const basketStore = useBasketStore()
    const userStore = useUserStore()
    const ordersStore = useOrdersStore()

    const sortOptions = {
      total: (a, b) => a.total - b.total,
      totalDesc: (a, b) => b.total - a.total,
      createdAt: (a, b) => new Date(a.created_at) - new Date(b.created_at),
      createdAtDesc: (a, b) => new Date(b.created_at) - new Date(a.created_at),
    };

    let sortOption = 'name';

    const sortBy = (option) => {
      sortOption = option;
      ordersStore.sortOrders(sortOptions[option]);
    };

    return {
      productsStore,
      basketStore,
      userStore,
      ordersStore,
      sortOption,
      sortBy,
    };
  },
  data() {
    return {
      orders: [],
    };
  },
  mounted() {
    this.loadOrders();
  },

  methods: {
    async loadOrders() {
      try {
        const userID = this.$route.params.userId;
        await this.ordersStore.getMyOrdersDB(userID);
        this.orders = this.ordersStore.getOrders;
      } catch (error) {
        console.error('Erro ao carregar as orders:', error);
      }
    },
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

.btn {
  cursor: pointer;
}

.order-card {
  border: 1px solid #ddd;
  border-radius: 8px;
  margin-bottom: 20px;
  padding: 10px;
}

.order-details {
  margin-bottom: 10px;
}

.order-items {
  list-style-type: none;
  padding: 0;
}

.order-items li {
  margin-bottom: 10px;
}

.header h2 {
  margin-bottom: 50px;
  font-size: 2.2rem;
  text-decoration: underline;
  font-weight: 600;
  color: #444;
  margin-top: 50px;    
  color: #000;
}

</style>
