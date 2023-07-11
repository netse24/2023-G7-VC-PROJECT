
import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader'
<<<<<<< HEAD


loadFonts()
const app = createApp(App)
=======
// Vuetfy
// import { createVuetify } from 'vuetify'
// import LoginView from './views/login/LoginView.vue'
loadFonts()
import BaseButton from "./components/widget/button/BaseButton.vue";
import BaseDialog from "./components/widget/dialog/BaseDialog.vue";
const app = createApp(App);
>>>>>>> 66c09efa08e6161089f645e71569602ac40ce99d
const pinia = createPinia();

app.component("BaseButton", BaseButton);
app.component("BaseDialog", BaseDialog);
app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
app.use(router)
app.mount('#app')
