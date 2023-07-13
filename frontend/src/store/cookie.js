import { defineStore } from "pinia";

// senior code 2022-G3-VC2-Part2 
export const storeManageCookie = defineStore('manageCookie', {

    // defind token
    state() {
        return {
            token: null
        }
    },
    getters: {
        getToken() {
            return this.token === null ? this.getCookie('user_token') : this.token;
        },
    },
    actions: {
        //
        deleteCookie: (cookieName) => {
            var date = new Date();
            date.setTime(date.getTime() - (60 * 60 * 1000));
            var expires = 'expires=' + date.toGMTString();
            document.cookie = cookieName + '=; ' + expires + '; path=/';
        },

        // set token in browser cookie
        // other sources: https://stackoverflow.com/questions/50754590/how-to-set-cookie-in-vuejs
        setCookie(cookieName, value, ex_date) {
            var date = new Date();
            date.setTime(date.getTime() + (ex_date * 24 * 60 * 60 * 1000));
            var expires = 'expires=' + date.toGMTString();
            document.cookie = cookieName + '=' + value + '; ' + expires + '; path=/';
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
        }
    }
});
