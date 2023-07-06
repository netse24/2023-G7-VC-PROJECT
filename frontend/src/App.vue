<template>
<<<<<<< HEAD
  <LoginView @add-form="login"></LoginView>
=======
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav>
>>>>>>> main
</template>

<script>
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

</style>