
import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader'


loadFonts()
const app = createApp(App)
const pinia = createPinia();

// app.component("BaseButton", BaseButton);
// app.component("BaseDialog", BaseDialog);
app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
app.use(router)
app.mount('#app')
