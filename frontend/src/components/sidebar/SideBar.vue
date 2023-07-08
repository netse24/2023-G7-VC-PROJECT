<template>
  <VNavigationDrawer expand-on-hover class="bg-[#B6EDFF]" rail>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet" />
    <VList>
      <VListItem prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg" title="John Smith"
        subtitle="johnsmith@gmail.com"></VListItem>
    </VList>
    <VDivider />
    <VList>
      <!-- icon = mdi -->
      <router-link to="/admin">
        <VListItem prepend-icon="mdi-home" title="Home" value="myfiles" class="my-10"></VListItem>
      </router-link>
      <router-link to="/admin/students">
        <VListItem prepend-icon="mdi-school-outline" title="Students" value="shared"></VListItem>
      </router-link>
      <router-link to="/admin/teachers">
        <VListItem prepend-icon="mdi-account-tie" title="Teachers" value="starred" class="my-10">
        </VListItem>
      </router-link>
      <router-link to="/admin/schedule">
        <VListItem prepend-icon="mdi-table" title="Schedule" value="schedule"></VListItem>
      </router-link>
    </VList>
  </VNavigationDrawer>
</template>
<script>
import { storeManageCookie } from '../../store/cookie'
export default {
  setup() {
    const userStore = storeManageCookie();
    return {
      userStore
    }
  },
  data() {
    return {
      isAdmin: false,
    }
  },
  computed() {
    console.log(this.userStore.getToken())
  },

}
</script>
<style>
* {
  padding: 0;
  margin: 0;
}

a {
  text-decoration: none;
  color: black;
}
</style>