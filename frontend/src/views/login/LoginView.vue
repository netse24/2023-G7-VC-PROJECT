<template>
  <section>
    <v-app :style="{ backgroundImage: `url(${image})` }" class="bg-no-repeat h-screen">
      <v-alert type="success" title="Success " v-if="loginSuccess" class="w-50 m-auto"></v-alert>
      <v-main class="d-flex justify-center align-center">
        <v-col cols="10" lg="4" class="mx-auto">
          <h1 class="pa-5 text-3xl text-center bold font-bold">Welcome to <br> School Management System</h1>
          <v-card class="pa-4" :style="{ backgroundImage: `url(${imageForm})` }">
            <div class="text-center">
              <v-avatar size="100" color="indigo lighten-4">
                <v-icon size="40" color="#fff">mdi-account</v-icon>
              </v-avatar>
              <h1 class="text-[20px] bold text-bold">LOGIN</h1>
            </div>
            <v-form @submit.prevent="login" ref="form">
              <v-card-text>
                <v-text-field v-model="email" :rules="emailRules" type="email" label="Email" placeholder="Email"
                  prepend-inner-icon="mdi-account" required />
                <v-text-field v-model="password" :rules="passwordRules" :type="passwordShow ? 'text' : 'password'"
                  label="Password" placeholder="Password" prepend-inner-icon="mdi-key"
                  :append-inner-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                  @click:append-inner="passwordShow = !passwordShow" required />
              </v-card-text>
              <v-card-actions class="justify-center">
                <v-btn :loading="loading" type="submit" color="cyan" class="w-100 text-md">
                  Login
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card>
        </v-col>
      </v-main>
      <v-snackbar top color="light-green" v-model="snackbar">
        Login success
      </v-snackbar>
    </v-app>
  </section>
</template>
  
<script>
import image from '../../assets/background-1-1.png';
import imageForm from '../../assets/bg-login.png';
import {axiosClient} from '../../axios-http';
import { storeManageCookie } from '@/store/cookie'
import { userInformations } from '@/store/userStore'
export default {
  name: 'App',
  setup() {
    const userCookies = storeManageCookie();
    const userData = userInformations();
    return {
      userCookies,
      userData
    }
  },
  data() {
    return {
      image,
      imageForm,
      loading: false,
      snackbar: false,
      passwordShow: false,
      loginSuccess: false,
      email: null,
      emailRules: [
        value => !!value || 'Email is required',
        value => /.+@.+\..+/.test(value) || 'Email must be valid',
      ],
      password: null,
      passwordRules: [
        value => !!value || 'Password is required',
        value => (value && value.length >= 6) || 'Password must be 6  characters or more!',
      ],
    }
  },
  methods: {
    timeLoading() {
      setTimeout(() => {
        this.loading = false;
        this.snackbar = true;
        this.email = null;
        this.password = null;
      }, 2000);
    },
    async login() {
      if (
        this.$refs.form.validate() && this.passwordRules && this.emailRules && this.email && this.password) {
        this.loading = true;
        let user = {
          email: this.email,
          password: this.password,
        };
        try {
          const res = await axiosClient.post('login', user);
          this.timeLoading();
          let userId = this.$CryptoJS.AES.encrypt(res.data.user.id.toString(), "Secret id").toString();
          let userRole = this.$CryptoJS.AES.encrypt(res.data.role.name, "Secret role").toString();
          if (res.status == 202) {
            setTimeout(() => {
              this.loginSuccess = true;
            }, 500);

            // set cookies
            this.userCookies.setCookie('user_token', res.data.token, 30);
            this.userCookies.setCookie('user_id', userId, 30);
            this.userCookies.setCookie('user_role', userRole, 30);

            // load token from cookie after login
            this.userData.getUserData();
            if (res.data.role.name === 'admin') {
              setTimeout(() => {
                this.$router.push('admin');
              }, 1500);
            } else if (res.data.role.name === 'teacher') {
              setTimeout(() => {
                this.$router.push('teacher');
              }, 1500);
            } else if (res.data.role.name === 'student') {
              setTimeout(() => {
                this.$router.push('student');
              }, 1500);
            }
          }
        } catch (error) {
          setTimeout(() => {
            this.loading = false;
          }, 1000);
          this.errorMessage = error.response.data.message;
        }
      }
    },
  },
  mounted() {
    this.userData.getUserData();
  }
}

</script>
  
  