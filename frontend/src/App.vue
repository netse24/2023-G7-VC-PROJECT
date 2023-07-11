
<template>
  <v-app>
    <NavBar />
    <v-main>
      <router-view></router-view>
      <Admin/>
    </v-main>
    <form-create-user
      @user-emit="createUser"
      @teacher-emit="createTeacher"
    ></form-create-user>
  </v-app>
</template>
<script>
import axios from "axios";
// import FormCreateUser from "./views/FormCreateUser.vue"
import NavBar from "./components/navbar/NavigationBar.vue";
import Admin from './views/student/StudentView.vue'
export default {
  components: {
    NavBar, Admin
  },

  methods: {
    login(login) {
      alert(login);
    },
    createUser(userInfo) {
      axios
        .post("http://127.0.0.1:8000/api/user", userInfo)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    createTeacher(teacherInfo) {
      console.log(teacherInfo);
      axios
        .post("http://127.0.0.1:8000/api/teacher", teacherInfo)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

