import { defineStore } from "pinia";

// senior code 2022-G3-VC2-Part2 
export const storeManageCookie = defineStore('manage-cookie', {

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
            return '';
        },
    }
});
