<template>
  <section>
    <nav-bar />
    <div class="d-flex flex-col p-10">
      <div class="flex gap-2">
        <button class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded mb-4">
          <router-link to="/admin">Home</router-link>
        </button>
      </div>
      <div class="flex justify-between mb-3">
        <h1 class="text-3xl m-auto font-bold mb-3">All Generation of the Students</h1>
      </div>
      <div class="w-75 m-auto border border-1 h-50 p-10 rounded shadow-[10px_35px_150px_-2px_rgba(0,0,0,0.3)]">
        <div class="grid grid-cols-8 gap-2 gap-4">
          <button v-for="(generation, index) in generationList" :key="index" @click="showlistStudent(generation.id)"
            class="bg-cyan-500 py-3 px-5 text-2xl font-bold rounded-lg d-flex justify-center items-center">
            {{ generation.name }}
          </button>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";
import { storeManageCookie } from "@/store/cookie";
import { AES, enc } from 'crypto-js';
export default {
  setup() {
    const userCookie = storeManageCookie()
    return {
      userCookie
    }
  },
  data() {
    return {
      generationList: [],
    };
  },
  methods: {
    getGenerationList() {
      axiosClient
        .get("generations")
        .then((response) => {
          this.generationList = response.data.data;
        })
        .catch((error) => {
          console.error(error.response.data.message);
        });
    },
    showlistStudent(id) {
      const role = AES.decrypt(this.userCookie.getCookie("user_role"), "Secret role").toString(enc.Utf8);
      // alert(role)
      if (role == 'admin') {
        this.$router.push(`/admin/generations/studentList/${id}`)
      } else if (role == 'teacher') {
        this.$router.push(`/teacher/generations/studentList/${id}`)
      }
    }
  },
  mounted() {
    this.getGenerationList();
  },
};
</script>
