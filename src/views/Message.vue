<template>
	<Header :currentPage="'menu'" />

  <div class="logout">
    <div class="alert alert-success custom-alert" role="alert">
      <h4 class="alert-heading custom-heading">{{ message }}</h4>
      <hr class="custom-separator">
      <p class="mb-0 custom-paragraph">Vais ser redirecionado para a nossa página principal :D</p>
    </div>
  </div>

	<Footer :currentPage="'message'"/>
</template>

<script>

import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import { useUserStore } from '../store/user'

export default {	

	setup() {
		const userStore = useUserStore()
		return { userStore }
  },	
	components: {
    Header,
		Footer,
	},
	data() {
		return {
			message: ''
		}
	},
	mounted() {
		this.setMessage()
	},
	methods: {
		setMessage() {	
			if (this.$route.params.id == 1) {
				this.message = "Obrigado por criar uma conta! Agora podes fazer login"
			} 
			if (this.$route.params.id == 2) {
				this.message = "Bem-vindo " + this.userStore.getUser.name + "!"
			}
			if (this.$route.params.id == 3) {
				const userName = this.$route.query.username;
				this.message = `Adeus ${userName}, até uma próxima!`;
			}
			if (this.$route.params.id == 4) {
				this.message = "Transação Processada, muito obrigado por comprares na AspiShop!"
			}			
																			
			var timeleft = 2;
			var downloadTimer = setInterval(() => {
				if(timeleft <= 0){
					clearInterval(downloadTimer)
					this.$router.push('/')
				}
			timeleft -= 1
			}, 1000)
		},
	},
}
</script>

<style scoped>
.custom-alert {
  height: 235px;
  margin-top: 90px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}

.custom-heading {
  font-size: 40px;
  font-weight: bold;
}

.custom-separator {
  width: 50%;
  margin: 10px 0;
}

.custom-paragraph {
  font-size: 24px;
}

@media (max-width: 990px) {
	.custom-heading {
		font-size: 25px;
		font-weight: bold;
	}

	.custom-paragraph {
		font-size: 15px;
	}
}
</style>



