<template>
	<div>
    <Header :currentPage="'home'"/>

		<div class="CartContainer">
			<div class="Header">
			<h3 class="Heading">Carrinho de Compras</h3>
			<h5 class="Action" @click="removeAllProducts">Apagar tudo</h5>
   	</div>

		<div v-for="product in basketProducts" :key="product.id" class="Cart-Items">
			<div class="image-box">
				<img :src="'./images/' + product.image" alt="Product Image" class="product-image"/>
			</div>
			<div class="about">
				<h1 class="title">{{ product.name }}</h1>
			</div>
			<div class="counter">
				<div class="btn" @click="incrementProduct(product.id)">+</div>
				<div class="count">{{ product.quantity }}</div>
				<div class="btn" @click="decrementProduct(product.id)">-</div>
			</div>
			<div class="prices">
				<div class="amount">{{ product.price + " €"}}</div>
				<div class="remove" @click="removeProduct(product.id)">Remover</div>
			</div>
		</div>

		<div class="checkout">
			<div class="total">
				<div>
					<div class="Subtotal">Sub-Total</div>
					<div class="items">{{ basketItemCount }} items</div>
					<br>
					<div v-if="basketTotalAmountWithShipping !== basketTotalAmount || basketTotalAmountFinal.replace(' €', '') < 500.00" class="items">
						Portes: 5.99 € <br>
					</div>
					<div v-if="basketTotalAmountWithPROMO !== basketTotalAmount" class="items">
						Campanha Natal<br><br>ao Máximo: {{ discountAmount }} €
					</div>
				</div>
				<div class="total-amount">{{ basketTotalAmountFinal }}</div>
			</div>
			<li v-if="userStore.isAuthenticated" style="list-style: none;">
					<button class="button" @click="placeOrder">Encomendar</button>
			</li>
			<li v-if="userStore.isAuthenticated == false" style="list-style: none;">
				<router-link to="/login" class="button-link">
					<button class="button">Tens de fazer Login primeiro :/</button>
				</router-link>
			</li>
		</div>
	</div>

	<Footer :current-page="'basket'"/>
	</div>
</template>

<script>
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import { useBasketStore } from '../store/basket';
import { useOrdersStore } from '../store/orders';
import { useProductsStore } from '../store/products';
import { useUserStore } from '../store/user'


export default {
  setup() {
  const basketStore = useBasketStore();
  const ordersStore = useOrdersStore();
  const productsStore = useProductsStore();
	const userStore = 	useUserStore()	

  productsStore.getProductsDB();

  return { basketStore, ordersStore, productsStore, userStore};
},

  components: {
    Footer,
    Header,
  },

  mounted() {
  },

	methods: {
    removeAllProducts() {
      this.basketStore.clearBasket();
    },
		removeProduct(productId) {
      this.basketStore.removeProduct(productId);
    },
		incrementProduct(productId) {
      this.basketStore.incrementProduct(productId);
    },
    decrementProduct(productId) {
      this.basketStore.decrementProduct(productId);
    },
		async placeOrder() {
      const itemsInBasket = this.basketStore.getProducts;
      const order = {
        user_id: this.userStore.getUser.id,
        totalAmount: this.basketTotalAmountFinal.replace(' €', ''),
        status_id: 1,
        items: itemsInBasket.map((item) => ({
          id: item.id,
          quantity: item.quantity,
        })),
      };

      try {
        const success = await this.ordersStore.addOrderDB(order);
        if (success) {
          this.basketStore.clearBasket();
					this.$router.push({ name: 'message', params: { id: 4 } });
        } else {
          console.error('Falha ao adicionar ordem.');
        }
      } catch (error) {
        console.error('Erro:', error);
      }
    },
  },
  computed: {
    basketProducts() {
			return this.basketStore.getProducts.map((basketItem) => {
				const productDetails = this.productsStore.getProducts.find((product) => product.id === basketItem.id);

				if (!productDetails) {
					return null;
				}

				return {
					...basketItem,
					...productDetails,
				};
			}).filter(Boolean);
		},

		basketItemCount() {
      return this.basketProducts.reduce((total, product) => total + product.quantity, 0);
    },
    
    basketTotalAmount() {
      const totalAmount = this.basketProducts.reduce((total, product) => total + product.price * product.quantity, 0);
      
			return (totalAmount).toFixed(2) + " €";
    },

		basketTotalAmountWithShipping() {
      const totalAmount = this.basketProducts.reduce((total, product) => total + product.price * product.quantity, 0);
			const shippingCost = totalAmount < 500 && totalAmount != 0 ? 5.99 : 0;
			return (totalAmount + shippingCost).toFixed(2) + " €";
    },

		basketTotalAmountWithPROMO() {
			const totalAmount = this.basketProducts.reduce((total, product) => total + product.price * product.quantity, 0);
			
			let promo = 0;

			if (totalAmount >= 2500) {
				promo = 500;
			} else if (totalAmount >= 2000) {
				promo = 400;
			} else if (totalAmount >= 1500) {
				promo = 300;
			} else if (totalAmount >= 1000) {
				promo = 200;
			} else if (totalAmount >= 500) {
				promo = 100;
			}
			return (totalAmount - promo).toFixed(2) + " €";
		},

		discountAmount() {
      const totalAmount = this.basketProducts.reduce((total, product) => total + product.price * product.quantity, 0);
      let promo = 0;

      if (totalAmount >= 2500) {
        promo = 500;
      } else if (totalAmount >= 2000) {
        promo = 400;
      } else if (totalAmount >= 1500) {
        promo = 300;
      } else if (totalAmount >= 1000) {
        promo = 200;
      } else if (totalAmount >= 500) {
        promo = 100;
      }
      return promo.toFixed(2);
    },

		basketTotalAmountFinal() {
			const totalAmountWithPromo = parseFloat(this.basketTotalAmount.replace(' €', '')) - this.discountAmount;
			const shippingCost = totalAmountWithPromo < 500 && totalAmountWithPromo != 0 ? 5.99 : 0;

			return (parseFloat(totalAmountWithPromo) + shippingCost).toFixed(2) + " €";
		},

  },
};
</script>


<style scoped>

.CartContainer{
	width: 70%;
	height: 90%;
	margin: 20px;
	background-color: #ffffff;
	border-radius: 20px;
	box-shadow: 0px 10px 20px #1687d933;
}

.Header{
	margin: auto;
	width: 90%;
	height: 15%;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.Heading{
	font-size: 20px;
	margin-top: 20px;
	font-weight: 700;
	color: #2F3841;
}

.Action{
	font-size: 14px;
	margin-top: 20px;
	font-weight: 600;
	color: #E44C4C;
	cursor: pointer;
	border-bottom: 1px solid #E44C4C;
}

.Cart-Items{
	margin: auto;
	width: 90%;
	height: 30%;
	display: flex;
	justify-content: space-between;
	align-items: center;
}
.image-box {
  width: 15%;
  height: 100%;
  text-align: center;
}

.about {
  height: 100%;
  width: 70%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.title {
  padding-top: 10px;
  line-height: 10px;
  font-size: 24px;
  font-weight: 600;
  color: #202020;
}

.counter{
	width: 15%;
	display: flex;
	margin-right: 20px;
	justify-content: space-between;
	align-items: center;
}
.btn{
	width: 40px;
	height: 40px;
	border-radius: 50%;
	background-color: #d9d9d9;
	display: flex;
	justify-content: center;
	align-items: center;
	font-size: 20px;
	font-weight: 900;
	color: #202020;
	cursor: pointer;
}
.count{
	font-size: 20px;
	font-family: 'Open Sans';
	font-weight: 600;
	color: #202020;
}

.prices{
	height: 100%;
	width: 120px;
	text-align: right;
}
.amount{
	padding-top: 20px;
	font-size: 26px;
	font-family: 'Open Sans';
	font-weight: 800;
	color: #202020;
}

.remove{
	padding-top: 5px;
	font-size: 14px;
	font-weight: 600;
	color: #E44C4C;
	cursor: pointer;
	text-decoration: underline;
}

.checkout {
	position: absolute;
	left: 75%;
	bottom: 50%;
	width: 25%;
}

.total {
	width: 80%;
	display: flex;
	justify-content: space-between
}
.Subtotal{
	font-size: 22px;
	font-family: 'Open Sans';
	font-weight: 700;
	color: #202020;
}
.items{
	font-size: 16px;
	font-family: 'Open Sans';
	font-weight: 500;
	color: #909090;
	line-height: 10px;
}
.total-amount{
	font-size: 36px;
	font-family: 'Open Sans';
	font-weight: 900;
	color: #202020;
}
.button{
	margin-top: 10px;
	width: 70%;
	margin-right: 90px;
	height: 40px;
	border: none;
	background: linear-gradient(to bottom right, #B8D7FF, #8EB7EB);
	border-radius: 20px;
	cursor: pointer;
	font-size: 16px;
	font-weight: 600;
	color: #202020;
}

.button-link {
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
}

.product-image {
  max-width: 100%;
  max-height: 100%;
}

li a {
  text-decoration: none;
}

@media (max-width: 990px) {
	.checkout {
		position:relative;
		left: 5px;
		top: 80%;
		width: 120%;
	}

	.CartContainer{
		width: 90%;
		height: 90%;
		margin: 20px;
		background-color: #ffffff;
		border-radius: 20px;
		box-shadow: 0px 10px 20px #1687d933;
	}	

	.title {
		padding-top: 10px;
		line-height: 10px;
		font-size: 16px;
		font-weight: 600;
		color: #202020;
	}

	.amount{
		padding-top: 20px;
		font-size: 16px;
		font-family: 'Open Sans';
		font-weight: 800;
		color: #202020;
	}
}
</style>