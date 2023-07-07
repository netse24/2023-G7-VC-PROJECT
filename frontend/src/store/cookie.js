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
            if (this.token == null) {
                this.getCookie('user_token')
            } else {
                this.token;
            }
        }
    },
    actions: {
        deleteCookie: (cookieName) => {
            var date = new Date();
            date.setTime(date.getTime() - (60 * 60 * 1000));
            var expires = 'expires=' + date.toGMTString();
            document.cookie = cookieName + '=;' + expires + ';path=/';
        },

        // set token in browser cookie
        // other sources: https://stackoverflow.com/questions/50754590/how-to-set-cookie-in-vuejs
        setCookie(cookieName, value, ex_date) {
            var date = new Date();
            date.setTime(date.getTime() + (ex_date * 24 * 60 * 60 * 1000));
            var expires = 'expires=' + date.toGMTString();
            document.cookie = cookieName + '=' + value + ';' + expires + ';path=/';
        },

        // get token from cookie in browser
        //other sources: https://stackoverflow.com/questions/54782565/get-cookie-variable-set-by-vue-js-component-in-header-script
        getCookie(user_token_in_store) {
            var cookieName = user_token_in_store + '=';
            var decodedCookie = decodeURIComponent(document.cookie);
            var splitToJsonFormat = decodedCookie.split(';');
            for (var i = 0; i < splitToJsonFormat.length; i++) {
                var cookie = splitToJsonFormat[i];
                while (cookie.charAt(0) == '') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(cookieName) == 0) {
                    return cookie.substring(cookieName.length, cookie.length);
                }
            }
            return "";
        }

    }
});
