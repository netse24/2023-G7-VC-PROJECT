<template>
  <section>
    <router-view/>
    <!-- <StudentListView></StudentListView> -->

    <!-- <v-app>
      <v-main>
        <router-view></router-view>
      </v-main>
    </v-app> -->
    <!-- <form-create-user
      @user-emit="createUser"
      @teacher-emit="createTeacher"
    ></form-create-user> -->
  </section>
</template>
<script>
import { userInformations } from "@/store/userStore";
// import StudentCardView from './views/student/StudentCardView.vue';
// import StudentListView from './components/student/StudentList.vue';

export default {
  components:{
    // StudentListView,
    // StudentCardView
  },
  setup() {
    const userData = userInformations();
    return {
      userData,
    };
  },
};
</script>

