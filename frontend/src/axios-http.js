import axios from 'axios';
import { storeManageCookie } from '@/store/cookie.js';
export const axiosClient = axios.create({
    // http://127.0.0.1:8000/api
    baseURL: process.env.VUE_APP_API_URL,
});

axiosClient.interceptors.request.use(
    (config) => {
        const authStore = storeManageCookie();
        const token = authStore.getToken;
        config.headers.Authorization = "Bearer " + token;
        config.headers.Accept = "application/json";
        return config;
    }, (error) => {
        return Promise.reject(error);
    }
)

