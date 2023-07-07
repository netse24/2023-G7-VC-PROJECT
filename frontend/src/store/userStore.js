//senior sourse: GEN: 2023-G3-Part2-VC2-> userStore.js

import { defineStore } from "pinia";
import CryptoJS from 'crypto-js'
import axiosClient from "../axios-http";

export const userInformations = defineStore('userInfo', {
    state() {
        return {
            firstName: null,
            lastName: null,
            gender: null,
            email: null,
            dateOfBirth: null,
            address: null,
            password: null,
            userStore: null,
        }
    },
    actions: {
        getUserData() {
            let userId = CryptoJS.AES.decrypt(
                this.getCookie("user_id").toString(),
                "Screat id"
            ).toString(CryptoJS.enc.Utf8);

            axiosClient.get("/user/" + userId).then((res) => {
                this.userStore = res.data;
                this.getDataNeed();
            });
        },
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

    }
})