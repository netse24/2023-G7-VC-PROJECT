<template>
  <v-app>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-app>
</template>

<script>
import {userInformations} from '@/store/userStore'
export default {
  name: 'App',
  setup(){
    const userData = userInformations();
    return {
      userData
    }
  },
  beforeCreate(){
    if(this.userData.getCookie('user_id')){
        this.userData.getUserData();
    }
  }

}

</script>

