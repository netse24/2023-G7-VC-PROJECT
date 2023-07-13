<template>
  <section>
    <div class="d-flex flex-col p-16">
      <h1 class="text-xl mb-3">All Generation</h1>
      <div>
        <div class="grid grid-cols-5 gap-4">
          <button
            v-for="(generation, index) in generationList"
            :key="index"
            @click="showlistStudent(generation.id)"
            class="bg-[#1da1f2] py-10 px-9 text-2xl font-bold rounded-lg d-flex justify-center items-center"
          >
            {{ generation.name }}
          </button>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { axiosClient } from "../../axios-http";
import { userInformations } from '@/store/userStore'

export default {
  setup() {
    const studentData = userInformations();
    return {
      studentData
    }
  },
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
          console.error(error);
        });
    },
    showlistStudent(index) {
        this.studentData.showlistStudent(index);

    }
  },

  mounted() {
    this.getGenerationList();
    this.showlistStudent();
  },
  provide:{

  }
};
</script>
