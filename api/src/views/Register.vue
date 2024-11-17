<template>
<div>


  
<Header />






<Footer />

</div>
</template>
<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import { useUserStore } from '@/store/user'

export default {
	
	setup() {
		const userStore = useUserStore()
		return { userStore }
  	},

	components: {
		Footer,
        Header
	},
	data() {
      return {	
        user: {
			name: '',
			email: '',
			password: '',
        },
		passwordConfirmation: '',
		submitting: true,
		error: true,	
      }
    },
	
	methods: {

	},
	
	computed: {

	},
	directives: {

	},
	created: function () {


	}
}
</script>