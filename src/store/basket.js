 
  import { defineStore } from 'pinia'
  export const useBasketStore = defineStore({
  id: 'basket',
  state: () => ( {
    products: [
    //  {
    //    id: 1,
    //    quantity: 5
    //  },
    //  {
    //   id: 2,        
    //    quantity: 2
    //  },
    //  {
    //    id: 3,        
    //    quantity: 3
    //  }
    ]
  }),
  getters: {
    getProducts (state) {
      return state.products;
    },   
  }, 
  actions: {
    addToBasket(product) {
      const existingProduct = this.products.find((p) => p.id === product.id);

      if (existingProduct) {
        existingProduct.quantity += 1;
      } else {
        this.products.push({ id: product.id, quantity: 1 });
      }
    },
    clearBasket () {
        this.products = []
    },
    removeProduct(productId) {
      const productIndex = this.products.findIndex((p) => p.id === productId);

      if (productIndex !== -1) {
        this.products.splice(productIndex, 1);
      } else {
        console.error(`Product with ID ${productId} not found in the basket.`);
      }
    },
    incrementProduct(idToIncrement) {
      const product = this.products.find((p) => p.id === idToIncrement);

      if (product) {
        product.quantity += 1;
      }
    },
    decrementProduct(idToDecrement) {
      const productIndex = this.products.findIndex((p) => p.id === idToDecrement);

      if (productIndex !== -1) {
        const product = this.products[productIndex];

        if (product.quantity > 1) {
          product.quantity -= 1;
        } else {
          this.products.splice(productIndex, 1);
        }
      }
    },
	},

})
