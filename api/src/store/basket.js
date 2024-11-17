 
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
    clearBasket () {
        this.products = []
    },
    incrementProduct (idToIncrement) {
        // check if item exists in basket


        // item does not exist; create item

        // increment item

      },    
      decrementProduct (idToDecrement) {

          // remove item if quantity is 0
      }

	},

})
