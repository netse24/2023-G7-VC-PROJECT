<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav> -->
  <user-form @add-emit="add"></user-form>
</template>
<script>
// import LoginView from './views/login/LoginView.vue'
export default {
  // components:{
  //   LoginView
  // },

  methods:{
    login(login){
      alert(login)

    }
  }

}
</script>


