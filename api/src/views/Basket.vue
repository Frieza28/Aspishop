<template>
<div>


  
<Header />








<Footer />

</div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import { useBasketStore } from '@/store/basket'
import { useOrdersStore } from '@/store/orders'

export default {
	setup() {
		const basketStore = useBasketStore()
		const ordersStore = useOrdersStore()		
		return { basketStore, ordersStore }
  	},
    components: {
		Footer,
        Header
	},
	data() {
		return {
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