<template>
  <v-app-bar>
    <v-img src="../../assets/school-1.png" alt="Logo" max-width="60" max-height="50" class="ma-3" contain></v-img>
    <v-breadcrumbs :items="breadCrum" class="mt-3">
      <template v-slot:divider>
        <v-icon icon="mdi-chevron-right"></v-icon>
      </template>
    </v-breadcrumbs>
    <v-spacer></v-spacer>
    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>

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
      items: [
        { title: "Your Profile", icon: "mdi-account-circle" },
        { title: "Reset Password", icon: "mdi-update" },
        { title: "Log Out", icon: "mdi-logout" },
      ],
    };
  },
  methods: {
    onClickVertical() {
      this.isVertical = !this.isVertical;
    },
    logout() {
      if (confirm('Do you want to logout?')) {
        this.$router.push('/')
        axiosClient.post('logout').then(() => {
          this.userCookie.deleteCookie('user_token')
          this.userCookie.deleteCookie('user_role')
          this.userCookie.deleteCookie('user_id')
        }).catch(error => {
          if (error.response.status === 401) {
            console.log('un-auth')
          }
        })

      }
    },
    resetPW() {
      this.$swal.fire({
        title: 'Reset your password?',
        input: 'email',
        inputPlaceholder: 'Enter your Email',
        confirmButtonText: 'Continue',
        inputAttributes: {
          autocapitalize: 'Cancel'
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
              this.$swal.showValidationMessage(
                `Request failed: ${error}`
              )
            })
        },
        allowOutsideClick: () => !this.$swal.isLoading()
      }).then((result) => {
        if (result.isConfirmed) {
          this.$swal.fire({
            confirmButtonText: 'Confirm',
            inputAttributes: {
              autocapitalize: 'Cancel'
            },
            showCancelButton: true,
            showLoaderOnConfirm: true,
            title: 'Change Password',
            html:
              '<input id="current_pass" class="swal2-input" type="password" style="width:80%" placeholder="current password">' +
              '<input id="new_pass" class="swal2-input" type="password"  style="width:80%" placeholder="new password">',
            focusConfirm: false,
            preConfirm: () => {
              let current = document.getElementById('current_pass').value
              let new_pass = document.getElementById('current_pass').value
              let input_body = {
                current_password: current,
                new_password: new_pass
              }
              return axiosClient.put('changepass', input_body).then((response) => {
                if (!response.status == 200) {
                  throw new Error(response)
                } else {
                  return this.$swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                    timer: 2000
                  })
                }
              }).catch(error => {
                this.$swal.showValidationMessage(
                  error.response.data.message,
                )
              })
            }
          })
        }
      })
    },

    detailPF() {
      this.$swal.fire({
        title: 'Do you want to logout?',
      })
    },

    handleItemClick(action) {
      if (action.type == "profile") {
        this.detailPF();
      } else if (action.type == "resetPW") {
        this.resetPW();
      } else if (action.type == "logout") {
        this.logout();
      }
    }
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
</style>