
import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import { loadFonts } from './plugins/webfontloader'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import 'sweetalert2/dist/sweetalert2.min.css';
import './style.css'


import BaseButton from "./components/widget/button/BaseButton.vue";
import BaseDialog from "./components/widget/dialog/BaseDialog.vue";
import navigationBar from "./components/navbar/NavigationBar.vue";
import FormCreateUser from "./views/admin/FormCreateUser.vue";


loadFonts()
const app = createApp(App);
const pinia = createPinia();

app.component("BaseButton", BaseButton);
app.component("BaseDialog", BaseDialog);
app.component("nav-bar", navigationBar);
app.component("form-create-user", FormCreateUser);
app.use(VueCryptoJS)

app.use(pinia)
app.use(vuetify)
app.use(router)
app.mount('#app')
