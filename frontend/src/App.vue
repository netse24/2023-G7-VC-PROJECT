<template>
  <v-app>
    <!-- sidebar -->
    <SideBar/>
    <NavigationBar/>
    <v-main>
      <!-- cards -->
      <router-link to="/admin">
        <AdminPage/>
      </router-link>
    </v-main>
  </v-app>
</template>

<script setup>
  import SideBar from "./components/sidebar/SideBar.vue";
  import NavigationBar from "./components/navbar/NavigationBar.vue";
  import AdminPage from "./views/SchoolAdmin.vue";

</script>
<style>
* {
  padding: 0;
  margin: 0;

}
router-link {
  list-style: none;
}
</style>