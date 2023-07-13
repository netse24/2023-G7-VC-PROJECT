
import { createApp } from "vue";
import App from "./App.vue";
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader'

import { createPinia } from 'pinia'
import BaseButton from "./components/widget/button/BaseButton.vue";
import BaseDialog from "./components/widget/dialog/BaseDialog.vue";

loadFonts()
const app = createApp(App);
const pinia = createPinia();

app.component("BaseButton", BaseButton);
app.component("BaseDialog", BaseDialog);
app.component("GenerationListView", GenerationListView);
app.component("StudentListView", StudentListView);
app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
app.use(pinia)
app.use(vuetify)
app.use(VueSweetalert2)
app.use(router)
app.mount('#app')
