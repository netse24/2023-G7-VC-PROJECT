<script setup>
import SideBar from './components/sidebar/SideBar.vue';
import NavigationBar from './components/navbar/NavigationBar.vue';
</script>
<template>
  <form-create-user
    @teacher-emit="createUser"
    @student-emit="createUser"
  ></form-create-user>
 
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav>
  <v-app>
    <side-bar></side-bar>
    <navigation-bar></navigation-bar>
  </v-app>
</template>
<script>
import axios from "axios";
import FormCreateUser from "./views/FormCreateUser.vue";
// import LoginView from './views/login/LoginView.vue'
export default {
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
// import LoginView from './views/login/LoginView.vue'
export default {

  methods:{
    login(login){
      alert(login)

    }
  }

}
</script>
