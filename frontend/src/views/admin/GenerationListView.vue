<template>
  <section>
    <nav-bar></nav-bar>
    <div class="d-flex flex-col p-10">
      <h1 class="text-xl mb-3">All Generation</h1>
      <div>
        <div class="grid grid-cols-5 gap-4">
          <button v-for="(generation, index) in generationList" :key="index" @click="showlistStudent(generation.id)"
            class="bg-[#1da1f2] py-10 px-9 text-2xl font-bold rounded-lg d-flex justify-center items-center">
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
      studentsList: [],
    };
  },
  methods: {
    getGenerationList() {
      axiosClient
        .get("generations")
        .then((response) => {
          this.generationList = response.data.data;
          console.log(this.generationList);
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
