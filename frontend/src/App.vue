<template>
  <v-app>
    <SideBar/>
    <NavigationBar/>
    <v-main>
      <LoginView @add-form="login"></LoginView>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script >
  import SideBar from "./components/sidebar/SideBar.vue";
  import NavigationBar from "./components/navbar/NavigationBar.vue";
  // import AdminPage from "./views/SchoolAdmin.vue";
  import LoginView from './views/login/LoginView.vue'
export default {
  components:{
    LoginView
  },

  methods:{
    login(login){
      alert(login)

    }
  }

}

</script>
<style>
* {
  padding: 0;
  margin: 0;
  font-family: 'Jost', sans-serif;
}

a {
  text-decoration: none;
}




