<template>
  <v-app>
    <SideBar/>
    <NavigationBar/>
    <v-main>
    <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script setup>
  import SideBar from "./components/sidebar/SideBar.vue";
  import NavigationBar from "./components/navbar/NavigationBar.vue";
  // import AdminPage from "./views/SchoolAdmin.vue";
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
</style>