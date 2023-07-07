<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav> -->
  <form-create-user @user-emit="createUser" @teacher-emit="createTeacher"></form-create-user>
</template>
<script>
import axios from "axios";
import FormCreateUser from "./views/FormCreateUser.vue"
// import LoginView from './views/login/LoginView.vue'
export default {
  components:{
    FormCreateUser
  },

  methods:{
    login(login){
      alert(login)
    },
    createUser(userInfo){
      axios.post("http://127.0.0.1:8000/api/user", userInfo)
              .then(response=>{
                  console.log(response.data)
              })
              .catch(error=>{
                  console.log(error)
    })
    },
    createTeacher(teacherInfo){
      console.log(teacherInfo)
      axios.post("http://127.0.0.1:8000/api/teacher", teacherInfo)
              .then(response=>{
                  console.log(response.data)
              })
              .catch(error=>{
              console.log(error)
      })
      },
  }
  

}
</script>


