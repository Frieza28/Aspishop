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
import { useProductsStore } from '@/store/products'
import { useUserStore } from '@/store/user'

export default {
	setup() {
		const basketStore = useBasketStore()
		const productsStore = useProductsStore()
		const userStore = 	useUserStore()	
		return { basketStore, productsStore, userStore }
  	},
    components: {
		Footer,
        Header
	},
	data() {
		return {
		products: [],
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