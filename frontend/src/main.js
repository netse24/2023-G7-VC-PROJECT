import { createApp } from 'vue'
import './style.css'
import VueCryptoJS from 'vue-cryptojs';
import App from './App.vue'
import router from './router'
<<<<<<< HEAD
import './style.css'
<<<<<<< HEAD
=======
>>>>>>> a48eb9e84aa63d24e3257b38430929f08df1404d
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
import { createPinia } from 'pinia'


loadFonts()
<<<<<<< HEAD
createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app')
=======

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
app.use(router)
app.mount('#app')
>>>>>>> createUser
=======
const app = createApp(App)
const pinia = createPinia();
app.use(vuetify)
app.use(pinia)
app.use(VueCryptoJS)
app.use(router)
app.mount('#app')

>>>>>>> a48eb9e84aa63d24e3257b38430929f08df1404d
