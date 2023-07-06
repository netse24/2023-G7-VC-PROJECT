import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './style.css'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
loadFonts()
createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app')
