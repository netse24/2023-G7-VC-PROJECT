//senior sourse: GEN: 2022-G3-Part2-VC2-> userStore.js
import { defineStore } from "pinia";
import CryptoJS from 'crypto-js'
import { axiosClient } from "../axios-http";
import { storeManageCookie } from "./cookie";
export const userInformations = defineStore('userInfo', {
    state() {
        return {
            userStore: null,
            storeGeneration: []
        }
    },
    getters: {
        getStoreData() {
            return this.userStore;
        },
    },
    actions: {
        async getUserData() {
            const { getCookie } = storeManageCookie();
            const user_id = CryptoJS.AES.decrypt(getCookie('user_id'), "Secret id").toString(CryptoJS.enc.Utf8)
            await axiosClient.get("users/getByIdCookie/" + user_id).then((res) => {
                this.userStore = res.data.data
            }).catch(err => console.log(err))
        },
        async showlistStudent(index) {
            await axiosClient
                .get("generations/" + index)
                .then((response) => {
                    this.storeGeneration = response.data.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    }
})