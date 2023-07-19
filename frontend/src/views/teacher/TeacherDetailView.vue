<template>
  <section>
    <navigation-bar />
      <div class="mt-3 ml-5">
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">
          <router-link to="/admin/teachers">Back</router-link>
        </button>
      </div>
    <div class="main flex gap-4 justify-center my-3" v-if="teachers">
      <div class="p-10 rounded-lg shadow-xl bg-cyan-500">
        <v-img class="w-28 m-auto mt-1 mb-2" src="../../assets/AdminSeeTeacherDeatil.png">
          <template #sources>
            <source srcset="../../assets/AdminSeeTeacherDeatil.png">
          </template>
        </v-img>
        <p class="flex justify-center mb-1 text-3xl font-bold dark:text-dark">
          {{ teachers.user.first_name+ " " + teachers.user.last_name }}
        </p>
        <p class="flex justify-center mb-1 text-2xl">{{ teachers.course_id.course }}</p>
        <p class="flex justify-center mb-1 text-2xl">
          {{ teachers.user.address }}
        </p>
      </div>
      <div class="border-gray-200 rounded-lg shadow-xl w-5/12">
        <p class="flex justify-center text-3xl font-bold dark:text-dark p-6 rounded-t-lg bg-cyan-500">
          {{ teachers.user.first_name + " " + teachers.user.last_name }}
        </p>
        <p class="flex justify-start px-5 py-1 mt-4 font-normal dark:text-dark">
          <span>First Name</span>
          <span class="ml-14">{{ teachers.user.first_name }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Last Name</span>
          <span class="ml-14">{{ teachers.user.last_name }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Email</span>
          <span class="ml-24">{{ teachers.user.email }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Date_of_birth</span>
          <span class="ml-9">{{ teachers.user.date_of_birth }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Address</span>
          <span class="ml-20">{{ teachers.user.address }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Gender</span>
          <span class="ml-20">{{ teachers.user.gender }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 mb-4 font-normal dark:text-dark">
          <span>Course</span>
          <span class="ml-20">{{ teachers.course_id.course }}</span>
        </p>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";
import NavigationBar from '../../components/navbar/NavigationBar.vue';
export default {
  components: { NavigationBar },
  props: ["teacher_id"],
  data() {
    return {
      teachers: null,
      selectedUsers: null,
    };
  },
  methods: {
    getTeacherDetail() {
      axiosClient
        .get("teachers/" + this.teacher_id)
        .then((res) => {
          this.teachers = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getTeacherDetail();
  },
};
</script>