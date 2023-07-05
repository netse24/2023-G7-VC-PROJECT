<template>
  <v-app>
    <!-- sidebar -->
    <SideBar/>
    <NavigationBar/>
    <v-main>
      <!-- cards -->
      <AdminPage/>
    </v-main>
  </v-app>
</template>

<script setup>
  import SideBar from "./components/sidebar/SideBar.vue";
  import NavigationBar from "./components/navbar/NavigationBar.vue";
  import AdminPage from "./views/SchoolAdmin.vue";

</script>
