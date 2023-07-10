<template>
  <section>
    <v-app>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
    <form-create-user
      @teacher-emit="createUser"
      @student-emit="createUser"
  ></form-create-user>
  </section>
  
</template>
<script>
import { userInformations } from '@/store/userStore'
import axios from "axios";
import FormCreateUser from "./views/FormCreateUser.vue";
// import LoginView from './views/login/LoginView.vue'

// import LoginView from './views/login/LoginView.vue'
export default {
  name: 'App',
  setup() {
    const userData = userInformations();
    return {
      userData
    }
  },
  components: {
    FormCreateUser,
  },
  methods: {
    login(login) {
      alert(login);
    },
    createUser(userInfo) {
      console.log(userInfo);
      axios.post("http://127.0.0.1:8000/api/user", userInfo)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>






