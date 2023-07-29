<template>
  <section>
    <!-- Change password dialog  -->
    <v-dialog v-model="dialogVisible" max-width="500px">
      <v-card>
        <v-form ref="form">
          <v-card-title class="headline p-3 bg-cyan">Change Password</v-card-title>
          <v-card-text class="p-3">
            <v-text-field v-model="currentPassword" :rules="currentPasswordRules"
              :type="currentPasswordShow ? 'text' : 'password'" label="Current Password" placeholder="Current Password"
              prepend-inner-icon="mdi-key" :append-inner-icon="currentPasswordShow ? 'mdi-eye' : 'mdi-eye-off'"
              @click:append-inner="currentPasswordShow = !currentPasswordShow" :error-messages="errorMessage" />
            <v-text-field v-model="newPassword" :rules="newPasswordRule" :type="newPasswordShow ? 'text' : 'password'"
              label="New Password" placeholder="New Password" prepend-inner-icon="mdi-key"
              :append-inner-icon="newPasswordShow ? 'mdi-eye' : 'mdi-eye-off'"
              @click:append-inner="newPasswordShow = !newPasswordShow" />
          </v-card-text>
          <v-card-actions class="pr-3">
            <v-spacer></v-spacer>
            <v-btn color="gray" @click="cancel">Cancel</v-btn>
            <v-btn color="cyan" @click="changePassword" :loading="loading">Confirm</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>

    <!-- nav bar -->
    <v-app-bar>
      <v-img src="../../assets/school-1.png" alt="Logo" max-width="60" max-height="50" class="ma-3" contain></v-img>
      <v-app-bar-title><span class="font-semibold">School Management System</span></v-app-bar-title>
      <v-spacer></v-spacer>
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
  </section>
</template>
<script>
import { storeManageCookie } from '@/store/cookie';
import { axiosClient } from '../../axios-http'
import Swal from 'sweetalert2'

export default {
  props: ['breadCrum'],
  setup() {
    const userCookie = storeManageCookie();
    return {
      userCookie,
    }
  },
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
      isLogout: false,

      dialogVisible: false,
      loading: false,
      currentPassword: '',
      newPassword: '',
      currentPasswordShow: false,
      newPasswordShow: false,
      currentPasswordRules: [
        value => !!value || 'Current password is required',
        value => value?.length >= 8 ? true : "Current Password must be filled out at least 8 characters",
        value => (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value)) ? true : "Current password must contain at least one letter and one number"
      ],
      newPasswordRule: [
        value => !!value || 'New password is required',
        value => value?.length >= 8 ? true : "new password must be filled out at least 8 characters",
        value => (/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(value)) ? true : "new password must contain at least one letter and one number"
      ],
      errorMessage: '',

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
          localStorage.setItem("selectedTerm", '01');
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
        icon: 'question',
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

    // use to reset new password
    async changePassword() {
      const inputBody = {
        current_password: this.currentPassword,
        new_password: this.newPassword
      }
      if (this.$refs.form.validate() && this.currentPassword != '' && this.newPassword != '') {
        this.loading = true;
        try {
          const response = await axiosClient.put('changepass', inputBody)
          this.dialogVisible = false;
          this.loading = false;
          await Swal.fire({
            position: 'center',
            showConfirmButton: false,
            icon: 'success',
            title: response.data.message,
            timer: 1500
          })
        }
        catch (error) {
          this.loading = false;
          this.errorMessage = error.response.data.message;
        }
      }
    },
    cancel() {
      this.dialogVisible = false
      this.loading = false
    },

    // hand user click on reset password or logout 
    handleItemClick(action) {
      if (action.type == "resetPW") {
        this.dialogVisible = true
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