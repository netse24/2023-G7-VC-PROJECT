import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
<<<<<<< HEAD
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'

loadFonts()

createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app')
=======
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
app.use(router)
app.mount('#app')
>>>>>>> 6c6649f9380c4d6676f11bb31f6dcd7ff986a722
