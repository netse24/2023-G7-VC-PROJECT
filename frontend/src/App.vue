<script setup>
import SideBar from './components/sidebar/SideBar.vue';
import NavigationBar from './components/navbar/NavigationBar.vue';
</script>
<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav>
  <!-- <v-app>
    <side-bar></side-bar>
    <navigation-bar></navigation-bar>
  </v-app> -->
</template>
<script>
// import LoginView from './views/login/LoginView.vue'
export default {

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
