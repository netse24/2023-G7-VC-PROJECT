<template>
  <section>
    <SideBar />
    <NavBar />
    <v-container class="mt-10 text-h3">
      <v-row dense>
        <v-col>
          <v-sheet color="#5AB9C1" height="210" class="d-flex flex-column align-center justify-center rounded-shaped">
            <v-icon class="mdi mdi-account-tie text-10"></v-icon>
            <div class="text-subtitle-2">ALL TEACHERS</div>
            <div class="text-subtitle-1">44</div>
          </v-sheet>
        </v-col>
        <v-col>
          <v-sheet color="#5AB9C1" height="210" class="d-flex flex-column align-center justify-center rounded-shaped">
            <v-icon class="mdi mdi-school-outline"></v-icon>
            <div class="text-subtitle-2">ALL STUDENTS</div>
            <div class="text-subtitle-1">4430</div>
          </v-sheet>
        </v-col>
        <v-col>
          <v-sheet color="#5AB9C1" height="210" class="d-flex flex-column align-center justify-center rounded-ts-xl">
            <v-icon class="mdi mdi-chart-line"></v-icon>
            <div class="text-subtitle-2">TOTAL USERS</div>
            <div class="text-subtitle-1">4474</div>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<script >
import SideBar from '../../components/sidebar/SideBar.vue'
import NavBar from '../../components/navbar/NavigationBar.vue'
import { storeManageCookie } from '@/store/cookie'
import { userInformations } from '@/store/userStore'
export default {
  components: {
    SideBar,
    NavBar,
  },

  setup() {
    const userCookies = storeManageCookie();
    const userData = userInformations();
    return {
      userCookies,
      userData,
    }
  },
  data() {
    return {

    }
  },
  created() {
    this.userData.getUserData()
  },
}

</script>
<style>
* {
  padding: 0;
  margin: 0;
  font-family: 'Jost', sans-serif;
}
</style>