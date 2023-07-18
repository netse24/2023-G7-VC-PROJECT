<template>
  <v-app-bar>
    <v-img src="../../assets/school-1.png" alt="Logo" max-width="60" max-height="50" class="ma-3" contain></v-img>
    <v-app-bar-title>School Management System</v-app-bar-title>
    <v-spacer></v-spacer>
    <v-btn icon>
      <v-icon>mdi-moon-waning-crescent</v-icon>
    </v-btn>
    <v-btn icon @click="onClickVertical">
      <v-menu>
        <template v-slot:activator="{ props }">
          <v-btn icon v-bind="props">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list class="d-flex flex-column rounded-0 hover bg-gray pointer w-auto">
          <v-list-item v-for="(item, i) in items" :key="i" v-on:click="handleItemClick(item)" class="d-flex">
            <v-list-item-title>
              <v-icon class="pr-5 pl-3">{{ item.icon }}</v-icon>{{ item.title }}
            </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-btn>
  </v-app-bar>
</template>
<script>
import { storeManageCookie } from '@/store/cookie';
import { userInformations } from '@/store/userStore';
import { axiosClient } from '../../axios-http'
import CryptoJS from 'crypto-js';
import Swal from 'sweetalert2'

export default {
  setup() {
    const userCookie = storeManageCookie();
    const userData = userInformations();
    return {
      userCookie,
      userData,
    }
  },
  props: ['breadCrum'],
  data() {
    return {
      isVertical: false,
      breadcrum: [],
      items:
        [
          { title: "Reset Password", icon: "mdi-update", type: "resetPW" },
          { title: "Log Out", icon: "mdi-logout", type: "logout" },
        ],
      showSearchBar: false,
      searchQuery: null,
      isLogout: false

    }
  },
  methods: {
    onClickVertical() {
      this.isVertical = !this.isVertical;
    },

    // user logout
    async logout() {
      const confirmed = await this.confirmLogout();
      if (confirmed) {
        try {
          await axiosClient.post('logout');
          this.userCookie.deleteCookie('user_token');
          this.userCookie.deleteCookie('user_role');
          this.userCookie.deleteCookie('user_id');
          this.$router.push('/');
        } catch (error) {
          if (error.response && error.response.status === 401) {
            console.log('un-auth');
          }
        }
      }
    },

    // user comfirm logout 
    async confirmLogout() {
      const result = await Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'Do you want to logout?',
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        reverseButtons: true,
      });

      if (result.isConfirmed) {
        await Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Logout Successfully!',
          showConfirmButton: false,
          timer: 1500,
        });
        return true; // Return true after successful confirmation
      } else {
        return false; // Return false if the confirmation is canceled
      }
    },

    // user reset password
    resetPW() {
      Swal.fire({
        title: 'Reset your password?',
        input: 'email',
        inputPlaceholder: 'Enter your Email',
        confirmButtonText: 'Continue',
        reverseButtons: true,
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        showLoaderOnConfirm: true,
        preConfirm: (emailInput) => {
          return axiosClient.post('check_email', { email: emailInput })
            .then(response => {
              if (!response.status) {
                throw new Error(response.statusText)
              }
              return response.data.status
            })
            .catch(error => {
              Swal.showValidationMessage(
                `Request failed: ${error}`
              )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            confirmButtonText: 'Confirm',
            inputAttributes: {
              autocapitalize: 'off'
            },
            showCancelButton: true,
            showLoaderOnConfirm: true,
            title: 'Change Password',
            html:
              '<input id="current_pass" class="swal2-input" type="password" style="width:80%" placeholder="current password">' +
              '<input id="new_pass" class="swal2-input" type="password"  style="width:80%" placeholder="new password">',
            focusConfirm: false,
            reverseButtons: true,
            preConfirm: () => {
              let current = document.getElementById('current_pass').value
              let new_pass = document.getElementById('new_pass').value
              let input_body = {
                current_password: current,
                new_password: new_pass
              }
              return axiosClient.put('changepass', input_body).then((response) => {
                if (response.status !== 200) {
                  throw new Error(response.response.data.message)
                } else {
                  return Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                    timer: 2000
                  })
                }
              }).catch(error => {
                Swal.showValidationMessage(
                  error.response.data.message,
                )
              })
            }
          })
        }
      })
    },

    // hand user click on reset password or logout 
    handleItemClick(action) {
      if (action.type == "resetPW") {
        this.resetPW();
      } else if (action.type == "logout") {
        this.logout();
      }
    },
  },
}

</script>
<style scoped>
* {
  padding: 0;
  margin: 0;
}

.hover:hover {
  background-color: #d9d6d6ed;
  cursor: pointer;
}

v-list-item:focus {
  background-color: cyan;
}

.search-bar {
  background: #d1d1d1;
}

.input-search {
  padding: 8px;
  width: 15rem;
  outline: none;
  opacity: 0.8;
}
</style>