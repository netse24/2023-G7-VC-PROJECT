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
  <v-app>
    <side-bar></side-bar>
    <navigation-bar></navigation-bar>
  </v-app>
</template>

<script>
// import LoginView from './views/login/LoginView.vue'
export default {

  methods:{
    login(login){
      alert(login)

    }
  }

}
</script>