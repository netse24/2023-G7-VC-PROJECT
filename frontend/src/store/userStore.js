//senior sourse: GEN: 2023-G3-Part2-VC2-> userStore.js
import { defineStore } from "pinia";
import { AES, enc } from 'crypto-js'
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
            let userId = AES.decrypt(this.getCookie('user_id'), "Screat id").toString(enc.Utf8)
            axiosClient.get("/users/" + userId).then((res) => {
                this.userStore = res.data
            })
        },

    }
})