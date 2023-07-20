<template>
  <section>
    <v-app :style="{ backgroundImage: `url(${image})` }" class="bg-no-repeat h-screen">
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
            <v-form @submit.prevent="login" ref="form" class="w-100">
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
    </v-app>
  </section>
</template>
  
<script>
import image from '../../assets/background-1-1.png';
import imageForm from '../../assets/bg-login.png';
import { axiosClient } from '../../axios-http';
// import { userInformations } from '../../store/userStore';
import { storeManageCookie } from '../../store/cookie';
import Swal from 'sweetalert2'

export default {
  name: 'App',
  setup() {
    const cookie = storeManageCookie()
    return {
      cookie
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
      errorMessage: null,
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
          console.log(res);
          // Senior Code  // senior code 2022-G3-VC2-Part2 
          // AES stand for advaned enscryption standard
          var userRole = this.$CryptoJS.AES.encrypt(res.data.user.role.role, "Secret role").toString();
          var userId = this.$CryptoJS.AES.encrypt(res.data.user.id.toString(), "Secret id").toString();
          setTimeout(() => {
            this.loginSuccess = true;
          }, 500);
          if (res.status) {
            // set cookies
            this.cookie.setCookie('user_token', res.data.token, 30);
            this.cookie.setCookie('user_id', userId, 30);
            this.cookie.setCookie('user_role', userRole, 30);
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Login Success',
              showConfirmButton: false,
              timer: 1500
            })
            // https://zzzcode.ai/answer-question: use old code and tell ai correct it.
            switch (res.data.user.role.role) {
              case 'admin':
                setTimeout(() => {
                  this.$router.push('admin');
                }, 1500);
                break;
              case 'teacher':
                setTimeout(() => {
                  this.$router.push('teachers');
                }, 1500);
                break;
              case 'student':
                setTimeout(() => {
                  this.$router.push('students');
                }, 1500);
                break;
            }
          }
        }
        catch (error) {
          setTimeout(() => {
            this.loading = false;
            console.error(error);
            Swal.fire(error.response.data.message);
          }, 1000);
        }
      }
    }
  },

}

</script>
  
  