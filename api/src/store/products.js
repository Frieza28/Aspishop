import { defineStore } from 'pinia'
export const useProductsStore = defineStore({
  id: 'products',
  state: () => ( {
    products: [
    // {
    //"cat_id":"SUSHI",
    //"id":"1",
    //"name":"Salmon Roll",
    //"description":"Simply delicious!",
    //"price":"18",
    //"image":"04.jpg",
    //"visible": "1",
    //}
    ]
  }),
  getters: {
    getProducts (state) {
      return state.products;
    },
    getProduct: (state) => (id) => {
      let index = state.products.findIndex(p => p.id == id)
      return state.products[index]
    },    
  }, 
  actions: {
    addProducts(products){
      this.products = products
    },    
    async getProductsDB() {
			try {
				const response = await fetch('http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/products.php')
				const data = await response.json()
                this.addProducts(data)
                return true
			} 
			catch (error) {
                console.log('error: ', error)
                return false
			}
		},
  },
})
