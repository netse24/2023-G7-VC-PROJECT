<template>
  
  <section>
    <student-card-view></student-card-view>
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
import StudentCardView from './views/student/StudentCardView.vue';
// import StudentListView from './components/student/StudentList.vue';

export default {
  components:{
    // StudentListView,
    StudentCardView
  },
  setup() {
    const userData = userInformations();
    return {
      userData,
    };
  },
  // methods: {
  //   login(login) {
  //     alert(login);
  //   },
  //   createUser(userInfo) {
  //     axios
  //       .post("http://127.0.0.1:8000/api/user", userInfo)
  //       .then((response) => {
  //         console.log(response.data);
  //       })
  //       .catch((error) => {
  //         console.log(error);
  //       });
  //   },
  //   createTeacher(teacherInfo) {
  //     console.log(teacherInfo);
  //     axios
  //       .post("http://127.0.0.1:8000/api/teacher", teacherInfo)
  //       .then((response) => {
  //         console.log(response.data);
  //       })
  //       .catch((error) => {
  //         console.log(error);
  //       });
  //   },
  // },
};
</script>

