//senior sourse: GEN: 2022-G3-Part2-VC2-> userStore.js
import { defineStore } from "pinia";
import { axiosClient } from "../axios-http";
export const userInformations = defineStore('userInfo', {
  state() {
    return {
      userStore: null,
      errorMessage:null
    }
  },
  getters: {
    getStoreData() {
      return this.userStore;
    },
  },
  actions: {
    async getUserData() {
      try {
        const response = await axiosClient.get('users/auth');
        if (response.status === 200) {
          this.userStore = response.data.data;
        } else {
          this.userStore = null;
        }
      } catch (error) {
        // customer error
        this.errorMessage = 'Oops! Something went wrong. Please try again later.';
        console.error('An error occurred:', error.message);
        console.error('An error occurred:', this.errorMessage);
        this.userStore = null;
      }
    }
  }

})