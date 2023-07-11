
import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


import BaseButton from "./components/widget/button/BaseButton.vue";
import BaseDialog from "./components/widget/dialog/BaseDialog.vue";
import navigationBar from "./components/navbar/NavigationBar.vue";
loadFonts()
const app = createApp(App);
const pinia = createPinia();

app.component("BaseButton", BaseButton);
app.component("BaseDialog", BaseDialog);
app.component("nav-bar", navigationBar);
app.use(vuetify)
app.use(VueSweetalert2)
app.use(pinia)
app.use(VueCryptoJS)
app.use(router)
app.mount('#app')
