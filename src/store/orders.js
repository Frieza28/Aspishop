import { defineStore } from 'pinia'
import { useUserStore } from './user'

export const useOrdersStore = defineStore({
  id: 'orders',
  state: () => ( {
    orders: 
    [
    //{
    //"id":"11",
    //"customer_id":"20",
    //"created_at":"2021-12-03 18:20:31",
    //"status_id":"1",
    //"total":"190",
    //"order_items":[{"product_id":"2","name":"Salmon Roll","price":"18","quantity":"4"},{"product_id":"3","quantity":"3"},{"product_id":"4","quantity":"2"}]
    //}
    ]
  }),
  getters: {
    getOrders (state) {
      return state.orders
    },   
  }, 
  actions: {
    addOrders(orders){
      this.orders = orders
    },
    addOrder(order){
      this.orders = [...this.orders, order]
    },
    sortOrders(sortFunction) {
      this.orders.sort(sortFunction);
    },
    async getMyOrdersDB(userID) {
			try {
				const response = await fetch(`http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/orders.php?user_id=${userID}`)
				const data = await response.json()
        this.addOrders(data)
        return true;
			} 
			catch (error) {
        console.log('error: ', error)
        return false;
			}
		},
    async addOrderDB(order) {
			try {
        const userStore = useUserStore()
				const response = await fetch(`http://daw.deei.fct.ualg.pt/~a71483/LAB11/api/orders.php?session_id=${userStore.getUser.session_id}`, {
					method: 'POST',
					body: JSON.stringify(order),
					headers: { 'Content-type': 'application/json; charset=UTF-8' },
				})
				const data = await response.json()
          this.addOrder(data)
          return true
			} 
			catch (error) {
				console.error(error)
        return false
			}
		},
  },
})
