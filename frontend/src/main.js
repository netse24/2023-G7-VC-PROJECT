<<<<<<< HEAD
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './style.css'

// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
// import LoginView from './views/login/LoginView.vue'
const app = createApp(App);
const vuetify = createVuetify({
  components,
  directives,
})
app.use(vuetify)
=======

import { createApp } from "vue";
import App from "./App.vue";
import { createPinia } from 'pinia'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createPinia } from 'pinia'
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
// Vuetfy
// import { createVuetify } from 'vuetify'
// import LoginView from './views/login/LoginView.vue'
loadFonts()
import BaseButton from "./components/widget/button/BaseButton.vue";
import BaseDialog from "./components/widget/dialog/BaseDialog.vue";
const app = createApp(App);
const pinia = createPinia();

app.component("BaseButton", BaseButton);
app.component("BaseDialog", BaseDialog);
app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
>>>>>>> 66bbd6d746ee89a5f4cb5c6195bafafc9aaef9ac
app.use(router)
app.mount('#app')
