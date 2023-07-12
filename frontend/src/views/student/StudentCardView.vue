<template>
  <section>
    <div class="m-auto  grid grid-cols-4 gap-4 w-75">
      <div
        v-for="(card, index) in students"
        :key="index"
        class="bg-[#1da1f2] px-5 py-5 drop-shadow-md font-bold rounded-lg d-flex justify-center">
        {{ card.generation}}
      </div>
    </div>
  </section>
</template>
<script>
import axios from "axios";
// import {ref , computed} from "vue";
export default {
  //   setup() {
  //     const users = ref([])
  //     const generation = ref([])
  //       axios.get("http://127.0.0.1:8000/api/generation").then((res) => {
  //         users.value = res.data;
  //       });
  //     const gen = ()=>{

  //     }
  //       return {
  //         users
  //       }
  //   },
  data() {
    return {
      students: [],
      generation: [],
    };
  },

    methods: {
      studentList() {
        axios.get("http://127.0.0.1:8000/api/generation").then((res) => {
          this.students = res.data.data;
          console.log(this.students);
        });
      },
    //   getgeneration(){
    //     for (let generation of this.students){
    //         if ()
    //     }
    //   }
    },
    created() {
      this.studentList();
    },
};
</script>

<style>
</style>