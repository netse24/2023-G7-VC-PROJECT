<template>
  <section>
    <div class="d-flex justify-center">
      <div class="grid grid-cols-5 gap-4 w-75">
        <div
          v-for="(generation, index) in generationList"
          :key="index"
          @click="showlistStudent"
          type="submit"
          class="bg-[#1da1f2] py-10 px-9 text-2xl font-bold rounded-lg d-flex justify-center items-center"
        >
          {{ generation.generation }}
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      generationList: [],
      studentsList: [],
      students: []
    };
  },
  // methods: {
    //  getGenerationList(){
    //   axiosClient.get("generation")
    //     .then((response) => {
    //       console.log(response.data);
    //     })
    //     .catch((error) => {
    //       console.error(error.message);
    //     });
    // },
  //   showlistStudent() {
  //     this.students.forEach((student) => {
  //       this.generationList.forEach((generation) => {
  //         if (student.generation == generation.generation) {
  //           console.log(student.user)
  //         }
  //       });
  //     });
  //   },
  // },
  // mounted() {
  //   this.getGeneration();
  //   this.getStudent();
  // },
// };
}
</script>
