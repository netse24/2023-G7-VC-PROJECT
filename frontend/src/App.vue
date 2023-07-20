<template>
  <section>
    <v-app>
      <v-main>
        <router-view></router-view>
      </v-main>
    </v-app>
  </section>
</template>
<script>
import { userInformations } from "@/store/userStore";
export default {
  setup() {
    const userData = userInformations();
    return {
      userData, 
    }
  },
}

</script>
