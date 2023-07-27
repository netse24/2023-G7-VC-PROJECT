<template>
  <section>
    <nav-bar />
    <div class="d-flex flex-col p-10">
      <div class="flex gap-2">
        <router-link :to="`${checkRole !== null && checkRole == 'admin' ? '/admin' : '/teachers'}`">
          <button class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded mb-4">
            Home
          </button>
        </router-link>
        <div class="flex justify-center m-auto">
          <h1 class="text-3xl font-bold  -ml-[7.5rem]">
            All Generation of the Students
          </h1>
        </div>
      </div>
      <div class="w-75 m-auto border border-1 p-5 rounded shadow-[10px_35px_150px_-2px_rgba(0,0,0,0.3)]">
        <div class="lex flex-wrap items-start" style="height: 50vh; overflow: auto">
          <!-- grid grid-cols-8 gap-2 -->
          <button v-for="(generation, index) in generationList" :key="index" @click="showlistStudent(generation.id)">
            <v-text
              class="bg-cyan-500 hover:bg-cyan-600 py-[15px] px-[20px] text-2xl font-bold rounded-lg flex justify-center border-b-4 border-b-orange-600 mx-2 my-1">
              {{ generation.name }}
            </v-text>
          </button>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";
import { storeManageCookie } from "@/store/cookie";
import { AES, enc } from "crypto-js";
export default {
  setup() {
    const userCookie = storeManageCookie();
    return {
      userCookie,
    };
  },
  data() {
    return {
      generationList: [],
      checkRole: null,
    };
  },
  methods: {
    async getGenerationList() {
      await axiosClient
        .get("generations")
        .then((response) => {
          this.generationList = response.data.data;
        })
        .catch((error) => {
          console.error(error.response.data.message);
        });
      this.checkRole = AES.decrypt(this.userCookie.getCookie("user_role"), "Secret role").toString(enc.Utf8)
    },
    showlistStudent(id) {
      const role = AES.decrypt(this.userCookie.getCookie("user_role"), "Secret role").toString(enc.Utf8);
      this.$router.push(`/${role}/generations/studentList/${id}`)
    }
  },
  mounted() {
    this.getGenerationList();
  },
};
</script>
