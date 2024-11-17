<template>
	<div>
  <Header :currentPage="'home'"/>

	<div class="form-container">
    <form @submit.prevent="registerUser" class="centered-form">
      <div class="formContainer">
        <p>
          <h2>Sign Up Form</h2>
        </p>
        <div v-if="error" class="error-box">
          <h5 class="error-message">{{ errorMessage }}</h5>
        </div>

        <label for="name" class="field-label"><b>Name</b></label>
        <input v-model="user.name" type="text" placeholder="Enter Name" name="name" id="name" required class="field-input">

        <label for="email" class="field-label"><b>Email</b></label>
        <input v-model="user.email" type="text" placeholder="Enter Email" name="email" id="email" required class="field-input">

        <label for="password" class="field-label"><b>Password</b></label>
        <input v-model="user.password" type="password" placeholder="Enter Password" name="password" id="password" required class="field-input">

        <label for="repeatPassword" class="field-label"><b>Repeat Password</b></label>
        <input v-model="passwordConfirmation" type="password" placeholder="Repeat Password" name="repeatPassword" id="repeatPassword" required class="field-input">

        <p><router-link to="/login" style="color:white"> Já tens uma conta? </router-link></p>

        <div>
          <button type="button" @click="clearFields" class="btn btn-outline-light" style="margin-right: 8px;">Clear All</button>

          <button type="submit" class="btn btn-outline-light">Sign Up</button>
        </div>
      </div>
    </form>
  </div>

	<Footer :currentPage="'register'" />
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
					name: '',
					email: '',
					password: '',
        },
		passwordConfirmation: '',
		submitting: false,
		error: false,	
		errorMessage: '',
    }
  },
	
	methods: {
      async registerUser() {
      this.submitting = true;
      this.error = false;

      if (!this.isValidEmailFormat(this.user.email)) {
        this.error = true;
        this.errorMessage = 'Invalid email format';
        this.submitting = false;
        return;
      }

      if (this.user.password !== this.passwordConfirmation) {
        this.error = true;
        this.errorMessage = 'Passwords do not match';
        this.submitting = false;
        return;
      }

      try {
        const userExists = await this.userStore.userExistsDB(this.user);
        if (!userExists) {
          const registrationSuccess = await this.userStore.registerUserDB(this.user);

          if (registrationSuccess) {
            this.$router.push({ name: 'message', params: { id: 1 } });
          } else {
            this.error = true;
            this.errorMessage = 'Registration failed';
            this.submitting = false;
          }
        } else {
          this.error = true;
          this.errorMessage = 'User already exists';
          this.submitting = false;
        }
      } catch (error) {
        this.error = true;
        this.errorMessage = 'An error occurred during registration';
        this.submitting = false;
      }
    },
    clearFields() {
      this.user.name = "";
      this.user.email = "";
      this.user.password = "";
      this.passwordConfirmation = "";
    },
    isValidEmailFormat(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  },
	
	computed: {
	},
	directives: {
	},
}
</script>

<style scoped>
.error-box {
  border: 2px solid red;
  background-color: #ffe6e6;
  padding: 10px;
  margin-bottom: 10px;
}

.error-message {
  color: darkred;
  margin: 0;
}
</style>