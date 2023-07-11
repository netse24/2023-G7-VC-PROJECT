<template>
  <VNavigationDrawer expand-on-hover class="bg-[#B6EDFF]" rail v-if="user.role != undefined">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet" />
    <VList v-if="user.role == 'admin'">
      <VListItem :prepend-avatar="admin_avata" :title="`${user.first_name + ' ' + user.last_name}`"
        :subtitle="`${user.email}`" class="bold text-bold">
      </VListItem>
    </VList>

    <VList v-if="user.role == 'teacher'">
      <VListItem :prepend-avatar="teacher_avata" :title="`${user.first_name + ' ' + user.last_name}`"
        :subtitle="`${user.email}`" class="bold text-bold">
      </VListItem>
    </VList>

    <VList v-if="user.role == 'student'">
      <VListItem :prepend-avatar="student_avata" :title="`${user.first_name + ' ' + user.last_name}`"
        :subtitle="`${user.email}`" class="bold text-bold">
      </VListItem>
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
import { userInformations } from '@/store/userStore';
import admin_avata from '../../assets/admin.png';
import teacher_avata from '../../assets/teacher.png';
import student_avata from '../../assets/student.png';

export default {
  setup() {
    const userInfo = userInformations();
    const user = userInfo.getStoreData;
    return {
      userInfo,
      user,
      admin_avata,
      teacher_avata,
      student_avata,
    }
  },
  data() {
    return {
      isAdmin: false,
    }
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