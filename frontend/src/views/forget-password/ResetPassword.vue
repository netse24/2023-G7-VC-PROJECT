<template>
  <div class="form-reset-password d-flex  align-items-center" style="height:100%">
    <div class=" container ">
      <div class="row justify-content-center">
        <div class="col-6">
          <div class="card card-default shadow">
            <v-card-title class="card-header bg-cyan-500 p-3">New Password</v-card-title>
            <div class="card-body">
              <v-form @submit.prevent="resetPassword" ref="form">
                <v-label for="text" class="font-bold">Verify Code </v-label>
                <v-text-field type="text" id="text" placeholder="123456" v-model="verify_code" :rules="numberRule"
                  prepend-inner-icon="mdi-numeric-6-box-outline" :error-messages="errorRules" />

                <v-label for="password" class="font-bold">Password</v-label>
                <v-text-field v-model="password" :rules="passwordRules" :type="passwordShow ? 'text' : 'password'"
                  label="Password" placeholder="Password" prepend-inner-icon="mdi-key"
                  :append-inner-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                  @click:append-inner="passwordShow = !passwordShow" />

                <v-label for="password_confirmation" class="font-bold">Password Confirmation</v-label>
                <v-text-field v-model="password_confirmation" :rules="Confirm_passwordRules"
                  :type="Confirmt_passwordShow ? 'text' : 'password'" label="Password" placeholder="Password"
                  prepend-inner-icon="mdi-key" :append-inner-icon="Confirmt_passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                  @click:append-inner="Confirmt_passwordShow = !Confirmt_passwordShow" />
                <v-card-actions class="btn-reset-link d-flex justify-end">
                  <v-btn type="submit" :loading="loading" class="bg-cyan px-4 text-center">
                    Reset
                  </v-btn>
                </v-card-actions>
              </v-form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script>
import { axiosClient } from '@/axios-http';
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      verify_code: null,
      password: null,
      password_confirmation: '',
      loading: false,
      passwordShow: false,
      Confirmt_passwordShow: false,
      passwordRules: [
        value => !!value || 'Password is required',
        value => value?.length >= 8 ? true : "Password must be filled out at least 8 characters",
        value => (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value)) ? true : "Password must contain at least one letter and one number"
      ],
      Confirm_passwordRules: [
        value => !!value || 'Confirst Password is required',
        value => this.password === value ? true : "Confirm Passwords do not match"
      ],
      numberRule: [
        value => !!value || 'Verify code is required',
        value => /^[0-9]+$/.test(value) ? true : 'Please enter a valid number',
        value => value?.length > 6 ? "Verify Code has only 6 digits" : true,
        value => value?.length < 6 ? "Verify Code must be 6 digits" : true,
      ],
      errorRules: ''
    }
  },
  methods: {
    async resetPassword() {
      let verify = {
        verify_code: this.verify_code,
        password: this.password
      }
      if (this.$refs.form.validate() && this.verify_code && this.password && this.passwordRules && this.numberRule) {
        try {
          this.loading = true;
          const response = await axiosClient.post("reset_password/", verify);
          if (response.status == 200) {
            await Swal.fire({
              position: 'center',
              icon: 'success',
              title: response.data.message,
              showConfirmButton: false,
              timer: 1200
            })
            this.loading = false;
            this.$router.push('/')
          }
        } catch (error) {
          this.loading = false;
          this.errorRules = error.response.data.message
        }
      }
    }
  }
}
</script>