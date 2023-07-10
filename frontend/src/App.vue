<template>
  <form-create-user
    @teacher-emit="createUser"
    @student-emit="createUser"
  ></form-create-user>
</template>
<script>
// import LoginView from './views/login/LoginView.vue'
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






