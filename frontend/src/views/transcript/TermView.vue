<template>
  <section>
    <nav-bar />
    <div class="d-flex flex-col p-10">
      <div class="flex gap-2">
        <button
          class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded mb-4"
        >
          <router-link to="/admin">Home</router-link>
        </button>
        <button
          class="bg-cyan-500 hover:bg-cyan-600 font-bold py-2 px-4 rounded mb-4"
        >
          <router-link :to="`/admin/generations/studentList/${this.$router.currentRoute.value.query.generation_id}`">Back</router-link>
        </button>
      </div>
      <div class="flex justify-between mb-3">
        <h1 class="text-3xl m-auto font-bold mb-3">
          Choose term to Create Transcript
        </h1>
      </div>
      <div
        class="w-75 d-flex m-auto border border-1 h-50 p-10 rounded shadow-[10px_35px_150px_-2px_rgba(0,0,0,0.3)]"
      >
        <button
          v-for="(term, index) in termList"
          :key="index"
          @click="showTranscript(term.id)"
          class="bg-orange-500 m-2 pb-1   text-2xl font-bold rounded-lg d-flex justify-center items-center"
        >
          <span class="bg-cyan-500 hover:bg-cyan-600 py-3 px-4 text-2xl font-bold rounded-lg flex justify-center">Term {{ term.term }}</span>
        </button>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";
export default {
  props: ["id"],
  data() {
    return {
      termList: [],
    };
  },
  methods: {
    getTerm() {
      axiosClient
        .get("term")
        .then((response) => {
          this.termList = response.data.data;
          console.log(this.termList);
        })
        .catch((err) => console.log(err));
    },
    showTranscript(id) {
      console.log(this.$router)
      this.$router.push({
        path: `/admin/students/term/createtranscript/${id}`,
        query: { user_id: this.id, generation_id: this.$router.currentRoute.value.query.generation_id},
      });
    },
  },
  mounted() {
    this.getTerm();
  },
};
</script>
