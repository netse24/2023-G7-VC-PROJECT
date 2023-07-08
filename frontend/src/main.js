import { createApp } from 'vue'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createPinia } from 'pinia'


loadFonts()
const app = createApp(App)
const pinia = createPinia();
app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
app.use(router)
app.mount('#app')

