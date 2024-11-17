<template>
  <div>
      <Header :currentPage="'home'" />
      <div class="form-container-logout">
        <div class="error-box">
            <h2 class="error-message">Tens a certeza que queres ir embora?? :(</h2>
        </div>

        <p style="text-align: center;">
          <button @click="cancel()" class="btn btn-outline-light">Cancel</button>
          &nbsp;&nbsp;
          <button @click="logoutUser()" class="btn btn-outline-light">Logout</button>
        </p>
      </div>
      <Footer :currentPage="'logout'" />
  </div>
</template>


<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'
import { useUserStore } from '../store/user';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const userStore = useUserStore();
    const router = useRouter();

    return { userStore, router };
  },
  components: {
    Header,
		Footer,
	},
  data() {
    return {
      user: {},
    }
  },
  methods: {
    async logoutUser() {
      try {
        const session_id = this.userStore.getUser.session_id;

        const userName = this.userStore.getUser.name;
        const logout = await this.userStore.logoutUserDB(session_id);

        if (logout) {
            this.$router.push({ name: 'message', params: { id: 3 }, query: { username: userName } });
        } else {
          console.error('Logout failed!', error.message);
        }
      } catch (error) {
        console.error('Logout failed:', error.message);
        this.$router.push('/');
      }
    },
    cancel() {
      this.$router.push('/')
    },
  },
}
</script>

<style scoped>
.error-box {
  margin: 50px 200px 50px;
  border: 2px solid red;
  background-color: #ffe6e6;
  padding: 10px
}

.error-message {
  top: 20px;
  color: darkred;
  margin: 0;
}

@media (max-width: 990px) {
  .error-box {
    margin:150px 50px 2px;
    border: 2px solid red;
    background-color: #ffe6e6;
    padding: 10px;
    margin-bottom: 10px;
  }
}

@media (max-width: 828px) {
  .error-message {
    top: 70px;
    color: darkred;
    margin: 0;
  }
}

@media (max-width: 790px) {
  .error-message {
    top: 50px;
    color: darkred;
    margin: 0;
  }
}
</style>