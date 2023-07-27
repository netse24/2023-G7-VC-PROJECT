<template>
  <section>
    <v-app :style="{ backgroundImage: `url(${image})` }" class="bg-no-repeat h-screen">
      <v-main class="d-flex justify-center align-center">
        <v-col cols="10" lg="4" class="mx-auto">
          <h1 class="pa-5 text-3xl text-center bold font-bold">Welcome to <br> School Management System</h1>
          <v-card class="pa-4" :style="{ backgroundImage: `url(${imageForm})` }">
            <div class="text-center">
              <v-avatar size="100" color="cyan lighten-4">
                <v-icon size="40" color="#fff">mdi-account</v-icon>
              </v-avatar>
              <h1 class="text-[20px] bold text-bold">LOGIN</h1>
            </div>
            <v-form @submit.prevent="login" ref="form" class="w-100">
              <v-card-text>
                <v-text-field v-model="email" :rules="emailRules" type="email" label="Email" placeholder="Email"
                  prepend-inner-icon="mdi-account" :error-messages="errorMessage" />
                <v-text-field v-model="password" :rules="passwordRules" :type="passwordShow ? 'text' : 'password'"
                  label="Password" placeholder="Password" prepend-inner-icon="mdi-key"
                  :append-inner-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                  @click:append-inner="passwordShow = !passwordShow" :error-messages="errorMessage" />

                <router-link to="/forget-password"
                  class=" cursor-pointer hover:text-red-600 font-semibold hover:underline" @click="forgetPassword">
                  Forget Password?
                </router-link>
              </v-card-text>
              <v-card-actions class="justify-center">
                <v-btn :loading="loading" type="submit" class="bg-cyan w-100 text-md">
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
import { storeManageCookie } from '../../store/cookie';

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
      passwordShow: false,
      email: '',
      emailRules: [
        value => !!value || 'Email is required',
        value => /.+@.+\..+/.test(value) || 'Email must be valid',
      ],
      password: '',
      passwordRules: [
        value => !!value || 'Password is required',
        value => value?.length >= 8 ? true : "Password must be filled out at least 8 characters",
        value => (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value)) ? true : "Password must contain at least one letter and one number"
      ],
      errorMessage: '',
    }
  },
  methods: {
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
          this.success = true;
          const checkRole = res.data.user.role.role;
          this.email = null
          this.password = null

          // Senior Code  // senior code 2022-G3-VC2-Part2 
          // AES stand for advaned enscryption standard
          var userRole = this.$CryptoJS.AES.encrypt(res.data.user.role.role, "Secret role").toString();
          var userId = this.$CryptoJS.AES.encrypt(res.data.user.id.toString(), "Secret id").toString();

          // set cookies
          this.cookie.setCookie('user_token', res.data.token, 30);
          this.cookie.setCookie('user_id', userId, 30);
          this.cookie.setCookie('user_role', userRole, 30);

          // https://zzzcode.ai/answer-question: use old code and tell ai correct it.
          switch (checkRole) {
            case 'admin':
              this.loading = false;
              this.$router.push('admin');
              break;
            case 'teacher':
              this.loading = false;
              this.$router.push('teachers');
              break;
            case 'student':
              this.loading = false;
              this.$router.push('students');
              break;
          }
        }
        catch (error) {
          this.loading = false;
          this.errorMessage = error.response.data.message
        }
      }
    },
  },
}

</script>
  
  