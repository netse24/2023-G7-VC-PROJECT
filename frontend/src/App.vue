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
  methods: {
    // createUser(userInfo) {
    //   console.log(userInfo);
    //   axios.post("http://127.0.0.1:8000/api/user", userInfo)
    //     .then((response) => {
    //       console.log(response.data);
    //     })
    //     .catch((error) => {
    //       console.error(error.message);
    //     });
    // },
  },

}

</script>
