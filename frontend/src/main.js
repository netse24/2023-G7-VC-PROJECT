import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import { loadFonts } from './plugins/webfontloader'
const app = createApp;
loadFonts()

app(App)
  .use(router)
  .use(vuetify)
  .mount('#app')
