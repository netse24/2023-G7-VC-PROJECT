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

<script>
// import LoginView from './views/login/LoginView.vue'
import SideBar from './components/sidebar/SideBar.vue';
import NavigationBar from './components/navbar/NavigationBar.vue';
export default {
  components:{
    // LoginView,
    SideBar,
    NavigationBar
  },

  methods:{
    login(login){
      alert(login)

    }
  }

}
</script>