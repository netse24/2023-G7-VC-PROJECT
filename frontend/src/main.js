import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './style.css'

loadFonts()

createApp(App)
  .use(router)
  .use(vuetify)
  .mount('#app')
