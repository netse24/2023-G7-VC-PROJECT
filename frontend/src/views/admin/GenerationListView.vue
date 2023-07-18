<template>
  <section>
    <nav-bar></nav-bar>
    <div class="d-flex flex-col p-10">
      <div class="flex justify-between mb-3">
        <h1 class="text-3xl mb-3">All Generation</h1>
        <div class="search-controll">
          <v-btn class="search-bar">
            <input placeholder="search generation..." class="input-search outline outline-0 px-3"/>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>
        </div>
      </div>
      <div>
        <div class="grid grid-cols-5 gap-4">
          <button v-for="(generation, index) in generationList" :key="index" @click="showlistStudent(generation.id)"
            class="bg-cyan-500 py-10 px-9 text-2xl font-bold rounded-lg d-flex justify-center items-center">
            {{ generation.name }}
          </button>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";
export default {
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
      this.$router.push(`/admin/generations/studentList/${id}`)
    }
  },
  mounted() {
    this.getGenerationList();
  },

};
</script>
