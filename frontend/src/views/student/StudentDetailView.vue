<template>
  <section>
    <nav-bar />
    <router-link :to="`/admin/generations/studentList/${this.$router.currentRoute.value.query.generation_id}`">
      <button class="student-detail bg-cyan-500 hover:bg-cyan-600 text-black p-2 rounded ml-4 mt-4 w-24 font-bold">
        Back
      </button>
    </router-link>
    <div class="main flex gap-4 justify-center my-2" v-if="students != null">
      <div class="p-6 rounded-lg shadow-xl bg-cyan-500 w-3/12">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
          class="h-28 w-28 m-auto mt-3 mb-3">
          <path
            d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
          <path
            d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
          <path
            d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
        </svg>
        <p class="flex justify-center mb-1 text-3xl font-bold dark:text-dark">{{ students.user.first_name + " " +
          students.user.last_name }}</p>
        <p class="flex justify-center mb-1 text-2xl">{{ students.class }}</p>
        <p class="flex justify-center mb-1 text-2xl">{{ students.user.address }}</p>
      </div>
      <div class="border-gray-200 rounded-lg shadow-xl w-1/2">
        <p class="flex justify-center text-3xl font-bold dark:text-dark p-6 rounded-t-lg bg-cyan-500">
          Student Information
        </p>
        <p class="flex justify-start px-5 py-1 mt-4 font-normal dark:text-dark">
          <span>First Name</span>
          <span class="ml-14">{{ students.user.first_name }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Last Name</span>
          <span class="ml-14">{{ students.user.last_name }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark ">
          <span>Email </span>
          <span class="ml-24">{{ students.user.email }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Date of birth</span>
          <span class="ml-11">{{ students.user.date_of_birth }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Address</span>
          <span class="ml-20">{{ students.user.address }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Gender</span>
          <span class="ml-20">{{ students.user.gender }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 font-normal dark:text-dark">
          <span>Generation</span>
          <span class="ml-14">{{ students.generation }}</span>
        </p>
        <p class="flex justify-start px-5 py-1 mt-2 mb-4 font-normal dark:text-dark">
          <span>Class</span>
          <span class="ml-24">{{ students.class }}</span>
        </p>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from '../../axios-http';
export default {
  props: ["student_id", "generation_id"],
  data() {
    return {
      dialog: false,
      students: null,
      selectedUsers: [],
    };
  },
  methods: {
    //get all the user that have student role
    async getStudent() {
      await axiosClient
        .get("students/" + this.student_id)
        .then((res) => {
          this.students = res.data.data;
        })
    },
  },
  mounted() {
    this.getStudent();
  },
}
</script>