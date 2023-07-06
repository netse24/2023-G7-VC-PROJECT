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
import UserForm from "./views/admin/form/UserForm.vue"

const app = createApp(App);
const vuetify = createVuetify({
  components,
  directives,
})

app.component('UserForm', UserForm);

app.use(vuetify)
app.use(router)
app.mount('#app')
