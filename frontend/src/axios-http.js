// senior code 2022-G3-VC2-Part2 
import axios from 'axios';
import { storeManageCookie } from '@/store/cookie.js';
export const axiosClient = axios.create({
    // http://127.0.0.1:8000/api/
    baseURL: process.env.VUE_APP_API_URL,
});

axiosClient.interceptors.request.use(
     async (config) => {
        const authStore = storeManageCookie();
        const token = await authStore.getToken();
        config.headers.Authorization = "Bearer " + token;
        config.headers.Accept = "application/json";
        return config;
    }, (error) => {
        return Promise.reject(error);
    }
)

