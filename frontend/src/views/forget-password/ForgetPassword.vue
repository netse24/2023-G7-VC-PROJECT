<template>
  <v-card class="forget-pass-form d-flex items-center h-full " :style="{ backgroundImage: `url(${image})` }">
    <v-form class="w-[40%] m-auto border rounded shadow" @submit.prevent="sendResetCode" ref="form" :style="{ backgroundImage: `url(${imageForm})` }">
      <v-card-title class="font-bold text-lg p-3 bg-cyan-500 rounded-t-md  items-center">Forget
        Password</v-card-title>
      <div class="group-form p-2">
        <div class="mt-1">
          <v-label for="email" class="block mb-2 text-sm font-bold ">Email</v-label>
          <v-text-field v-model="email" :rules="emailRules" type="email" label="Email" placeholder="Email"
            prepend-inner-icon="mdi-gmail" required :error-messages="NotfoundEmail" />
        </div>
        <v-card-actions class="btn-reset-link d-flex justify-between pt-2">
          <router-link to="/" class="cursor-pointer hover:text-red-500 hover:underline font-semibold">Back to login</router-link>
          <v-btn type="submit" :loading="loading" class="bg-cyan font-semibold">
            Send Code
          </v-btn>
        </v-card-actions>
      </div>
    </v-form>
  </v-card>
</template>

<script>
import { axiosClient } from '../../axios-http';
import Swal from 'sweetalert2'
import image from '../../assets/background-1-1.png';
import imageForm from '../../assets/bg-login.png';
export default {
  data() {
    return {
      image,
      imageForm,
      email: '',
      emailRules: [
        value => !!value || 'Email is required',
        value => /.+@.+\..+/.test(value) || 'Email must be valid',
      ],
      emailNotFound: false,
      loading: false,
      NotfoundEmail: ''
    };
  },
  methods: {
    async sendResetCode() {
      if (this.$refs.form.validate() && this.email) {
        this.loading = true;
        try {
          const response = await axiosClient.post('forget_password', { email: this.email });
          if (response.status === 200) {
            await Swal.fire({
              position: 'center',
              icon: 'success',
              title: response.data.message,
              showConfirmButton: false,
              timer: 1200
            })
            this.$router.push('/reset-password');
          }
        } catch (error) {
          this.emailNotFound = true;
          this.loading = false;
          this.NotfoundEmail = error.response.data.message;
        }
      }
    },
  },
};
</script>


<style  scoped></style>