
<template>
    <section>
        <v-alert type="success" title="Alert title" text="login Success!" v-model="loginSuccess"></v-alert>
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
                        <v-form @submit.prevent="login" ref="form">
                            <v-card-text>
                                <v-text-field v-model="email" :rules="emailRules" type="email" label="Email"
                                    placeholder="Email" prepend-inner-icon="mdi-account" required />
                                <v-text-field v-model="password" :rules="passwordRules"
                                    :type="passwordShow ? 'text' : 'password'" label="Password" placeholder="Password"
                                    prepend-inner-icon="mdi-key" :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                                    @click:append="passwordShow = !passwordShow" required />
                            </v-card-text>
                            <p v-if="errorMessage != ''" class ='d-flex justify-center'>{{ errorMessage }}</p>
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
import axiosClient from '../../axios-http';
import { storeManageCookie } from '@/store/cookie'
export default {
    name: 'App',
    setup() {
        const userCookies = storeManageCookie();
        return {
            userCookies
        }
    },
    data() {
        return {
            image,
            imageForm,
            loading: false,
            snackbar: false,
            passwordShow: false,
            errorMessage: '',
            loginSuccess: false,
            email: null,
            emailRules: [
                value => !!value || 'E-mail is required',
                value => /.+@.+\..+/.test(value) || 'E-mail must be valid',
            ],
            password: null,
            passwordRules: [
                value => !!value || 'Password is required',
                value => (value && value.length >= 6) || 'Password must be 6  characters or more!',
            ],
        }
    },
    methods: {
        timeLoarding() {
            setTimeout(() => {
                this.loading = false
                this.snackbar = true
                this.email = null
                this.password = null
            }, 2000)
        },
        login() {
            if (this.$refs.form.validate() && this.passwordRules && this.emailRules, this.email, this.password) {
                this.loading = true
                let user = {
                    email: this.email,
                    password: this.password,
                }
                axiosClient.post('login', user).then((res) => {
                    this.timeLoarding()
                    let userId = this.$CryptoJS.AES.encrypt(res.data.user.id.toString(), "Screat id").toString();
                    let userRole = this.$CryptoJS.AES.encrypt(res.data.role.name.toString(), "Screat role").toString();
                    if (res.status == 202) {
                        this.loginSuccess = true
                        // set cookie 
                        this.userCookies.setCookie('user_token', res.data.token, 30)
                        this.userCookies.setCookie('user_id', userId, 30)
                        this.userCookies.setCookie('user_role', userRole, 30)
                        this.timeLoarding()
                        if (res.data.role.name == 'admin') {
                            setTimeout(() => {
                                this.$router.push('admin')
                            }, 1500)
                        }
                        else if (res.data.role.name == 'teacher') {
                            setTimeout(() => {
                                this.$router.push({ name: 'teacher' })
                            }, 1500)
                        }
                        else if (res.data.role.name == 'student') {
                            setTimeout(() => {
                                this.$router.push({ name: 'student' })
                            }, 1500)
                            // this.$router.push({ name: 'student' })
                        }
                    }
                }).catch(error => {
                    setTimeout(() => {
                        this.loading = false;
                    }, 1000)
                    console.log(error.response.data.message)
                    this.errorMessage = error.response.data.message;
                });
            }
        }
    }
}

</script>
  
  