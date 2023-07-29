<template>
  <section>
    <nav-bar />
    <div class="mt-3 ml-5">
      <button class="bg-cyan-500 hover:bg-cyan-700 text-dark font-bold py-2 px-4 rounded">
        <router-link to='/teachers'>Back</router-link>
      </button>
    </div>
    <div class="main flex gap-4 justify-center my-3" v-if="teachers">
      <div class="p-10 rounded-lg shadow-xl bg-cyan-500 w-3/12">
        <v-img class="w-28 m-auto mt-3 mb-2" src="../../assets/AdminSeeTeacherDeatil.png">
          <template #sources>
            <source srcset="../../assets/AdminSeeTeacherDeatil.png">
          </template>
        </v-img>
        <p class="flex justify-center mb-1 text-3xl font-bold dark:text-dark">
          {{ teachers.user.first_name + " " + teachers.user.last_name }}
        </p>
        <p class="flex justify-center mb-1 text-2xl"> {{ teachers.course.course_name }}</p>
        <p class="flex justify-center mb-1 text-2xl"> {{ teachers.user.address }}</p>
      </div>
      <div class="border-gray-200 rounded-lg shadow-xl w-1/2">
        <p class="flex justify-center text-3xl font-bold dark:text-dark p-6 rounded-t-lg bg-cyan-500">
        Teacher Background
        </p>
        <p class="flex justify-start px-5 py-1 mt-4 font-normal dark:text-dark">
          <span>First Name</span>
          <span class="ml-20">{{ teachers.user.first_name }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Last Name</span>
          <span class="ml-20">{{ teachers.user.last_name }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Email</span>
          <span class="ml-28">{{ teachers.user.email }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Date of birth</span>
          <span class="ml-16">{{ teachers.user.date_of_birth }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Address</span>
          <span class="ml-24">{{ teachers.user.address }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Gender</span>
          <span class="ml-28">{{ teachers.user.gender }}</span>
        </p>
        <p class="flex px-5 py-1 mt-2 mb-4 font-normal dark:text-dark">
          <span>Course</span>
          <span class="ml-28">{{ teachers.course.course_name }}</span>
        </p>
      </div>
    </div>
  </section>
</template>

<script>
import { axiosClient } from "../../axios-http";
import { userInformations } from "@/store/userStore";
import { storeManageCookie } from "@/store/cookie";
export default {
  props: ['id'],
  setup() {
    const userInfo = userInformations();
    const teacherInfo = userInfo.getStoreData;
    const userCookie = storeManageCookie();
    return {
      teacherInfo,
      userCookie,
    };
  },
  data() {
    return {
      teachers: null,
    };
  },
  methods: {
    async getTeacher() {
      await axiosClient
        .get('teachers/background/' + this.id)
        .then((res) => {
          this.teachers = res.data.data
        })
        .catch((err) => console.log(err));
    },
  },
  created() {
    this.getTeacher();
  },
};
</script>
