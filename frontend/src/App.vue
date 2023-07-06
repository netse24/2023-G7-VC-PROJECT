<template>
  <LoginView @add-form="login"></LoginView>
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