<template>
<div>


  
<Header />








<Footer />

</div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import { useOrdersStore } from '@/store/orders'

export default {
	setup() {
		const ordersStore = useOrdersStore()	
		return { ordersStore }
  	},    
    components: {
		Footer,
        Header
	},
	data() {
		return {
            isHidden: false,
            id: 0,
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
		}
	},
	mounted() {

	},
	methods: {
	
	},
    computed: {

    },
}
</script>

<style scoped>
</style>