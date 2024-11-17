<template>
	<div>
    <Header :currentPage="'home'"/>

		<div class="form-container">
			<form @submit.prevent="loginUser" class="centered-form-login">
				<div class="formContainer">
					<h2>Login Form</h2>
					<label for="email" class="field-label"><b>Email</b></label>
					<input v-model="user.email" type="text" placeholder="Enter Email" name="email" id="email" required class="field-input">

					<label for="password" class="field-label"><b>Password</b></label>
					<input v-model="user.password" type="password" placeholder="Enter Password" name="password" id="password" required class="field-input">

					<p><router-link to="/register" style="color: white"> Ainda não criaste uma conta?</router-link></p>

					<p>
						<button type="button" @click="clearFields" class="btn btn-outline-light" style="margin-right: 8px;">Cancel</button>
						<button type="submit" class="btn btn-outline-light" :disabled="submitting">Sign In</button>
					</p>
				</div>
			</form>
		</div>

		<Footer :currentPage="'login'" />
	</div>
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
		Footer,
    Header,
	},   
	data() {
      return {	
        user: {
					email: '',
					password: '',
        },
			submitting: false,
      error: false,
      }
  },
	
	methods: {
		async loginUser() {
      this.submitting = true;
      this.error = false;

      try {
        const loginSuccess = await this.userStore.loginUserDB(this.user);

        if (loginSuccess) {
          this.$router.push({ name: 'message', params: { id: 2 } });
        } else {
          this.error = true;
          this.errorMessage = 'Login failed. Check your credentials.';
          this.submitting = false;
        }
      } catch (error) {
        this.error = true;
        this.errorMessage = 'An error occurred during login';
        this.submitting = false;
      }
    },
    clearFields() {
      this.user.email = "";
      this.user.password = "";
    },
	},
	
	computed: {
	},
	directives: {
	},
	created: function () {
	}
}
</script>