<template>
  <!-- <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
    <router-view/>
  </nav> -->
  <user-form @add-emit="add"></user-form>
</template>

<script>

export default{
    data(){
      return{
        address: "",
      }
    },
    methods: {
      add(gender){
        console.log(gender)
      }
    }
}

</script>



