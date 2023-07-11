//senior sourse: GEN: 2023-G3-Part2-VC2-> userStore.js
import { defineStore } from "pinia";
// import CryptoJS from 'crypto-js'
import axiosClient from "../axios-http";
export const userInformations = defineStore('userInfo', {
    state() {
        return {
            userStore: null
        }
    },
    getters: {
        getStoreData() {
            return this.userStore;
        }
    },
    actions: {
        getCookie(user_token_in_store) {
            let cookieName = user_token_in_store + '=';
            let decodedCookie = decodeURIComponent(document.cookie);
            let splitToJsonFormat = decodedCookie.split(';');
            for (let i = 0; i < splitToJsonFormat.length; i++) {
                let cookie = splitToJsonFormat[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) == 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }
            return "";
        },
        getUserData() {
            // let userId = CryptoJS.AES.decrypt(this.getCookie('user_id'), "Screat id").toString(CryptoJS.enc.Utf8)
            // axiosClient.get("/users/" + userId).then((res) => {
            //     this.userStore = res.data
            //     // alert(res.data)
            // })
            axiosClient.get("/user").then((res) => {
                this.userStore = res.data
            })
        },

    }
})