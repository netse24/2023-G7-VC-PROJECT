<template>
  <v-app>
    <SideBar/>
    <NavBar/>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script setup>
import SideBar from "./components/sidebar/SideBar.vue";
import NavBar from "./components/navbar/NavigationBar.vue";
// export default {
//   name: 'App',

//   data: () => ({
//     //
//   }),

// }
</script>
