
import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify';
import { loadFonts } from './plugins/webfontloader'
// Vuetfy
// import { createVuetify } from 'vuetify'
// import LoginView from './views/login/LoginView.vue'
loadFonts()
import BaseButton from "./components/widget/button/BaseButton.vue";
import BaseDialog from "./components/widget/dialog/BaseDialog.vue";
import GenerationListView from './views/student/GenerationListView.vue';
import StudentListView from './views/student/StudentListView.vue';

const app = createApp(App);
const pinia = createPinia();

app.component("BaseButton", BaseButton);
app.component("BaseDialog", BaseDialog);
app.component("GenerationListView", GenerationListView);
app.component("StudentListView", StudentListView);


app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
app.use(router)
app.mount('#app')
