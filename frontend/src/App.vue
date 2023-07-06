<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav> -->
  <form-create-user></form-create-user>
</template>
<script>
import FormCreateUser from "./views/FormCreateUser.vue"
// import LoginView from './views/login/LoginView.vue'
export default {
  components:{
    FormCreateUser
  },

  methods:{
    login(login){
      alert(login)

    }
  }

}
</script>


