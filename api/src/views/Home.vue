<template>
	<div>
    <Header/>
    <Carrossel/>
		<router-link to="/menu" class="button">Enter on the website</router-link>
    <Footer/>
	</div>
</template>

<script>
import Header from '@/components/Header.vue'
import Carrossel from '@/components/Carrossel.vue'
import Footer from '@/components/Footer.vue'

export default {
  components: {
    Header,
    Carrossel,
    Footer,
  },
  setup() {
    return {};
  },
};
</script>

<style scoped>
.button {
  /* Add any additional styles for your button */
}
</style>
