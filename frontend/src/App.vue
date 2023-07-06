<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav> -->
  <section>
      <side-bar></side-bar>
     <navigation-bar></navigation-bar>
  </section>
 
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