//senior sourse: GEN: 2023-G3-Part2-VC2-> userStore.js
import { defineStore } from "pinia";
import CryptoJS from 'crypto-js'
import { axiosClient } from "../axios-http";
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
        getCookie(name) {
            var cname = name + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var splitDataToJsonFormat = decodedCookie.split(";");
            for (var i = 0; i < splitDataToJsonFormat.length; i++) {
                var cookie = splitDataToJsonFormat[i];
                while (cookie.charAt(0) == " ") {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cname) == 0) {
                    return cookie.substring(cname.length, cookie.length);
                }
            }
            return "";
        },
        getUserData() {
            let userId = CryptoJS.AES.decrypt(this.getCookie('user_id'), "Screat id").toString(CryptoJS.enc.Utf8)
            axiosClient.get("/users/" + userId).then((res) => {
                this.userStore = res.data
            }).catch(err => console.log(err))
        },

    }
})